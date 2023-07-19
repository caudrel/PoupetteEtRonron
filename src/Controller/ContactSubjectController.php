<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\ContactSubjectType;
use App\Repository\ContactFormRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactSubjectController extends AbstractController
{
    #[Route('/contact/subject/new', name: 'app_contact_subject_new', methods: ['GET', 'POST'])]
    public function new(
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $contactSubject = new ContactForm();

        $form = $this->createForm(ContactSubjectType::class, $contactSubject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactSubject->setSubject($form->get('subject')->getData());
            $contactSubject->setIsValid($form->get('isValid')->getData());
            $contactSubject->setCreatedAt(new \DateTime());
            $contactSubject->setUpdatedAt(new \DateTime());

            $entityManager->persist($contactSubject);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_subject', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('Contact_subject/new.html.twig', [
            'form' => $form,
            'contactSubject' => $contactSubject,
        ]);
    }
    #[Route('/contact/subject', name: 'app_contact_subject')]
    public function index(ContactFormRepository $contactFormRepository): Response
    {
        $subjects = $contactFormRepository->findAll();
        return $this->render('contact_subject/index.html.twig', [
            'subjects' => $subjects,
        ]);
    }

    #[Route('/contact/subject/{id}', name: 'app_contact_subject_edit')]
    public function edit(
        ContactForm $contactForm,
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {

        $form = $this->createForm(ContactSubjectType::class, $contactForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactForm->setSubject($form->get('subject')->getData());
            $contactForm->setIsValid($form->get('isValid')->getData());
            $contactForm->setUpdatedAt(new \DateTime());

            $entityManager->persist($contactForm);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_subject', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('contact_subject/edit.html.twig', [
            'contactForm' => $contactForm,
            'form' => $form,
        ]);
    }

    #[Route('/contact/subject/delete/{id}', name: 'app_contact_subject_delete', methods: ['POST'])]
    public function delete(Request $request, ContactForm $contactForm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $contactForm->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contactForm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_contact_subject', [], Response::HTTP_SEE_OTHER);
    }

}
