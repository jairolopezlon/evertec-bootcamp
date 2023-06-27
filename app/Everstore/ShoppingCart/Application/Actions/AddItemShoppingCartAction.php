<?php

namespace App\Everstore\ShoppingCart\Application\Actions;

use App\Everstore\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use App\Everstore\ShoppingCart\Domain\Models\ItemShoppingCart;
use App\Everstore\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

/**
 * @phpstan-type PrimitiveItemShoppingCartData array{productId: string, amount: int}
 */
class AddItemShoppingCartAction
{
    public function __construct(
        private readonly ShoppingCartRepositoryInterface $shoppingCartRepository
    ) {
    }

    public function __invoke(ItemShoppingCart $itemShoppingCart): ItemsShoppingCartData
    {
        $shoppingCart = $this->shoppingCartRepository->addItem($itemShoppingCart);
        $shoppingCartData = new ItemsShoppingCartData($shoppingCart);

        return $shoppingCartData;
    }
}
