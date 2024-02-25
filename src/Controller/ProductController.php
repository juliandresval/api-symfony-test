<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private ProductRepository $productRepository
    ) { }

    #[Route('/product/{id}', name: 'app_product')]
    public function getProduct($id, Product $product, Request $request): Response
    {
        dump($id);
        dump($this->productRepository->find($id-1)->toArray());
        dd($product->toArray());
    }
}
