<?php

namespace App\Controller;

use App\Entity\FAQ;
use App\Repository\FAQRepository;
use App\Repository\OpeningHoursRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DetailsController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
public function contact(
    FAQRepository $FAQRepository,
        OpeningHoursRepository $openingHoursRepository,
    ): Response
    {
        $faqs = $FAQRepository->findAll();
        $openingHours = $openingHoursRepository->findAll();

        return $this->render('details/show.html.twig', [
            'faqs' => $faqs,
            'openingHours' => $openingHours,
        ]);
    }

}