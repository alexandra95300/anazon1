<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'app_categories', methods:['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/list.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/category/{id<^\d+$>}/show', name: 'app_categories_show')]
    public function show(Category $category): Response
    {
        return $this->render('category/category.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/category/add', name: 'app_categories_add')]

    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $category = new Category();
    
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($form->isValid()){
            $category = $form->getData();

            $em->persist($category);
            $em->flush();
            
            $this->addFlash('success', 'Category bien enregistré');
            return $this->redirectToRoute('app_categories');

            }else{
                $this->addFlash('error', 'Category non enregistré');

        }
                      
        }

        return $this->render('category/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/{id<^\d+$>}/edit', name: 'app_categories_edit')]
    public function edit(Request $request, Category $category, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($form->isValid()){
                $em->flush();

            $this->addFlash('success', 'Category bien enregistré');
            return $this->redirectToRoute('app_categories');

            }else{
                $this->addFlash('error', 'Category non enregistré');
            }
        }
        return $this->render('category/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/{id<^\d+$>}/delete', name: 'app_categories_delete')]
    public function remove( Category $category, EntityManagerInterface $em): Response
    {
                $em->remove($category);
                $em->flush();

            $this->addFlash('success', 'Category bien supprimé');
            return $this->redirectToRoute('app_categories');
       
    }

}