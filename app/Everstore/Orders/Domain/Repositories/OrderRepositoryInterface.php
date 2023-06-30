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
     * @param  ValidatedItemShoppingCartNative  $shoppingCartData
     */
    public function createOrder(
        PaymentProviderEnum $paymentProvider,
        PaymentCurrencyEnum $paymentCurrency,
        $shoppingCartData
    ): Order;

    /**
     * @return array<Order>
     */
    public function listOrdersByUser(): array;
}
