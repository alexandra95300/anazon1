<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture 
{
    const CATEGORY_1 = 'CATEGORY_1';
    const CATEGORY_2 = 'CATEGORY_2';
    const CATEGORY_3 = 'CATEGORY_3';
    public function load(ObjectManager $manager): void
    {
    
        $category = new Category();
        $category->setName('Electronics');
        $this->addReference('CATEGORY_1', $category);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Books');
        $this->addReference('CATEGORY_2', $category);
        $manager->persist($category);

        $category= new Category();
        $category->setName('Clothes');
        $this->addReference('CATEGORY_3', $category);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Toys');
        $this->addReference('CATEGORY_4', $category);
        $manager->persist($category);
    

        $manager->flush();
    }
}
