<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public const POSTS = 20;

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::POSTS; $i++) {
            $post = new Post();
            $post->setTitle($faker->lastName());
            $post->setDescription($faker->realText());
            $post->setPhoto('post' . rand(1, 14) . '.jpg');
            $post->setOwner($this->getReference('user_' . $i));
            for ($j = 0; $j <= 4; $j++) {
                $post->addTag($this->getReference('tag_' . rand(0, count(TagFixtures::TAGS) - 1)));
            }
            $this->setReference('post_' . $i, $post);
            $manager->persist($post);
        }

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::POSTS; $i++) {
            $post = new Post();
            $post->setTitle($faker->lastName());
            $post->setDescription($faker->realText());
            $post->setPhoto('post' . rand(1, 14) . '.jpg');
            $post->setOwner($this->getReference('user_john'));
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
            TagFixtures::class
        ];
    }
}
