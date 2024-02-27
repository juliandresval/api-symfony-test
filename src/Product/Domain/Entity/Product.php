<?php declare(strict_types=1);

namespace App\Product\Domain\Entity;

class Product
{
    private ?int $id = null;

    private ?string $name = null;

    private ?string $description = null;

    private ?string $price = null;

    private ?string $vatRate = null;

    private ?string $vatAmount = null;

    private ?string $finalPrice = null;

    private ?string $currency = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /** name */

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /** description */

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /** price */

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    /** vatRate */

    public function getVatRate(): ?string
    {
        return $this->vatRate;
    }

    public function setVatRate(string $vatRate = '0.00'): static
    {
        $this->vatRate = $vatRate;

        return $this;
    }

    /** vatAmount */

    public function getVatAmount(): ?string
    {
        return $this->vatAmount;
    }

    public function setVatAmount(string $vatAmount = '0.00'): static
    {
        $this->vatAmount = $vatAmount;

        return $this;
    }

    /** finalPrice */

    public function getFinalPrice(): ?string
    {
        return $this->finalPrice;
    }

    public function setFinalPrice(string $finalPrice = '0.00'): static
    {
        $this->finalPrice = $finalPrice;

        return $this;
    }

    /** currency */

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    /** Tools */

    public static function create(array $values): Product {
        $product = new Product();
        $product->setName($values['name']);
        $product->setDescription($values['description']);
        $product->setPrice($values['price']);
        $product->setVatRate($values['vatRate']);
        $product->setVatAmount(
            (string) ($values['price'] * ($values['vatRate']/100))
        );
        $product->setFinalPrice(
            (string) (($values['price'] * ($values['vatRate']/100)) + $values['price'])
        );
        $product->setCurrency(!empty($values['currency']) ? $values['currency'] : 'USD');
        return $product;
    }

    public function getProps() : array
    {
        return array_keys(get_class_vars($this::class)) ?? [];
    }

    public function toArray(): array
    {
        $array = [];

        foreach ($this->getProps() as $key => $value) {
            $array[$key] = [
                'property' => $value,
                'value' => method_exists($this, $method = 'get' . ucwords($value)) ? $this->$method() : null
            ];
        }

        return $array;
    }
}