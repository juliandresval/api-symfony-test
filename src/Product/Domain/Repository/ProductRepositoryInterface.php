<?php

namespace App\Product\Domain\Repository;

use App\Product\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function get(mixed $id): ?Product;
    public function getAll(): array;
    public function getBy(array $criteria, array|null $orderBy = null, int|null $limit = null, int|null $offset = null): array;
    public function getOneBy(array $criteria, array|null $orderBy = null): ?Product;
    public function save(Product $product): mixed;
    public function remove($id): mixed;
}
