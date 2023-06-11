<?php

namespace Src\Checkout\Domain\Services;

use Src\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 */
interface CheckoutServiceInterface
{
    /**
     * @return array<ValidatedItemShoppingCartNative>
     */
    public function validateProductInShoppingCart();
}
