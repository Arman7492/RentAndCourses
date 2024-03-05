<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Instructor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => Order::all()->random()->id,
            'product_id' => Product::all()->random()->id,
            'unit_price' => fake()->numberBetween(3000, 75000),
            'total_amount' => fake()->numberBetween(500, 100000),
            'quantity' => fake()->numberBetween(1, 30),
            'instructor_id' => Instructor::all()->random()->id,
            'rent_price' => fake()->numerify(),
            'return_date' => fake()->date()
        ];
    }
}
