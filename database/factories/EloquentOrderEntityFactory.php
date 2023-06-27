<?php

namespace Database\Factories;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use App\Everstore\Orders\Domain\Enums\PaymentStatusEnum;
use App\Everstore\Orders\Infrastructure\Persistence\Eloquent\EloquentOrderEntity;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EloquentOrderEntity>
 */
class EloquentOrderEntityFactory extends Factory
{
    protected $model = EloquentOrderEntity::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomUser = Customer::where('is_enabled', true)->pluck('user_id')->toArray();

        return [
            'payment_provider' => PaymentProviderEnum::enumGetRandomValue(),
            'user_id' => array_rand($randomUser),
            'total' => 0,
            'payment_status' => PaymentStatusEnum::enumGetRandomValue(),
            'currency' => PaymentCurrencyEnum::enumGetRandomValue(),
            'payment_id' => null,
            'payment_url' => null,
        ];
    }
}
