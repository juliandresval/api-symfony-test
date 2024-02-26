<?php

namespace App\Product\Application;

use App\Product\Domain\Repository\ProductRepositoryInterface;

class GetProduct
{
    public function __construct(private ProductRepositoryInterface $productRepository) {

    }

    public function __invoke($id) {
        return $this->exec($id);
    }

    public function exec($id) {
        return $this->productRepository->get($id);
    }
}
