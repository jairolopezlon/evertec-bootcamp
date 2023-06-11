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
 */
class Types
{
}
