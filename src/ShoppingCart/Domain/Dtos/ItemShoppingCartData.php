<?php

namespace Src\ShoppingCart\Domain\Dtos;

use Src\ShoppingCart\Domain\Models\ItemShoppingCart;

/**
 * @phpstan-type PrimitiveItemShoppingCartData array{productId: string, amount: int}
 */
class ItemShoppingCartData
{
    public function __construct(private readonly ItemShoppingCart $itemShoppingCart)
    {
    }

    /**
     * @return PrimitiveItemShoppingCartData
     */
    public function toArray()
    {
        return [
            'productId' => $this->itemShoppingCart->getProductId()->value(),
            'amount' => $this->itemShoppingCart->getAmount(),
        ];
    }
}
