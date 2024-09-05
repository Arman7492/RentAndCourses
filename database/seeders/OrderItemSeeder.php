<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Instructor;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Order::count() === 0) {
            Order::factory()->create(); // или выбросить исключение
        }
        
        if (Product::count() === 0) {
            Product::factory()->create(); // или выбросить исключение
        }
        
        if (Instructor::count() === 0) {
            Instructor::factory()->create(); // или выбросить исключение
        }
        
        return [
            'order_id' => Order::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'instructor_id' => Instructor::inRandomOrder()->first()->id,
            // другие поля
        ];

        // Создаем записи OrderItem
        OrderItem::factory()
            ->count(50)
            ->create();
    }
}



// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use App\Models\OrderItem;

// class OrderItemSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         OrderItem::factory()
//         ->count(50)
//         ->create();
//     }
// }
