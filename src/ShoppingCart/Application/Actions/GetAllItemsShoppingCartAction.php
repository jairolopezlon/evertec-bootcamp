<?php

namespace Src\ShoppingCart\Application\Actions;

use Src\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

/**
 * @phpstan-type PrimitiveItemShoppingCartData array{productId: string, amount: int}
 */
class GetAllItemsShoppingCartAction
{
    public function __construct(
        private readonly ShoppingCartRepositoryInterface $shoppingCartRepository
    ) {
    }

    /**
     * Summary of __invoke
     *
     * @return array<PrimitiveItemShoppingCartData>
     */
    public function __invoke()
    {
        $shoppingCartData = $this->shoppingCartRepository->getAll();

        return $shoppingCartData->toArray();
    }
}
