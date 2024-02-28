<?php

namespace App\Tests\Product\Application;

use App\Product\Application\UseCase\CreateProduct;
use App\Product\Application\UseCase\GetProductList;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CreateAndGetProductListTest extends KernelTestCase
{

    /**
     * Test de creación y consulta de producto
     * a través de la lógica de la aplicación
     */
    public function testCreateAndGetProductList(): void
    {
        $values = [
            'name' => 'Producto Prueba CreateProduct',
            'description' => 'Descripcón del Producto Prueba CreateProduct',
            'price' => '100.20',
            'vatRate' => '50.00'
        ];

        /**
         * Creación de producto desde la Aplicación
         */
        $CreateProduct = self::getContainer()->get(CreateProduct::class);
        $this->assertTrue($CreateProduct($values), 'OK CreateProduct');

        /**
         * Consulta de producto desde la Aplicación
         * pasando com parámetro el nombre del producto
         * anteriormente creado
         */
        $GetProductList = self::getContainer()->get(GetProductList::class);
        $productList = $GetProductList(['name' => 'CreateProduct']);

        $this->assertIsArray($productList[0], 'Ok GetProductList');
    }
}
