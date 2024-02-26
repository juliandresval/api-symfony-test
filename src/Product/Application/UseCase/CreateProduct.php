<?php

namespace App\Product\Application\UseCase;

use App\Product\Domain\Entity\Product;
use App\Product\Domain\Repository\ProductRepositoryInterface;

class CreateProduct
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private Product $product
    ) {
    }

    public function __invoke($values): mixed
    {
        return $this->exec($values);
    }

    protected function exec($values): mixed
    {
        // ToDo
        return null;
    }
}
