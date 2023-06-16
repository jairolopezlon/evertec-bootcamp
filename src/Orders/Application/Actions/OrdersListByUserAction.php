<?php

namespace Src\Orders\Application\Actions;

use Src\Orders\Domain\Dtos\OrderListData;
use Src\Orders\Domain\Models\Order;
use Src\Orders\Domain\Repositories\OrderRepositoryInterface;
use Src\Shared\Domain\Types\Types;

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
