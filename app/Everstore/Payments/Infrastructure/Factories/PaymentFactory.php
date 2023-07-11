<?php

namespace App\Everstore\Payments\Infrastructure\Factories;

use App\Everstore\Orders\Infrastructure\Persistence\Eloquent\EloquentOrderRepositoryImpl;
use App\Everstore\Payments\Domain\Services\PaymentServicesInterface;
use App\Everstore\Payments\Infrastructure\Services\Placetopay\PlacetopayServicesImpl;
use App\Everstore\ShoppingCart\Infrastructure\Persistence\SessionStorage\SessionStorageShoppingCartRepositoryImpl;
use Exception;

class PaymentFactory
{
    public static function getPaymentProcesorService(string $paymentProvider): PaymentServicesInterface
    {
        if ($paymentProvider === 'PLACETOPAY') {
            return new PlacetopayServicesImpl(
                new EloquentOrderRepositoryImpl(),
                new SessionStorageShoppingCartRepositoryImpl()
            );
        }

        throw new Exception("Payment provider \"{$paymentProvider}\" is not support it");
    }
}
