<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создание категорий, если это необходимо
        $categories = Category::factory()->count(10)->create();

        // Создание продуктов
        Product::factory()
            ->count(50)
            ->create();
    }
}



// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use App\Models\Product;
// use App\Models\Category;

// class ProductSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         // Создание категорий, если это необходимо
//         Category::factory()->count(10)->create();

//         // Создание продуктов
//         Product::factory()
//             ->count(50)
//             ->create();
//     }
// }




// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use App\Models\Product;

// class ProductSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         Product::factory()
//         ->count(50)
//         ->create();
//     }
// }
