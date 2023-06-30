<?php

namespace App\Everstore\Checkout\Application\Actions;

use App\Everstore\Checkout\Domain\Services\CheckoutServiceInterface;
use App\Everstore\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 */
class ValidationShoppingCartITemsAction
{
    public function __construct(
        private readonly CheckoutServiceInterface $checkoutServiceInterface
    ) {
    }

    /**
     * @return array<ValidatedItemShoppingCartNative>
     */
    public function __invoke(): array
    {
        return $this->checkoutServiceInterface->validateProductInShoppingCart();
    }
}
