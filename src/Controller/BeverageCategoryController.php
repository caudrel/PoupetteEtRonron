<?php

namespace App\Controller;

use App\Entity\BeverageCategory;
use App\Form\BeverageCategoryType;
use App\Repository\BeverageCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BeverageCategoryController extends AbstractController
{
    #[Route('/beverage/category/new', name: 'app_beverage_category_new', methods: ['GET', 'POST'])]
    public function new(
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $beverageCategory = new BeverageCategory();

        $form = $this->createForm(BeverageCategoryType::class, $beverageCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $beverageCategory->setBeverageCategoryName($form->get('beverageCategoryName')->getData());
            $beverageCategory->setIsActiv($form->get('isActiv')->getData());
            $beverageCategory->setCreatedAt(new \DateTime());
            $beverageCategory->setUpdatedAt(new \DateTime());

            $entityManager->persist($beverageCategory);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "La catégorie a bien été ajoutée."
            );

            return $this->redirectToRoute('app_beverage_category', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('beverage_category/new.html.twig', [
            'form' => $form,
            'beverageCategory' => $beverageCategory,
        ]);
    }

    #[Route('/beverage/category', name: 'app_beverage_category')]
    public function index(BeverageCategoryRepository $beverageCategoryRepository): Response
    {

        $beverageCategories = $beverageCategoryRepository->findAll();

        return $this->render('beverage_category/index.html.twig', [
            'beverageCategories' => $beverageCategories,
        ]);
    }

    #[Route('/beverage/category/{id}', name: 'app_beverage_category_edit')]
    public function edit(
        BeverageCategory $beverageCategory,
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {

        $form = $this->createForm(BeverageCategoryType::class, $beverageCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $beverageCategory->setBeverageCategoryName($form->get('beverageCategoryName')->getData());
            $beverageCategory->setIsActiv($form->get('isActiv')->getData());
            $beverageCategory->setUpdatedAt(new \DateTime());

            $entityManager->persist($beverageCategory);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "La catégorie a bien été modifiée."
            );

            return $this->redirectToRoute('app_beverage_category', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('beverage_category/edit.html.twig', [
            'beverageCategory' => $beverageCategory,
            'form' => $form,
        ]);
    }

    #[Route('/beverage/category/delete/{id}', name: 'app_beverage_category_delete', methods: ['POST'])]
    public function delete(Request $request, BeverageCategory $beverageCategory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $beverageCategory->getId(), $request->request->get('_token'))) {
            $entityManager->remove($beverageCategory);
            $entityManager->flush();

            $categoryName = $beverageCategory->getBeverageCategoryName();
            $this->addFlash(
                'success',
                "La catégorie -- $categoryName -- a bien été supprimée."
            );
        }

        return $this->redirectToRoute('app_beverage_category', [], Response::HTTP_SEE_OTHER);
    }
}
