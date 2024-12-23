<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Enums\OrderTypeEnum;
use App\Enums\StatusEnum;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'total_amount' => $this->faker->randomFloat(2, 1, 1000),
            'status' => StatusEnum::cases()[array_rand(StatusEnum::cases())]->value,
            'order_type' => OrderTypeEnum::cases()[array_rand(OrderTypeEnum::cases())]->value,
            'invoice_id' => $this->faker->uuid(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::first(),
            'notes' => $this->faker->sentence(),
            'paid' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
