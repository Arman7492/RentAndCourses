<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создание корневых категорий (без родителя)
        Category::factory()
            ->count(10)  // Количество корневых категорий
            ->create();

        // Создание подкатегорий (с родителем)
        Category::factory()
            ->count(40)  // Количество подкатегорий
            ->create([
                'parent_id' => Category::inRandomOrder()->first()->id // Присваивание случайного родителя
            ]);
    }
}



// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use App\Models\Category;

// class CategorySeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         Category::factory()
//         ->count(50)
//         ->create();
//     }
// }
