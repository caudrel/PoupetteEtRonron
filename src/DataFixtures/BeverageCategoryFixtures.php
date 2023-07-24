<?php

namespace App\DataFixtures;

use App\Entity\BeverageCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BeverageCategoryFixtures extends Fixture
{

    const CATEGORIES = [
        'Eaux et softs',
        'Les bières',
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $categoryName) {
            $category = new BeverageCategory();
            $category->setBeverageCategoryName($categoryName);
            $category->setIsActiv(true);
            $category->setCreatedAt(new \DateTime());
            $category->setUpdatedAt(new \DateTime());

            $manager->persist($category);
            $this->addReference('beverageCategory_' . $categoryName, $category);
        }

        $manager->flush();
    }
}
