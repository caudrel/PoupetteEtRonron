<?php

namespace App\Controller;

use App\Entity\OpeningHours;
use App\Form\HoursType;
use App\Repository\OpeningHoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HoursController extends AbstractController
{
    #[Route('/hours/new', name: 'app_hours_new', methods: ['GET', 'POST'])]
    public function new(
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $openingHour = new OpeningHours();

        $form = $this->createForm(HoursType::class, $openingHour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $day = $form->get('day')->getData();
            if(strlen($day)>10) {
                $this->addFlash('error', 'Le champs jour ne peut pas contenir plus de 10 caractères');
                return $this->redirectToRoute('app_hours_new');
            }

            $openingHour->setDay($form->get('day')->getData());
            $openingHour->setDescription($form->get('description')->getData());
            $openingHour->setCreatedAt(new \DateTime());
            $openingHour->setUpdatedAt(new \DateTime());

            $entityManager->persist($openingHour);
            $entityManager->flush();

            return $this->redirectToRoute('app_hours', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('hours/new.html.twig', [
            'form' => $form,
            'openingHour' => $openingHour,
        ]);
    }
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
