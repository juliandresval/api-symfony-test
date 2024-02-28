<?php

namespace App\Product\Infrastructure\DataFixtures;


use App\Product\Domain\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{

    function getData(): array
    {
        return [
            ['name' => 'Laptop', 'price' => '500.00', 'vatRate' => '10'],
            ['name' => 'Teclado', 'price' => '50.00', 'vatRate' => '10'],
            ['name' => 'Celular', 'price' => '300.00', 'vatRate' => '10'],
            ['name' => 'Monitor', 'price' => '200.00', 'vatRate' => '10'],
            ['name' => 'Mouse', 'price' => '30.00', 'vatRate' => '10'],
            ['name' => 'PC', 'price' => '600.00', 'vatRate' => '10'],
            ['name' => 'RAM DDR4 16GB', 'price' => '40.00', 'vatRate' => '10'],
            ['name' => 'RAM DDR4 4GB', 'price' => '30.00', 'vatRate' => '10'],
            ['name' => 'RAM DDR4 8GB', 'price' => '20.00', 'vatRate' => '10'],
            ['name' => 'SSD 128GB', 'price' => '30.00', 'vatRate' => '10'],
            ['name' => 'SSD 256GB', 'price' => '40.00', 'vatRate' => '10'],
            ['name' => 'SSD 512GB', 'price' => '50.00', 'vatRate' => '10'],
            ['name' => 'SSD 1TB', 'price' => '60.00', 'vatRate' => '10'],
            ['name' => 'USB 128GB', 'price' => '30.00', 'vatRate' => '10'],
            ['name' => 'USB 256GB', 'price' => '40.00', 'vatRate' => '10'],
            ['name' => 'USB 512GB', 'price' => '50.00', 'vatRate' => '10'],
            ['name' => 'USB 1TB', 'price' => '60.00', 'vatRate' => '10'],
        ];
    }

    public function load(ObjectManager $manager): void
    {

        foreach ($this->getData() as $key => $row) {
            $row['description'] = 'Descripción de ' . $row['name'];
            $product = Product::create($row);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
