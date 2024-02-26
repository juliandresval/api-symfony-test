<?php

namespace App\Product\Application\UseCase;

use App\Product\Domain\Repository\ProductRepositoryInterface;

class GetProductList
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function __invoke(array $params = [], $limit = null, $offset = null)
    {
        return $this->exec($params, $limit, $offset);
    }

    protected function exec(array $params = [], $limit = null, $offset = null)
    {
        $return = [];
        $result = $this->productRepository->search($params, null, $limit, $offset);
        foreach ($result as $key => $value) {
            $return[$key] = $value->toArray();
        }
        return $return;
    }
}
