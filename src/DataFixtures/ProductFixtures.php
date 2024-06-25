<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product; 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;



class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
    for ($i = 1; $i <= 200; $i++) {
        $product = new Product();
        $product->setName('titre'. $i);
        $product->setDescription('desc'. $i);
        $product->setPrice($i);
        $manager->persist($product);

        $manager->flush();
    }
    }
  function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}