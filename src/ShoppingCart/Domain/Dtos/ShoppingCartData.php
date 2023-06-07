<?php

namespace Src\ShoppingCart\Domain\Dtos;

use Src\ShoppingCart\Domain\Models\ItemShoppingCart;
use Src\ShoppingCart\Domain\Models\ShoppingCart;

/**
 * @phpstan-type PrimitiveItemShoppingCartData array{productId: string, amount: int}
 */
class ShoppingCartData
{
    public function __construct(private readonly ShoppingCart $shoppingCart)
    {
    }

    /**
     * Summary of toArray
     *
     * @return array<PrimitiveItemShoppingCartData>
     */
    public function toArray()
    {
        return array_map(function (ItemShoppingCart $item) {
            return (new ItemShoppingCartData($item))->toArray();
        }, $this->shoppingCart->getItemsCart());
    }
}
