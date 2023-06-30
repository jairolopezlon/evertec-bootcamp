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
 * paymentId?: string|null,
 * paymentUrl?: string|null,
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
 * @phpstan-type ProductPrimitive array{
 * id: string,
 * imageUrl: string,
 * isEnable: bool,
 * name: string,
 * price: float,
 * slug: string,
 * description: string,
 * }
 */
class Types
{
}
