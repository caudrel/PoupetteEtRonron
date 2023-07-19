<?php

namespace App\Controller;

use App\Repository\ContactFormRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactSubjectController extends AbstractController
{
    #[Route('/contact/subject', name: 'app_contact_subject')]
    public function index(ContactFormRepository $contactFormRepository): Response
    {
        $subjects = $contactFormRepository->findAll();
        return $this->render('contact_subject/index.html.twig', [
            'subjects' => $subjects,
        ]);
    }
}
