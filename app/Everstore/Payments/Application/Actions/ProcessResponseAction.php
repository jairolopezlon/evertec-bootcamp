<?php

namespace App\Everstore\Payments\Application\Actions;

use App\Everstore\Payments\Infrastructure\Factories\PaymentFactory;
use App\Everstore\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type PaymentResponseData from Types
 */
class ProcessResponseAction
{
    /**
     * @return PaymentResponseData
     */
    public static function execute(string $orderId, string $paymentProvider)
    {
        $paymentProcessorService = PaymentFactory::getPaymentProcesorService($paymentProvider);

        return $paymentProcessorService->paymentHandlerResponse($orderId);
    }
}
