<?php

namespace App\Product\Domain\Entity;

use App\Product\Infrastructure\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 14, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $vatRate = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 14, scale: 2)]
    private ?string $vatAmount = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 14, scale: 2)]
    private ?string $finalPrice = null;

    #[ORM\Column(length: 3)]
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