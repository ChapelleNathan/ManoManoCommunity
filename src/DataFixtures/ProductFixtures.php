<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{

    public const POSTS = 20;

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::POSTS; $i++) {
            $post = new Product();
            $post->setName($faker->lastName());
            $post->setRef($faker->number_format());
            $manager->persist($post);
        }
    }
}
