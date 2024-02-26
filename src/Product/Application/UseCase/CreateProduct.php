<?php declare(strict_types=1);

namespace App\Product\Application\UseCase;

use App\Product\Domain\Entity\Product;
use App\Product\Domain\Repository\ProductRepositoryInterface;

class CreateProduct
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function __invoke($values): mixed
    {
        return $this->exec($values);
    }

    protected function exec(array $values): mixed
    {
        $product = Product::create($values);
        return $this->productRepository->save($product);
    }
}
