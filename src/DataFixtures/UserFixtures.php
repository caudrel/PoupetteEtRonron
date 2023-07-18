<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($userIterator = 0; $userIterator < 5; $userIterator++) {
            $user = new User();
            $user
                ->setEmail($faker->email())
                ->setPassword($this->passwordHasher->hashPassword($user, 'password'))
                ->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setIsActiv(true)
                ->setIsVerified(false)
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setRoles(['ROLE_ADMIN']);

            $manager->persist($user);
        }

        $userSuperAdmin = new User();
        $userSuperAdmin
            ->setEmail('admin@poupetteetronron.com')
            ->setPassword($this->passwordHasher->hashPassword($userSuperAdmin, 'password'))
            ->setFirstname('Julien')
            ->setLastname('Engels')
            ->setIsActiv(true)
            ->setIsVerified(true)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setRoles(['ROLE_SUPER_ADMIN', 'ROLE_ADMIN']);
        $manager->persist($userSuperAdmin);


        $manager->flush();
    }
}
