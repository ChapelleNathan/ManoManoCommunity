<?php

namespace App\DataFixtures;

use App\Entity\Post;
use DateTime;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public const POSTS = 14;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::POSTS; $i++) {
            $post = new Post();
            $post->setTitle($faker->words(rand(1, 6), true));
            $post->setDescription($faker->realText());
            $post->setPhoto('post' . rand(1, 14) . '.jpg');
            $post->setOwner($this->getReference('user_' . $i));
            $post->setUpdatedAt(new DateTimeImmutable('now'));
            $postPhoto = 'post' . ($i + 1) . '.jpg';
            copy(__DIR__ . '/' . $postPhoto, __DIR__ . '/../../public/uploads/images/posts/' . $postPhoto);

            for ($j = 0; $j < rand(0, 5); $j++) {
                $post->addProduct($this->getReference('product_' . array_rand(ProductFixtures::PRODUCTS)));
            }
            for ($j = 0; $j <= 4; $j++) {
                $post->addTag($this->getReference('tag_' . rand(0, count(TagFixtures::TAGS) - 1)));
            }
            $this->setReference('post_' . $i, $post);
            $manager->persist($post);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            TagFixtures::class,
            ProductFixtures::class,
        ];
    }
}
