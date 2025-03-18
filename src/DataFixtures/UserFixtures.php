<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTime;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        /*
         * Création de 5 utilisateurs avec le bundle Faker et le Role Admin
         */
        $faker = Factory::create('fr_FR');
        for ($userIterator = 0; $userIterator < 5; $userIterator++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setPassword($this->passwordHasher->hashPassword($user, 'Password41!'))
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setIsActiv(true)
                ->setIsVerified(false)
                ->setCreatedAt(new DateTime())
                ->setUpdatedAt(new DateTime())
                ->setRoles(['ROLE_ADMIN']);

            $manager->persist($user);
        }

        /*
         * Création d'un utilisateur avec le Role Super Admin
         */
        $userSuperAdmin = new User();
        $userSuperAdmin
            ->setEmail('lozachaurelie@gmail.com')
            ->setPassword($this->passwordHasher->hashPassword($userSuperAdmin, 'Password41!'))
            ->setFirstname('Julien')
            ->setLastname('Engels')
            ->setIsActiv(true)
            ->setIsVerified(true)
            ->setCreatedAt(new DateTime())
            ->setUpdatedAt(new DateTime())
            ->setRoles(['ROLE_SUPER_ADMIN', 'ROLE_ADMIN']);
        $manager->persist($userSuperAdmin);

        $manager->flush();
    }
}
