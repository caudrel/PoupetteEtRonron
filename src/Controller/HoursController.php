<?php

namespace App\Controller;

use App\Repository\OpeningHoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HoursController extends AbstractController
{
    #[Route('/hours', name: 'app_hours')]
    public function index(
        OpeningHoursRepository $openingHoursRepository
    ): Response
    {
        $openingHours = $openingHoursRepository->findAll();
        return $this->render('hours/index.html.twig', [
            'openingHours' => $openingHours,
        ]);
    }
}
