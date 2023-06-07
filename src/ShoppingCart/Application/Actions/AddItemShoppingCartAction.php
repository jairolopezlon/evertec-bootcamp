<?php

namespace Src\ShoppingCart\Application\Actions;

use Src\Products\Domain\ValuesObjects\ProductId;
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

    /**
     * @return array<PrimitiveItemShoppingCartData>
     */
    public function __invoke(ProductId $productId, ?int $amount): array
    {
        $itemShoppingCart = new ItemShoppingCart($productId, $amount);

        $shoppingCartData = $this->shoppingCartRepository->addItem($itemShoppingCart);

        return $shoppingCartData->toArray();
    }
}
