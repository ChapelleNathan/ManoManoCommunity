<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public const PRODUCTS = [
        [
            'name' => 'Perceuse visseuse MAKITA',
            'ref' => 'DDF482RMJ',
            'image' => '1733926_1.jpg',
            'link' => 'https://www.manomano.fr/p/perceuse-visseuse-makita-18v-li-ion-40ah-2-batteries-chargeur-en-coffret-ddf482rmj-13519888',
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCTS as $key => $product) {
            $newProduct = new Product();
            $newProduct->setName($product['name']);
            $newProduct->setRef($product['ref']);
            $newProduct->setImage($product['image']);
            $newProduct->setLink($product['link']);
            $this->setReference('product_' . $key, $newProduct);
            $manager->persist($newProduct);
        }
        $manager->flush();
    }
}
