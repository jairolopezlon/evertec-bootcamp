<?php

namespace App\Everstore\ShoppingCart\Application\Actions;

use App\Everstore\Products\Domain\ValuesObjects\ProductId;
use App\Everstore\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use App\Everstore\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

class RemoveItemShoppingCartAction
{
    public function __construct(
        private readonly ShoppingCartRepositoryInterface $shoppingCartRepository
    ) {
    }

    public function __invoke(ProductId $productId): ItemsShoppingCartData
    {
        $shoppingCart = $this->shoppingCartRepository->removeItem($productId);
        $shoppingCartData = new ItemsShoppingCartData($shoppingCart);

        return $shoppingCartData;
    }
}
