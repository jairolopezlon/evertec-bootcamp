<?php

namespace Src\Orders\Domain\Repositories;

use Src\Orders\Domain\Enums\PaymentCurrencyEnum;
use Src\Orders\Domain\Enums\PaymentProviderEnum;
use Src\Orders\Domain\Models\Order;
use Src\Shared\Domain\Types\Types;

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
}
