<?php

namespace App\DataFixtures;

use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FoodFixtures extends Fixture
{
    CONST FOODS = [
        [
            'foodName' => 'Light',
            'description' => '1 élément + une boisson (*)',
            'price' => 6.90,
            'isVegetarian' => false,
            'foodCategory' => 'Les menus',
        ],
        [
            'foodName' => 'Classic',
            'description' => '2 éléments + une boisson (*)',
            'price' => 9.90,
            'isVegetarian' => false,
            'foodCategory' => 'Les menus',
        ],
        [
            'foodName' => 'Medium',
            'description' => '3 éléments + une boisson (*)',
            'price' => 13.90,
            'isVegetarian' => false,
            'foodCategory' => 'Les menus',
        ],
        [
            'foodName' => 'Large',
            'description' => '4 éléments + une boisson (*)',
            'price' => 17.90,
            'isVegetarian' => false,
            'foodCategory' => 'Les menus',
        ],
        [
            'foodName' => 'Marguerita',
            'description' => 'Tomate, Mozzarella, Gorgonzola, Parmesan, et plein d’autres bonnes choses',
            'price' => 4.20,
            'isVegetarian' => true,
            'foodCategory' => 'Les pizzas',
        ],
        [
            'foodName' => '4 Fromages',
            'description' => 'Tomate, Mozzarella, Gorgonzola, Parmesan, et plein d’autres bonnes choses',
            'price' => 4.20,
            'isVegetarian' => true,
            'foodCategory' => 'Les pizzas',
        ],
        [
            'foodName' => 'Orientale',
            'description' => 'Tomate, Mozzarella, origan, merguez, olives noires',
            'price' => 4.20,
            'isVegetarian' => false,
            'foodCategory' => 'Les pizzas',
        ],
        [
            'foodName' => '4 Saisons',
            'description' => 'Tomate, Mozzarella, origan, jambon',
            'price' => 4.20,
            'isVegetarian' => false,
            'foodCategory' => 'Les pizzas',
        ],
        [
            'foodName' => 'Burrata',
            'description' => 'Tomate, Mozzarella di Buffala, basilic frais',
            'price' => 4.20,
            'isVegetarian' => true,
            'foodCategory' => 'Les pizzas',
        ],
        [
            'foodName' => 'Tarte au citron meringuée',
            'description' => 'De la tarte, du citron et de la meringue, que demander de plus ?',
            'price' => 4.20,
            'isVegetarian' => true,
            'foodCategory' => 'Les desserts',
        ],
        [
            'foodName' => 'Fondant au chocolat',
            'description' => 'Du fondant et du chocolat, pour les gourmands',
            'price' => 4.20,
            'isVegetarian' => true,
            'foodCategory' => 'Les desserts',
        ],
        [
            'foodName' => 'Paris Brest',
            'description' => 'Du praliné et des noisettes, miam !',
            'price' => 4.20,
            'isVegetarian' => true,
            'foodCategory' => 'Les desserts',
        ],
        [
            'foodName' => 'Surprise',
            'description' => 'Le dessert du jour, ravissement en perspective',
            'price' => 4.20,
            'isVegetarian' => true,
            'foodCategory' => 'Les desserts',
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::FOODS as $food) {
            $foodForFixture = new Food();
            $foodForFixture
                ->setFoodName($food ['foodName'])
                ->setDescription($food ['description'])
                ->setIsActiv(true)
                ->setIsVegetarian($food ['isVegetarian'])
                ->setPrice($food ['price'])
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setFoodCategory($this->getReference('foodCategory_' . $food['foodCategory']));

            $manager->persist($foodForFixture);
        }

        $manager->flush();
    }
}
