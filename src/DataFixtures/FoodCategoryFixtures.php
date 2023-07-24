<?php

namespace App\DataFixtures;

use App\Entity\FoodCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FoodCategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Les menus',
        'Les pizzas',
        'Les desserts',
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::CATEGORIES as $categoryName) {
            $category = new FoodCategory();
            $category->setFoodCategoryName($categoryName);
            $category->setIsActiv(true);
            $category->setCreatedAt(new \DateTime());
            $category->setUpdatedAt(new \DateTime());

            $manager->persist($category);
            $this->addReference('category_' . $categoryName, $category);
        }

        $manager->flush();
    }
}
