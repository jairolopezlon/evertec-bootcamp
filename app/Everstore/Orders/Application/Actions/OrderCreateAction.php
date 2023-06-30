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
     * @param  ValidatedItemShoppingCartNative  $shoppingCartData
     */
    public function __invoke(
        PaymentProviderEnum $paymentProvider,
        PaymentCurrencyEnum $paymentCurrency,
        $shoppingCartData
    ): Order {
        return $this->orderRepositoryInterface->createOrder($paymentProvider, $paymentCurrency, $shoppingCartData);
    }
}
