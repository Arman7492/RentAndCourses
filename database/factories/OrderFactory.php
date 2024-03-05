<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Order;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_date' => fake()->date(),
            'order_number' => fake()->numberBetween(1, 100),
            'customer_id' => Customer::all()->random()->id,
            'total_amount' => fake()->numberBetween(500, 100000),
            'id_cell' => fake()->numerify('#########'),
        ];
    }
}
