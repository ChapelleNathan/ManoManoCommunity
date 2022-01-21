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
            'image' => 'perceuse.jpg',
            'link' => 'https://www.manomano.fr/p/perceuse-visseuse-makita-18v-li-ion-40ah-2-batteries-chargeur-en-coffret-ddf482rmj-13519888',
        ],
        [
            'name' => 'Planche chêne rustique 60 x 19',
            'ref' => '336005',
            'image' => 'planche.jpg',
            'link' => 'https://www.manomano.fr/catalogue/p/etagere-murale-chene-rustique-60-x-19-12029459',
        ],
        [
            'name' => 'Série Tanger 20x20 (carton de 1,00 m2)',
            'ref' => '1215',
            'image' => 'carlage.jpg',
            'link' => 'https://www.manomano.fr/p/serie-tanger-20x20-carton-de-100-m2-19307647',
        ],
        [
            'name' => 'Meuble TV DETROIT 2 tiroirs design industriel',
            'ref' => '13370',
            'image' => 'meubleTv.jpg',
            'link' => 'https://www.manomano.fr/p/meuble-tv-detroit-design-industriel-13737492',
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
