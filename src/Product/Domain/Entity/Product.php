<?php declare(strict_types=1);

namespace App\Product\Domain\Entity;

class Product
{
    private ?int $id = null;

    private ?string $name = null;

    private ?string $description = null;

    private string|int|float|null $price = null;

    private string|int|float|null $vatRate = null;

    private string|int|float|null $vatAmount = null;

    private string|int|float|null $finalPrice = null;

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

    /** price */

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string|int|float $price): static
    {
        $this->isNumeric($price);
        $this->price = $price;
        $this->autoSetVatAmountAndFinalPrice();

        return $this;
    }

    /** vatRate */

    public function getVatRate(): ?string
    {
        return $this->vatRate;
    }

    public function setVatRate(string|int|float $vatRate): static
    {
        $this->isNumeric($vatRate);
        $this->vatRate = $vatRate;
        $this->autoSetVatAmountAndFinalPrice();

        return $this;
    }

    /** vatAmount */

    public function getVatAmount(): ?string
    {
        return $this->vatAmount;
    }

    /** finalPrice */

    public function getFinalPrice(): ?string
    {
        return $this->finalPrice;
    }

    /** vatAmount && finalPrice */

    protected function autoSetVatAmountAndFinalPrice(): void
    {
        $this->vatAmount = $this->price * ($this->vatRate / 100);
        $this->finalPrice = $this->price + $this->vatAmount;
    }

    /** Numeric validation */

    protected function isNumeric($value): bool
    {
        if (!is_numeric($value)) {
            throw new \Exception('Invalid data type. It shuld be numeric.');
        }
        return true;
    }

    /** Tools */

    public static function create(array $values): Product
    {
        $product = new Product();
        $product->setName($values['name']);
        $product->setDescription($values['description']);
        $product->setPrice($values['price']);
        $product->setVatRate($values['vatRate']);
        $product->setCurrency(!empty($values['currency']) ? $values['currency'] : 'USD');
        return $product;
    }

    public function getProps(): array
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