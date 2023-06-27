<?php

namespace App\Everstore\Checkout\Domain\Services;

use App\Everstore\Shared\Domain\Types\Types;

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
