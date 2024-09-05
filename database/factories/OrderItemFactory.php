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
            'order_id' => Order::inRandomOrder()->first()->id, // Выбор случайного Order
            'product_id' => Product::inRandomOrder()->first()->id, // Выбор случайного Product
            'unit_price' => $this->faker->numberBetween(3000, 75000), // Генерация случайной цены за единицу
            'total_amount' => $this->faker->numberBetween(500, 100000), // Генерация случайной суммы заказа
            'quantity' => $this->faker->numberBetween(1, 30), // Генерация случайного количества
            'instructor_id' => Instructor::inRandomOrder()->first()->id, // Выбор случайного Instructor
            'rent_price' => $this->faker->numberBetween(500, 10000), // Генерация случайной цены аренды
            'return_date' => $this->faker->dateTimeBetween('now', '+1 year'), // Генерация случайной даты возврата
        ];
    }
}



// namespace Database\Factories;

// use Illuminate\Database\Eloquent\Factories\Factory;

// use App\Models\OrderItem;
// use App\Models\Order;
// use App\Models\Product;
// use App\Models\Instructor;

// /**
//  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
//  */
// class OrderItemFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition()
//     {
//         return [
//             'order_id' => Order::all()->random()->id,
//             'product_id' => Product::all()->random()->id,
//             'unit_price' => fake()->numberBetween(3000, 75000),
//             'total_amount' => fake()->numberBetween(500, 100000),
//             'quantity' => fake()->numberBetween(1, 30),
//             'instructor_id' => Instructor::all()->random()->id,
//             'rent_price' => fake()->numerify(),
//             'return_date' => fake()->date()
//         ];
//     }
// }
