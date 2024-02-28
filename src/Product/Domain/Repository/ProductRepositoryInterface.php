<?php

namespace App\Product\Domain\Repository;

use App\Product\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function get(mixed $id): ?Product;
    public function getAll(): iterable;
    public function getBy(array $criteria, array|null $orderBy = null, int|null $limit = null, int|null $offset = null): iterable;
    public function getOneBy(array $criteria, array|null $orderBy = null): ?Product;
    public function save(Product $product): bool;
    public function remove($id): bool;
    public function search(array $criteria, array|null $orderBy = null, int|null $limit = null, int|null $offset = null): iterable;
}
