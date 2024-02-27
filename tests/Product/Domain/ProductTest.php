<?php

namespace App\Tests\Product\Domain;

use App\Product\Domain\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * El test consiste en tratar de crear una instancia
     * de la clase "Product" con el método estático ::create()
     * enviando datos correctos.
     *
     * Resultado esperado es instancia del "Product"
     */
    public function testCreateProductOk(): void
    {
        $values = [
            'name' => 'Producto Prueba',
            'description' => 'Descripcón del Producto Prueba',
            'price' => '100.20',
            'vatRate' => '50.00'
        ];

        $product = Product::create($values);
        $this->assertInstanceOf(Product::class, $product, 'OK assertInstanceOf');
    }

    /**
     * El test consiste en tratar de crear una instancia
     * de la clase "Product" con el método estático ::create()
     * enviando datos errados.
     *
     * Resultado esperado es una "Excepcion"
     */
    public function testCreateProductError(): void
    {
        $values = [
            'name' => 'Producto Prueba',
            'description' => 'Descripcón del Producto Prueba',
            'price' => '100.20',
            'vatRate' => '--'
        ];

        $this->expectException(\Exception::class);
        $product = Product::create($values);
    }
}
