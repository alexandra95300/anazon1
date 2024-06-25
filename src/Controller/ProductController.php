<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    
    #[Route('/products', name: 'app_products', methods:['GET'])]
    public function index(Request $request, ProductRepository $productRepository, PaginatorInterface $paginator): Response
    {
        $products = $productRepository->createQueryBuilder('p');
        $pagination = $paginator->paginate(
            $products,
            $request->query->getInt('page') ?? 1,
            10
        );
        return $this->render('product/list.html.twig', [
            'products' => $pagination,
           
        ]);
    }

    #[Route('/product/{id<^\d+$>}/show', name: 'app_products_show')]
    public function show( Product $product): Response
    {
      

        return $this->render('product/product.html.twig', [
            'product' => $product
        ]);
    }
}
