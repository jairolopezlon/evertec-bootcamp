<?php

namespace Database\Factories\Src\Orders\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;
use Src\Orders\Infrastructure\Persistence\Eloquent\EloquentOrderDetailEntity;

/**
 * @extends Factory<EloquentOrderDetailEntity>
 */
class EloquentOrderDetailEntityFactory extends Factory
{
    protected $model = EloquentOrderDetailEntity::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // valores seran pasados en el momento de instanciacion
        return [
            'order_id' => null,
            'product_id' => null,
            'product_name' => null,
            'product_price' => null,
            'quantity' => null,
            'subtotal' => null,
        ];
    }
}
