<?php

namespace Database\Factories;

use App\Everstore\Orders\Infrastructure\Persistence\Eloquent\EloquentOrderDetailEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

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
