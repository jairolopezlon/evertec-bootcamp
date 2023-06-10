<?php

namespace Src\ShoppingCart\Domain\Dtos;

use JsonSerializable;
use Src\Shared\Domain\Types\Types;
use Src\ShoppingCart\Domain\Models\ItemShoppingCart;
use Src\ShoppingCart\Domain\Models\ShoppingCart;

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
