<?php declare(strict_types=1);

namespace App\Product\Infrastructure\Repository;

use App\Product\Domain\Entity\Product;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function get(mixed $id): ?Product
    {
        return $this->find($id);
    }

    public function getAll(): array
    {
        return $this->findAll();
    }

    public function getBy(array $criteria, array|null $orderBy = null, int|null $limit = null, int|null $offset = null): array
    {
        return $this->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function getOneBy(array $criteria, array|null $orderBy = null): ?Product
    {
        return $this->findOneBy($criteria, $orderBy);
    }

    public function save(Product $product): bool
    {
        try {
            $this->getEntityManager()->persist($product);
            $this->getEntityManager()->flush();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public function remove($id): bool
    {
        // ToDo
        return false;
    }

    public function search(array $criteria = [], array|null $orderBy = null, int|null $limit = null, int|null $offset = null): iterable
    {
        /** @var \Doctrine\ORM\QueryBuilder $query */
        $query = $this->createQueryBuilder('p');

        if (!empty($criteria['name'])) {
            $query->andWhere("p.name LIKE :name")->setParameter("name", "%{$criteria['name']}%");
        }

        if (!empty($criteria['description'])) {
            $query->andWhere("p.description LIKE :description")->setParameter("description", "%{$criteria['description']}%");
        }

        $query->setMaxResults($limit)->setFirstResult($offset);

        if ($limit && $offset) {
            return new Paginator($query->getQuery());
        }

        return $query->getQuery()->getResult();
    }
}
