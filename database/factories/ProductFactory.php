<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'product_name' => $this->faker->word(),
            'category_id' => \App\Models\Category::factory(), // Создание связанной категории
            'unit_price' => $this->faker->randomFloat(2, 10, 1000), // Генерация случайной цены
        ];
    }
}



// namespace Database\Factories;

// use App\Models\Product;
// use Illuminate\Database\Eloquent\Factories\Factory;

// class ProductFactory extends Factory
// {
//     protected $model = Product::class;

//     public function definition()
//     {
//         return [
//             'product_name' => $this->faker->word(),
//             'category_id' => \App\Models\Category::factory(), // Предполагаем, что у вас есть связь с Category
//             'unit_price' => $this->faker->randomFloat(2, 10, 1000),

//         ];
//     }
// }



// namespace Database\Factories;

// use Illuminate\Database\Eloquent\Factories\Factory;

// use App\Models\Product;
// use App\Models\Category;

// /**
//  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
//  */
// class ProductFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition()
//     {
//         return [
//             'product_name' => fake()->word(), 
//             'category_id' => Category::all()->random()->id,
//             'unit_price' => fake()->numberBetween(100, 75000)

//         ];
//     }
// }
