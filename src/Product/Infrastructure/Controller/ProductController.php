<?php

namespace App\Product\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Product\Application\UseCase\CreateProduct;
use App\Product\Application\UseCase\GetProduct;
use App\Product\Application\UseCase\GetProductList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    public function __construct(
        private GetProduct $getProduct,
        private GetProductList $getProductList,
        private CreateProduct $createProduct,
    ) { }

    #[Route('/products', name: 'api_product_post', methods: 'POST')]
    public function post(Request $request): Response
    {
        $useCase =& $this->createProduct;
        return $this->json($useCase([]));
    }

    #[Route('/products', name: 'api_product_get_all', methods: 'GET')]
    public function getAll(Request $request): Response
    {
        $useCase =& $this->getProductList;
        $queryParams = $request->query->all();
        return $this->json($useCase($queryParams ?? []));
    }

    #[Route('/products/{id}', name: 'api_product_get', methods: 'GET')]
    public function get($id): Response
    {
        $useCase =& $this->getProduct;
        return $this->json($useCase($id));
    }
}
