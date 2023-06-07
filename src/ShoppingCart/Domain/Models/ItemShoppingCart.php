<?php

namespace Src\ShoppingCart\Domain\Models;

use Src\Products\Domain\ValuesObjects\ProductId;

class ItemShoppingCart
{
    public function __construct(
        private ProductId $productId,
        private ?int $amount
    ) {
        $this->productId = $productId;
        $this->amount = $amount ?? 1;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    public function incrementAmount(int $amount): void
    {
        $this->amount += abs($amount);
    }

    public function decreaseAmount(int $amount): void
    {
        $this->amount -= abs($amount);
    }
}
