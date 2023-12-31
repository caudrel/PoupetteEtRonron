<?php

namespace App\DataFixtures;

use App\Entity\Beverage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class BeverageFixtures extends Fixture
{
    CONST BEVERAGES = [
        [
            'beverageName' => 'Eaux',
            'description' => 'Evian 50cl, San Pelligrino 50cl',
            'price' => 4.00,
            'beverageCategory' => 'Eaux et softs',
        ],
        [
            'beverageName' => 'Eaux',
            'description' => 'Evian 1L, San Pelligrino 1L',
            'price' => 6.00,
            'beverageCategory' => 'Eaux et softs',
        ],
        [
            'beverageName' => 'Softs',
            'description' => 'Coca-cola, Coca-cola zero, Orangina, Ice Tea, Sprite, Minute maid Pomme ou Orange - 33cl',
            'price' => 3.00,
            'beverageCategory' => 'Eaux et softs',
        ],
        [
            'beverageName' => 'Sirops',
            'description' => 'Grenadine, Menthe, Fraise, Citron',
            'price' => 2.50,
            'beverageCategory' => 'Eaux et softs',
        ],
        [
            'beverageName' => ' ',
            'description' => 'Grimbergen, Hoegaarden, Heineken 25cl',
            'price' => 4.00,
            'beverageCategory' => 'Les bières pression',
        ],
        [
            'beverageName' => ' ',
            'description' => 'Grimbergen, Hoegaarden, Heineken 50cl',
            'price' => 6.50,
            'beverageCategory' => 'Les bières pression',
        ],
        [
            'beverageName' => ' ',
            'description' => 'Cannette Afut 33cl',
            'price' => 5.00,
            'beverageCategory' => 'Les bières bouteilles',
        ],
        [
            'beverageName' => ' ',
            'description' => 'Mort Subite Kriek 33cl',
            'price' => 5.50,
            'beverageCategory' => 'Les bières bouteilles',
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::BEVERAGES as $beverage) {
            $beverageForFixture = new Beverage();
            $beverageForFixture
                ->setBeverageName($beverage ['beverageName'])
                ->setDescription($beverage ['description'])
                ->setIsActiv(true)
                ->setPrice($beverage ['price'])
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime())
                ->setBeverageCategory($this->getReference('beverageCategory_' . $beverage['beverageCategory']));

            $manager->persist($beverageForFixture);
        }

        $manager->flush();
    }
}
