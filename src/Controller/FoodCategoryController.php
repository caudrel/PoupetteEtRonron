<?php

namespace App\Controller;

use App\Entity\FoodCategory;
use App\Form\FoodCategoryType;
use App\Repository\FoodCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodCategoryController extends AbstractController
{

    #[Route('/food/category/new', name: 'app_food_category_new', methods: ['GET', 'POST'])]
    public function new(
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $foodCategory = new FoodCategory();

        $form = $this->createForm(FoodCategoryType::class, $foodCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foodCategory->setFoodCategoryName($form->get('foodCategoryName')->getData());
            $foodCategory->setIsActiv($form->get('isActiv')->getData());
            $foodCategory->setCreatedAt(new \DateTime());
            $foodCategory->setUpdatedAt(new \DateTime());

            $entityManager->persist($foodCategory);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "La catégorie a bien été ajoutée."
            );

            return $this->redirectToRoute('app_food_category', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('food_category/new.html.twig', [
            'form' => $form,
            'foodCategory' => $foodCategory,
        ]);
    }

    #[Route('/food/category', name: 'app_food_category')]
    public function index(FoodCategoryRepository $foodCategoryRepository): Response
    {

        $foodCategories = $foodCategoryRepository->findAll();

        return $this->render('food_category/index.html.twig', [
            'foodCategories' => $foodCategories,
        ]);
    }

    #[Route('/food/category/{id}', name: 'app_food_category_edit')]
    public function edit(
        FoodCategory $foodCategory,
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {

        $form = $this->createForm(FoodCategoryType::class, $foodCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foodCategory->setFoodCategoryName($form->get('foodCategoryName')->getData());
            $foodCategory->setIsActiv($form->get('isActiv')->getData());
            $foodCategory->setUpdatedAt(new \DateTime());

            $entityManager->persist($foodCategory);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "La catégorie a bien été modifiée."
            );

            return $this->redirectToRoute('app_food_category', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('food_category/edit.html.twig', [
            'foodCategory' => $foodCategory,
            'form' => $form,
        ]);
    }

    #[Route('/food/category/delete/{id}', name: 'app_food_category_delete', methods: ['POST'])]
    public function delete(Request $request, FoodCategory $foodCategory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $foodCategory->getId(), $request->request->get('_token'))) {
            $entityManager->remove($foodCategory);
            $entityManager->flush();

            $categoryName = $foodCategory->getFoodCategoryName();
            $this->addFlash(
                'success',
                "La catégorie -- $categoryName -- a bien été supprimée."
            );
        }

        return $this->redirectToRoute('app_food_category', [], Response::HTTP_SEE_OTHER);
    }
}
