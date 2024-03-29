<?php

namespace App\Product\Application\UseCase;

use App\Product\Domain\Repository\ProductRepositoryInterface;

class GetProduct
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function __invoke($id)
    {
        return $this->exec($id);
    }

    protected function exec($id)
    {
        return $this->productRepository->get($id)->toArray();
    }
}
