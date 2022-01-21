<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public const POSTS = 10;

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < self::POSTS; $i++) {
            $comment = new Comment();
            $comment->setText($faker->text());
            $comment->setAuthor($this->getReference('user_' . $i));
            $comment->setPost($this->getReference('post_' . $i));
            $manager->persist($comment);
            $this->addReference('comment_' . $i, $comment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            PostFixtures::class
        ];
    }
}
