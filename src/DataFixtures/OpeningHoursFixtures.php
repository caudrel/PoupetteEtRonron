<?php

namespace App\DataFixtures;

use App\Entity\OpeningHours;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class OpeningHoursFixtures extends Fixture
{

    const HOURS = [
        [
            'day' => 'Lundi',
            'hours' => "11h à 22h",
        ],
        [
            'day' => 'Mardi',
            'hours' => "11h à 22h",
        ],
        [
            'day' => 'Mercredi',
            'hours' => "11h à 22h",
        ],
        [
            'day' => 'Jeudi',
            'hours' => "11h à 22h",
        ],
        [
            'day' => 'Vendredi',
            'hours' => "11h à 22h",
        ],
        [
            'day' => 'Samedi',
            'hours' => "11h à 22h",
        ],
        [
            'day' => 'Dimanche',
            'hours' => "17h à 22h",
        ]];

    public function load(ObjectManager $manager): void
    {
        foreach (self::HOURS as $openingHours) {
            $openingHoursForFixture = new OpeningHours();
            $openingHoursForFixture->setDay(($openingHours ['day']));
            $openingHoursForFixture->setDescription(($openingHours ['hours']));
            $openingHoursForFixture->setCreatedAt(new DateTime());
            $openingHoursForFixture->setUpdatedAt(new DateTime());

            $manager->persist($openingHoursForFixture);
        }

        $manager->flush();
    }
}
