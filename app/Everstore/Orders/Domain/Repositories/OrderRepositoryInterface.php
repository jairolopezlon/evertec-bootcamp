<?php

namespace App\Everstore\Orders\Domain\Repositories;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use App\Everstore\Orders\Domain\Models\Order;
use App\Everstore\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 */
interface OrderRepositoryInterface
{
    /**
     * @param  PaymentProviderEnum  $paymentProvider
     * @param  PaymentCurrencyEnum  $paymentCurrency
     * @param  ValidatedItemShoppingCartNative  $shoppingCartData
     */
    public function createOrder($paymentProvider, $paymentCurrency, $shoppingCartData): Order;

    /**
     * @return array<Order>
     */
    public function listOrdersByUser(): array;
}
