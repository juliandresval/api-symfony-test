<?php declare(strict_types=1);

namespace App\Product\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Product\Application\UseCase\CreateProduct;
use App\Product\Application\UseCase\GetProduct;
use App\Product\Application\UseCase\GetProductList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class ProductController extends AbstractController
{

    public function __construct(
        private GetProduct $getProduct,
        private GetProductList $getProductList,
        private CreateProduct $createProduct,
    ) { }


    #[Route('/products', name: 'api_product_post', methods: 'POST', format: 'json')]
    public function post(Request $request): JsonResponse
    {
        if ($data = json_decode($request->getContent(), true)){
            $useCase =& $this->createProduct;
            $result = $useCase($data);
            $message = $result ? 'ok': 'error';
            $status = $result ? 200 : 500;
        } else {
            $status = 400;
            $message = 'error';
        }
        return $this->json(['data' => [], 'message' => $message], $status);
    }


    #[Route('/products', name: 'api_product_get_all', methods: 'GET')]
    public function getAll(Request $request): JsonResponse
    {
        $useCase =& $this->getProductList;
        $queryParams = $request->query->all();

        $limit = $request->get('limit', 10);
        $page = $request->get('page', 1);
        $offset = ($limit * ($page - 1));

        return $this->json(
            ['data' => $useCase(
                $queryParams ?? [],
                $limit,
                $offset,
            )]
        );
    }


    #[Route('/products/{id}', name: 'api_product_get', methods: 'GET')]
    public function get($id): JsonResponse
    {
        $useCase =& $this->getProduct;
        return $this->json(['data' => $useCase($id)]);
    }
}
