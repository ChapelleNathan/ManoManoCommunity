<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    const TAGS = ['Bathroom', 'Bedroom', 'Kitchen', 'Garden', 'Decoration', 'Sofa', 'DIY', 'Floor tile','Wardrobe', 'Chair','Plants', 'Tools',' Machines', 'Concrete', 'Varnish', 'Wallpaper', 'Wooden floor', 'Table', 'Painting', 'Furniture'];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TAGS as $key => $tagName) {
            $tag = new Tag();

            $tag->setName($tagName);

            $manager->persist($tag);
            $this->addReference('tag_' . $key, $tag);
        }

        $manager->flush();
    }
}
