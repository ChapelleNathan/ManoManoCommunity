<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
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

    public const USER_NUMBER = 20;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::USER_NUMBER; $i++) {
            $user = new User();
            $user->setLastname($faker->lastName());
            $user->setFirstname($faker->firstName());
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordHasher->hashPassword($user, 'test'));
            $user->setUpdatedAt(new DateTime('now'));
            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
        }

        $user = new User();
        $user->setLastname('John');
        $user->setFirstname('Doe');
        $user->setUpdatedAt(new DateTime('now'));
        $user->setEmail('john@doe.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'user'));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);
        $this->addReference('user_john', $user);

        $manager->flush();
    }
}
