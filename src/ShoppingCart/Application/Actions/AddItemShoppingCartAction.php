<?php

namespace Src\ShoppingCart\Application\Actions;

use Src\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use Src\ShoppingCart\Domain\Models\ItemShoppingCart;
use Src\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

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
