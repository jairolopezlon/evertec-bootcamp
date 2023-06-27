<?php

namespace App\Everstore\Orders\Application\Actions;

use App\Everstore\Orders\Domain\Dtos\OrderListData;
use App\Everstore\Orders\Domain\Models\Order;
use App\Everstore\Orders\Domain\Repositories\OrderRepositoryInterface;
use App\Everstore\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type OrderListPrimitive from Types
 */
class OrdersListByUserAction
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepositoryInterface
    ) {
    }

    /**
     * @return array<OrderListPrimitive>
     */
    public function __invoke()
    {
        $ordersByUser = $this->orderRepositoryInterface->listOrdersByUser();

        return array_map(function (Order $orderDomain) {
            return (new OrderListData($orderDomain))->toArray();
        }, $ordersByUser);
    }
}
