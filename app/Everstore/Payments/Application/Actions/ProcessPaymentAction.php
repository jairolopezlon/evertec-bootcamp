<?php

namespace App\Everstore\Payments\Application\Actions;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use App\Everstore\Payments\Infrastructure\Factories\PaymentFactory;
use App\Everstore\Shared\Domain\Types\Types;
use Illuminate\Http\RedirectResponse;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 */
class ProcessPaymentAction
{
    /**
     * @param  ValidatedItemShoppingCartNative  $shoppingCartData
     */
    public static function execute(
        PaymentProviderEnum $paymentProvider,
        PaymentCurrencyEnum $paymentCurrency,
        $shoppingCartData
    ): RedirectResponse {
        $paymentProcessorService = PaymentFactory::getPaymentProcesorService($paymentProvider->value);

        return $paymentProcessorService->pay($paymentProvider, $paymentCurrency, $shoppingCartData);
    }
}
