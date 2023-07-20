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
            if(strlen($day)>20 || strlen($day)<3) {
                $this->addFlash('danger', 'Le champ jour doit contenir entre 3 et 20 caractères');
                return $this->redirectToRoute('app_hours_new');
            }
            $description = $form->get('description')->getData();
            if(strlen($description)>60 || strlen($description)<5) {
                $this->addFlash('danger', 'Le champ amplitude horaire doit contenir entre 5 et 60 caractères');
                return $this->redirectToRoute('app_hours_new');
            }

            $openingHour->setDay($form->get('day')->getData());
            $openingHour->setDescription($form->get('description')->getData());
            $openingHour->setCreatedAt(new \DateTime());
            $openingHour->setUpdatedAt(new \DateTime());

            $entityManager->persist($openingHour);
            $entityManager->flush();

            $this->addFlash('success', "L'horaire a bien été ajouté");

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

    #[Route('/hours/{id}', name: 'app_hours_edit')]
    public function edit(
        OpeningHours           $openingHours,
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {

        $form = $this->createForm(HoursType::class, $openingHours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $openingHours->setDay($form->get('day')->getData());
            $openingHours->setDescription($form->get('description')->getData());
            $openingHours->setUpdatedAt(new \DateTime());

            $entityManager->persist($openingHours);
            $entityManager->flush();

            $this->addFlash('success', "L'horaire a bien été modifié");

            return $this->redirectToRoute('app_hours', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('hours/edit.html.twig', [
            'openingHours' => $openingHours,
            'form' => $form,
        ]);
    }

    #[Route('/hours/delete/{id}', name: 'app_hours_delete', methods: ['POST'])]
    public function delete(Request $request, OpeningHours $openingHours, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $openingHours->getId(), $request->request->get('_token'))) {
            $entityManager->remove($openingHours);
            $entityManager->flush();

            $this->addFlash('success', "L'horaire a bien été supprimé");
        }

        return $this->redirectToRoute('app_hours', [], Response::HTTP_SEE_OTHER);
    }
}
