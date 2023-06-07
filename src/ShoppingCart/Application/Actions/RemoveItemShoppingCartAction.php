<?php

namespace Src\ShoppingCart\Application\Actions;

use Src\Products\Domain\ValuesObjects\ProductId;
use Src\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

/**
 * @phpstan-type PrimitiveItemShoppingCartData array{productId: string, amount: int}
 */
class RemoveItemShoppingCartAction
{
    public function __construct(
        private readonly ShoppingCartRepositoryInterface $shoppingCartRepository
    ) {
    }

    /**
     * @return array<PrimitiveItemShoppingCartData>
     */
    public function __invoke(ProductId $productId): array
    {
        $shoppingCartData = $this->shoppingCartRepository->removeItem($productId);

        return $shoppingCartData->toArray();
    }
}
