<?php

namespace App\Everstore\Orders\Application\Actions;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use App\Everstore\Orders\Domain\Models\Order;
use App\Everstore\Orders\Domain\Repositories\OrderRepositoryInterface;
use App\Everstore\Shared\Domain\Types\Types;

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
