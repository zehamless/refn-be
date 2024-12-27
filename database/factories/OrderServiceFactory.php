<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderServiceFactory extends Factory
{
    protected $model = OrderService::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(),
            'quantity' => $this->faker->randomNumber(),
            'color' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'order_id' => Order::inRandomOrder()->first(),
        ];
    }
}
