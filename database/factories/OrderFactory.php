<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Customer;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'order_date' => fake()->dateTime(),
            'order_number' => 'ORD-' . fake()->unique()->numberBetween(10000, 99999), // Изменено на строку
            'customer_id' => Customer::all()->random()->id,
            'total_amount' => fake()->randomFloat(2, 500, 100000), // Изменено на decimal
            'id_cell' => fake()->numerify('#########'),
        ];
    }
}



// namespace Database\Factories;

// use Illuminate\Database\Eloquent\Factories\Factory;
// use App\Models\Order;
// use App\Models\Customer;

// class OrderFactory extends Factory
// {
//     protected $model = Order::class;

//     public function definition()
//     {
//         return [
//             'order_date' => fake()->dateTime(),
//             'order_number' => 'ORD-' . fake()->unique()->numberBetween(10000, 99999), // Изменено на строку
//             'customer_id' => Customer::all()->random()->id,
//             'total_amount' => fake()->randomFloat(2, 500, 100000), // Изменено на decimal
//             'id_cell' => fake()->numerify('#########'),
//         ];
//     }
// }



// namespace Database\Factories;

// use Illuminate\Database\Eloquent\Factories\Factory;

// use App\Models\Order;
// use App\Models\Customer;

// /**
//  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
//  */
// class OrderFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition()
//     {
//         return [
//             'order_date' => fake()->date(),
//             'order_number' => fake()->numberBetween(1, 100),
//             'customer_id' => Customer::all()->random()->id,
//             'total_amount' => fake()->numberBetween(500, 100000),
//             'id_cell' => fake()->numerify('#########'),
//         ];
//     }
// }
