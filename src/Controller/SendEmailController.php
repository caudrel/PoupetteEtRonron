<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ContactForm;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class SendEmailController extends AbstractController
{
    #[Route('/contactForm', name: 'app_contact-form')]
    public function sendEmails(MailerInterface $mailer, Request $request, ContactForm $contactForm): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $contactForm = $form->getData();
            $subject = $contactForm['subject'];
            $name = $contactForm['name'];
            $UserEmail = $contactForm['email'];
            $message = $contactForm['message'];

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            $email1 = (new Email())
                ->from($UserEmail)
                ->to($this->getParameter('mailer_from'))
                ->subject("Message de $name: $subject")
                ->html($this->renderView('send_email/emailToPR.html.twig', [
                    'subject' => $subject,
                    'name' => $name,
                    'UserEmail' => $UserEmail,
                    'message' => $message
                ]));

            $email2 = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($UserEmail)
                ->subject("Votre message à Poupette et Ronron : $subject")
                ->html($this->renderView('send_email/emailToUser.html.twig', [
                    'subject' => $subject,
                    'name' => $name,
                    'UserEmail' => $UserEmail,
                    'message' => $message
                ]));

            $mailer->send($email1);
            $mailer->send($email2);
        }


        return $this->render('send_email/index.html.twig', [
            'controller_name' => 'ContactFormController',
        ]);
    }
}
