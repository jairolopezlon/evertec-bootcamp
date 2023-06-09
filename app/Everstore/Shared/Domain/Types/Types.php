<?php

namespace App\Everstore\Shared\Domain\Types;

/**
 * @phpstan-type ItemShoppingCartNative array{
 * amount: int,
 * description: string,
 * imageUrl: string,
 * name: string,
 * price: float,
 * productId: string,
 * slug: string,
 * subTotal: float,
 * }
 * @phpstan-type ValidatedItemShoppingCartNative array{
 * amount: int,
 * description: string,
 * imageUrl: string,
 * name: string,
 * price: float,
 * oldPrice?: float,
 * productId: string,
 * slug: string,
 * subTotal: float,
 * validation?: array<string>,
 * currentStock?: int,
 * }
 * @phpstan-type CheckoutDataToUpdate array{
 * price?: float,
 * amount?: int
 * }
 * @phpstan-type OrderListPrimitive array{
 * orderId: string,
 * paymentProvider: string,
 * userId: string,
 * total: float,
 * paymentStatus: 'CANCELLED' | 'COMPLETED' | 'NOT_STARTED' | 'PROCESSING',
 * currency: 'COP' | 'USD',
 * }
 * @phpstan-type OrderPrimitive array{
 * orderId: string,
 * paymentProvider: string,
 * userId: string,
 * total: float,
 * paymentStatus: 'CANCELLED' | 'COMPLETED' | 'NOT_STARTED' | 'PROCESSING',
 * currency: 'COP' | 'USD',
 * paymentId: string|null,
 * paymentUrl: string|null,
 * orderDetails: array<OrderDetailPrimitive>,
 * }
 * @phpstan-type OrderDetailPrimitive array{
 * orderDetailId: string,
 * orderId: string,
 * productId: string,
 * productName: string,
 * productPrice: float,
 * quantity: int,
 * subtotal: float,
 * }
 * @phpstan-type PaymentInfo array{
 * status?: 'CANCELLED' | 'COMPLETED' | 'NOT_STARTED' | 'PROCESSING',
 * paymentId?: string,
 * paymentUrl?: string,
 * }
 * @phpstan-type PaymentResponseData array{
 * status: 'CANCELLED' | 'COMPLETED' | 'NOT_STARTED' | 'PROCESSING',
 * message: string,
 * orderId: string,
 * }
 * @phpstan-type PaymentResponse array{
 * status: string,
 * message: string,
 * reason: string,
 * date: string,
 * }
 * @phpstan-type PlacetoPayAuthData array{
 * login: string,
 * tranKey: string,
 * nonce: string,
 * seed: string,
 * }
 * @phpstan-type PaymentProviderAndOrderId array{
 * orderId: string,
 * paymentProvider: string,
 * }
 * @phpstan-type ProductPrimitive array{
 * id: string,
 * imageUrl: string,
 * isEnable: bool,
 * name: string,
 * price: float,
 * slug: string,
 * description: string,
 * }
 * @phpstan-type PlacetoPayPaymentAmountData array{
 * currency: string,
 * total: float,
 * }
 * @phpstan-type PlacetoPayPaymentData array{
 * reference: string,
 * description: string,
 * amount: PlacetoPayPaymentAmountData,
 * }
 * @phpstan-type PlacetoPayPaymentOrderData array{
 * payment: PlacetoPayPaymentData,
 * expiration: string,
 * returnUrl: string,
 * ipAddress: string,
 * userAgent: string,
 * }
 */
class Types
{
}
