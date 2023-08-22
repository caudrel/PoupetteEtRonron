<?php

namespace App\Controller;

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
        $pizzas = $foodRepository->findAllActivFoodsWithCat("Les pizzas");
        $menus = $foodRepository->findAllActivFoodsWithCat("Les menus");
        $desserts = $foodRepository->findAllActivFoodsWithCat("Les desserts");
        $waterSofts = $beverageRepository->findAllActivBevWithCat("Eaux et softs");
        $beerTaps = $beverageRepository->findAllActivBevWithCat("Les bières pression");
        $beerBottles = $beverageRepository->findAllActivBevWithCat("Les bières bouteilles");

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


