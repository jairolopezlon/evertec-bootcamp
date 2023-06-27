<?php

namespace App\Everstore\ShoppingCart\Domain\Dtos;

use App\Everstore\Shared\Domain\Types\Types;
use App\Everstore\ShoppingCart\Domain\Models\ItemShoppingCart;
use App\Everstore\ShoppingCart\Domain\Models\ShoppingCart;
use JsonSerializable;

/**
 * @phpstan-import-type ItemShoppingCartNative from Types
 */
class ItemsShoppingCartData implements JsonSerializable
{
    public function __construct(private readonly ShoppingCart $shoppingCart)
    {
    }

    /**
     * @return array<ItemShoppingCartNative>
     */
    public function toArray()
    {
        return array_map(function (ItemShoppingCart $item) {
            return (new ItemShoppingCartData($item))->toArray();
        }, $this->shoppingCart->getItemsCart());
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
