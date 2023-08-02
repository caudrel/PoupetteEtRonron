<?php

namespace App\Controller;

use App\Form\SendContactEmailType;
use App\Repository\ContactFormRepository;
use App\Repository\FAQRepository;
use App\Repository\OpeningHoursRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class DetailsController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(
        FAQRepository          $FAQRepository,
        OpeningHoursRepository $openingHoursRepository,
        ContactFormRepository  $ContactFormRepository,
        MailerInterface        $mailer,
        Request                $request,
    ): Response
    {
        $faqs = $FAQRepository->findAll();
        $openingHours = $openingHoursRepository->findAll();

        $subjects = $ContactFormRepository->createQueryBuilder('cf')
            ->select('DISTINCT cf.subject')
            ->getQuery()
            ->getScalarResult();
        $choices = [];
        foreach ($subjects as $subject) {
            $choices[$subject['subject']] = $subject['subject'];
        }

        $form = $this->createForm(SendContactEmailType::class, null, ['subjects' => $choices]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lastname = $form->get('lastname')->getData();
            $firstname = $form->get('firstname')->getData();
            $subject = $form->get('subject')->getData();
            $userEmail = $form->get('email')->getData();
            $message = $form->get('message')->getData();

            $email1 = (new TemplatedEmail())
                ->from($userEmail)
                ->to(new Address('admin@poupetteetronron.com', 'Equipe admin Poupette et Ronron'))
                ->subject("$subject")
                ->htmlTemplate('contact_subject/emailToOwner.html.twig')
                ->context([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'subject' => $subject,
                    'message' => $message,
                ]);

            $email2 = (new TemplatedEmail())
                ->from(new Address('admin@poupetteetronron.com', 'Equipe admin Poupette et Ronron'))
                ->to($userEmail)
                ->subject("$subject")
                ->htmlTemplate('contact_subject/emailToUser.html.twig')
                ->context([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'subject' => $subject,
                    'message' => $message,
                ]);

            $mailer->send($email1);
            $mailer->send($email2);

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirectToRoute('app_contact', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('details/show.html.twig', [
            'faqs' => $faqs,
            'form' => $form,
            'openingHours' => $openingHours,
            'subjects' => $subjects,
        ]);
    }

}