<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\ContactSubject;

class ContactFormFixtures extends Fixture
{
    const SUBJECTS = [
        'Je veux réserver une table',
        'Je veux réserver pour un groupe',
        'Avez-vous des plats végétariens ?',
        'Avez-vous un accès PMR ?',
        'Autre',
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::SUBJECTS as $subject) {
            $contactFormForFixture = new ContactSubject();
            $contactFormForFixture ->setSubject($subject);
            $contactFormForFixture ->setIsValid(true);
            $contactFormForFixture ->setCreatedAt(new \DateTime());
            $contactFormForFixture ->setUpdatedAt(new \DateTime());

            $manager->persist($contactFormForFixture);
        }
        $manager->flush();
    }
}
