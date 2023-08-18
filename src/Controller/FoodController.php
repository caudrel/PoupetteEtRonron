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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class FoodController extends AbstractController
{
    #[Route('/food/new', name: 'app_food_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $food = new Food();

        $form = $this->createForm(FoodType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

    #[Route('/food/{id}', name: 'app_food_edit')]
    public function edit(
        Food                    $food,
        Request                $request,
        EntityManagerInterface $entityManager,
    ): Response
    {

        $form = $this->createForm(FoodType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $food->setUpdatedAt(new \DateTime());

            $entityManager->persist($food);
            $entityManager->flush();

            $plat = $food->getFoodName();
            $this->addFlash(
                'success',
                "Le plat/menu -- $plat -- a bien été modifié."
            );

            return $this->redirectToRoute('app_food', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('food/edit.html.twig', [
            'food' => $food,
            'form' => $form,
        ]);
    }

    #[Route('/food/delete/{id}', name: 'app_food_delete', methods: ['POST'])]
    public function delete(Request $request, Food $food, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $food->getId(), $request->request->get('_token'))) {
            $entityManager->remove($food);
            $entityManager->flush();

            $plat = $food->getFoodName();
            $this->addFlash(
                'success',
                "Le plat/menu -- $plat -- a bien été supprimé."
            );
        }

        return $this->redirectToRoute('app_food', [], Response::HTTP_SEE_OTHER);
    }
}
