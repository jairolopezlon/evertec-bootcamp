<?php

namespace Src\Checkout\Application\Actions;

use Src\Checkout\Domain\Services\CheckoutServiceInterface;
use Src\Shared\Domain\Types\Types;

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
    public function __invoke()
    {
        return $this->checkoutServiceInterface->validateProductInShoppingCart();
    }
}
