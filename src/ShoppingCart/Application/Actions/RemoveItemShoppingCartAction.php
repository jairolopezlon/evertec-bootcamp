<?php

namespace Src\ShoppingCart\Application\Actions;

use Src\Products\Domain\ValuesObjects\ProductId;
use Src\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use Src\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

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
