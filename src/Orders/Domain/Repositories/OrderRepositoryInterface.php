<?php

namespace Src\Orders\Domain\Repositories;

use Src\Orders\Domain\Models\Order;
use Src\Shared\Domain\Types\Types;
use Src\Orders\Domain\Enums\PaymentProviderEnum;
use Src\Orders\Domain\Enums\PaymentCurrencyEnum;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 */
interface OrderRepositoryInterface
{
    /**
     * @param PaymentProviderEnum $paymentProvider
     * @param PaymentCurrencyEnum $paymentCurrency
     * @param ValidatedItemShoppingCartNative $shoppingCartData
     * @return Order
     */
    public function createOrder($paymentProvider, $paymentCurrency, $shoppingCartData): Order;
}
