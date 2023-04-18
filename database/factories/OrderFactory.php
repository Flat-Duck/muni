<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(10),
            'status' => \Arr::random(['إنتظار']),
            'active' => $this->faker->boolean,
            'order_type_id' => \App\Models\OrderType::factory(),
            'user_id' => \App\Models\User::factory(),
            'municipality_id' => \App\Models\Municipality::factory(),
        ];
    }
}
