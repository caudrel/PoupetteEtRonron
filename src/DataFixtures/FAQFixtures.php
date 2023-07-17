<?php

namespace App\DataFixtures;

use App\Entity\FAQ;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FAQFixtures extends Fixture
{
    const FAQ = [
        [
            'faq' => 'Réserver une table ?',
            'answer' => "Nous ne faisons pas de réservation. En générale les tables se libèrent vites et
                le temps d'attente est limitée.",
        ],
        [
            'faq' => 'Réservation de groupe / privatisation',
            'answer' => "Si vous souhaitez privatiser le restaurant pour un événement, nous vous invitons
                à nous contacter par téléphone ou via notre formulaire de contact disponible sur cette même page.",
        ],
        [
            'faq' => 'Ouvertures weekend et jours fériés ?',
            'answer' => "Les horaires d'ouverture les jours fériés sont disponibles sur nos réseaux sociaux, Facebook et Instagram.",
        ],
        [
            'faq' => 'Gluten et levure dans nos pâtes / digestion facile ?',
            'answer' => "Toutes nos pates son fermentées 48h et sont donc très digestes. Nous utilisons
                uniquement de la farine de blé italienne de type 00, de l'eau, du sel et de la levure.",
        ],
        [
            'faq' => 'Les options pour les végétariens ?',
            'answer' => "Vous retrouverez sur notre carte des options végétariennes. Elles sont facilement identifiable grâce au petit logo.",
        ]];


    public function load(ObjectManager $manager): void
    {
        foreach (self::FAQ as $faq) {
            $faqForFixture = new FAQ();
            $faqForFixture ->setQuestion(($faq ['faq']));
            $faqForFixture ->setAnswer(($faq ['answer']));
            $faqForFixture ->setIsActiv(true);
            $faqForFixture ->setCreatedAt(new \DateTime());
            $faqForFixture ->setUpdatedAt(new \DateTime());

            $manager->persist($faqForFixture);
        }

        $manager->flush();
    }
}
