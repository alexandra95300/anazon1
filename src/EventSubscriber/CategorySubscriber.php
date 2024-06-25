<?php

namespace App\EventSubscriber;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: Category::class)]
class CategorySubscriber
{
    public function __construct(private string $filePath)
    {
    }


    public function prePersist(Category $category): void
    {

        $fp = fopen($this->filePath . '\file.log', 'a+');
        fputs($fp, 'La categorie ' . $category->getName() . 'vient d\'être créée');
        fclose($fp);
    }
}
