<?php

namespace App\Controller;

use App\Entity\Food;
use App\Form\FoodType;
use App\Repository\FoodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    #[Route('/food/new', name: 'app_food_new', methods: ['GET', 'POST'])]
    public function new(
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $food = new Food();

        $form = $this->createForm(FoodType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $food->setFoodCategory($form->get('foodCategory')->getData());
            $food->setFoodName($form->get('foodName')->getData());
            $food->setFoodCategory($form->get('description')->getData());
            $food->setIsVegetarian($form->get('isVegetarian')->getData());
            $food->setIsActiv($form->get('isActiv')->getData());
            $food->setPrice($form->get('price')->getData());
            $food->setCreatedAt(new \DateTime());
            $food->setUpdatedAt(new \DateTime());

            $entityManager->persist($food);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Le plat/menu a bien été ajouté."
            );

            return $this->redirectToRoute('app_food', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('food/new.html.twig', [
            'form' => $form,
            'food' => $food,
        ]);
    }

    #[Route('/food', name: 'app_food')]
    public function index(FoodRepository $foodRepository): Response
    {
        $foods = $foodRepository->findAllWithCategory();

        return $this->render('food/index.html.twig', [
            'foods' => $foods,
        ]);
    }
}
