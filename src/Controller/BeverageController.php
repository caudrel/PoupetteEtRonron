<?php

namespace App\Controller;

use App\Entity\Beverage;
use App\Form\BeverageType;
use App\Repository\BeverageRepository;
use App\Repository\FoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BeverageController extends AbstractController
{
    #[Route('/beverage/new', name: 'app_beverage_new', methods: ['GET', 'POST'])]
    public function new(
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $beverage = new Beverage();

        $form = $this->createForm(BeverageType::class, $beverage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $beverage->setCreatedAt(new \DateTime());
            $beverage->setUpdatedAt(new \DateTime());

            $entityManager->persist($beverage);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "La boisson a bien été ajoutée."
            );

            return $this->redirectToRoute('app_beverage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('beverage/new.html.twig', [
            'form' => $form,
            'beverage' => $beverage,
        ]);
    }
    
    #[Route('/beverage', name: 'app_beverage')]
    public function index(BeverageRepository $beverageRepository): Response
    {

        $beverages = $beverageRepository->findAllWithCategory();

        return $this->render('beverage/index.html.twig', [
            'beverages' => $beverages,
        ]);
    }

    #[Route('/beverage/{id}', name: 'app_beverage_edit')]
    public function edit(
        Beverage                    $beverage,
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {

        $form = $this->createForm(BeverageType::class, $beverage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $beverage->setUpdatedAt(new \DateTime());

            $entityManager->persist($beverage);
            $entityManager->flush();

            $boisson = $beverage->getBeverageName();
            $this->addFlash(
                'success',
                "La boisson -- $boisson -- a bien été modifiée."
            );

            return $this->redirectToRoute('app_beverage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('beverage/edit.html.twig', [
            'beverage' => $beverage,
            'form' => $form,
        ]);
    }

    #[Route('/beverage/delete/{id}', name: 'app_beverage_delete', methods: ['POST'])]
    public function delete(Request $request, Beverage $beverage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $beverage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($beverage);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "La boisson a bien été supprimée."
            );
        }

        return $this->redirectToRoute('app_beverage', [], Response::HTTP_SEE_OTHER);
    }
}
