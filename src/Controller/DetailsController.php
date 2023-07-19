<?php

namespace App\Controller;

use App\Entity\FAQ;
use App\Repository\FAQRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DetailsController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
public function contact(
    FAQRepository $FAQRepository,
    ): Response
    {
        $faqs = $FAQRepository->findAll();

        return $this->render('details/show.html.twig', [
            'faqs' => $faqs,
        ]);
    }

}