<?php

namespace App\Product\Infrastructure\Controller;

use App\Product\Application\GetProduct;
use App\Product\Domain\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Product\Infrastructure\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    public function __construct(
        private GetProduct $getProduct,
    ) { }

    #[Route('/product/{id}', name: 'api_product_get', methods: 'GET')]
    public function get($id, Product $product, Request $request): Response
    {
        $getProduct =& $this->getProduct;
        return $this->json($getProduct($id));
    }
}
