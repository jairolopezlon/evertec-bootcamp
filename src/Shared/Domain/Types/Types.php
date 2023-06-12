<?php

namespace Src\Shared\Domain\Types;

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
 * @phpstan-type CheckoutDataToUpdate array{ price?: float, amount?: int }
 * @phpstan-type OrderPrimitive array{
 * orderId: string,
 * paymentProvider: string,
 * userId: string,
 * total: float,
 * paymentStatus: 'CANCELLED' | 'COMPLETED' | 'NOT_STARTED' | 'PROCESSING',
 * currency: string,
 * paymentId?: string|null,
 * paymentUrl?: string|null,
 * orderDateTimestamp: int,
 * orderDetails: array<OrderDetailPrimitive>,
 * }
 * @phpstan-type OrderDetailPrimitive array{
 * orderDetailId: string,
 * orderId: string,
 * productId: string,
 * productName: string,
 * price: float,
 * quantity: int,
 * subtotal: float,
 * }
 */
class Types
{
}
