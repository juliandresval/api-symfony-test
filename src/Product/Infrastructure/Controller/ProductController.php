<?php

namespace App\Product\Infrastructure\Controller;

use App\Product\Domain\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Product\Infrastructure\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    public function __construct(
        private ProductRepository $productRepository
    ) { }

    #[Route('/product/{id}', name: 'app_product')]
    public function getProduct($id, Product $product, Request $request): Response
    {
        return $this->json($this->productRepository->find($id)->toArray());
    }
}
