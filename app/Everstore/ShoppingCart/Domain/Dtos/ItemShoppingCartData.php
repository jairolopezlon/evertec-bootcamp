<?php

namespace App\Everstore\ShoppingCart\Domain\Dtos;

use App\Everstore\Shared\Domain\Types\Types;
use App\Everstore\ShoppingCart\Domain\Models\ItemShoppingCart;

/**
 * @phpstan-import-type ItemShoppingCartNative from Types
 */
class ItemShoppingCartData
{
    public function __construct(private readonly ItemShoppingCart $itemShoppingCart)
    {
    }

    /**
     * @return ItemShoppingCartNative
     */
    public function toArray()
    {
        return [
            'amount' => $this->itemShoppingCart->getAmount(),
            'description' => $this->itemShoppingCart->getDescription(),
            'imageUrl' => $this->itemShoppingCart->getImageUrl(),
            'name' => $this->itemShoppingCart->getName(),
            'price' => $this->itemShoppingCart->getPrice(),
            'productId' => $this->itemShoppingCart->getProductId()->value(),
            'slug' => $this->itemShoppingCart->getSlug(),
            'subTotal' => $this->itemShoppingCart->getSubTotal(),
        ];
    }
}
