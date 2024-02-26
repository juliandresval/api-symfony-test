<?php

namespace App\Product\Application\UseCase;

use App\Product\Domain\Repository\ProductRepositoryInterface;

class GetProductList
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function __invoke($id)
    {
        return $this->exec($id);
    }

    protected function exec(array $params = [])
    {
        $return = [];
        // ToDo Pagination
        $result = $this->productRepository->search($params);
        foreach ($result as $key => $value) {
            $return[$key] = $value->toArray();
        }
        return $return;
    }
}
