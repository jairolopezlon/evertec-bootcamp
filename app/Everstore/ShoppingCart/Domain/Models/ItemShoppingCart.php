<?php

namespace App\Everstore\ShoppingCart\Domain\Models;

use App\Everstore\Products\Domain\ValuesObjects\ProductId;

class ItemShoppingCart
{
    public function __construct(
        private readonly ProductId $productId,
        private readonly string $name,
        private readonly string $description,
        private readonly string $slug,
        private readonly string $imageUrl,
        private readonly float $price,
        private readonly float $subTotal,
        private int $amount,
    ) {
    }

    public function incrementAmount(int $amount): void
    {
        $this->amount += abs($amount);
    }

    public function decrementAmount(int $amount): void
    {
        $this->amount -= abs($amount);
    }

    public function setAmount(int $amount): void
    {
        $this->amount = abs($amount);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSubTotal(): float
    {
        return $this->subTotal;
    }
}
