<?php

namespace App\Controller;

use App\Entity\Food;
use App\Repository\BeverageRepository;
use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    public function index(FoodRepository $foodRepository, BeverageRepository $beverageRepository): Response
    {
        $pizzas = $foodRepository->findAllFoodsWithCategory("Les pizzas");
        $menus = $foodRepository->findAllFoodsWithCategory("Les menus");
        $desserts = $foodRepository->findAllFoodsWithCategory("Les desserts");
        $waterSofts = $beverageRepository->findAllBeveragesWithCategory("Eaux et softs");
        $beerTaps = $beverageRepository->findAllBeveragesWithCategory("Les bières pression");
        $beerBottles = $beverageRepository->findAllBeveragesWithCategory("Les bières bouteilles");

        return $this->render('carte/index.html.twig', [
            'pizzas' => $pizzas,
            'menus' => $menus,
            'desserts' => $desserts,
            'waterSofts' => $waterSofts,
            'beerTaps' => $beerTaps,
            'beerBottles' => $beerBottles,
        ]);
    }
}
