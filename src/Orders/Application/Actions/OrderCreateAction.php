<?php

namespace Src\Orders\Application\Actions;

use Src\Orders\Domain\Enums\PaymentCurrencyEnum;
use Src\Orders\Domain\Enums\PaymentProviderEnum;
use Src\Orders\Domain\Models\Order;
use Src\Orders\Domain\Repositories\OrderRepositoryInterface;
use Src\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 */
class OrderCreateAction
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepositoryInterface
    ) {
    }

    /**
     * @param  PaymentProviderEnum  $paymentProvider
     * @param  PaymentCurrencyEnum  $paymentCurrency
     * @param  ValidatedItemShoppingCartNative  $shoppingCartData
     * @return Order
     */
    public function __invoke($paymentProvider, $paymentCurrency, $shoppingCartData)
    {
        return $this->orderRepositoryInterface->createOrder($paymentProvider, $paymentCurrency, $shoppingCartData);
    }
}
