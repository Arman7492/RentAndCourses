<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

class OrderTest extends TestCase
{
    public function test_asserting_an_exact_json_match(): void
    {
        $data = Order::factory()->raw();
        $response = $this->postJson('/api/createOrders', $data);

        $response->assertStatus(201)
                ->assertJsonPath('order_date', $data['order_date'])
                ->assertJsonPath('order_number', $data['order_number'])
                ->assertJsonPath('customer_id', $data['customer_id'])
                ->assertJsonPath('total_amount', (string)$data['total_amount']) // Приведение total_amount к строке
                ->assertJsonPath('id_cell', $data['id_cell']);
    }

    public function testDatabase()
    {
        $order = Order::factory()->create(['order_number' => 'ORD-12345']);

        $this->assertDatabaseHas('orders', [
            'order_number' => 'ORD-12345'
        ]);
    }

    public function test_update_order()
    {
        $order = Order::factory()->create();
        $updateData = [
            'order_date' => '2024-08-01',
            'order_number' => 'ORD-67890',
            'total_amount' => 299.99
        ];

        $response = $this->postJson("/api/updateOrders/{$order->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJsonPath('order_date', $updateData['order_date'])
                 ->assertJsonPath('order_number', $updateData['order_number'])
                 ->assertJsonPath('total_amount', $updateData['total_amount']);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'order_number' => 'ORD-67890',
            'total_amount' => 299.99
        ]);
    }

    public function test_show_order()
    {
        $order = Order::factory()->create();

        $response = $this->getJson("/api/showOrders/{$order->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $order->id)
                 ->assertJsonPath('order_number', $order->order_number)
                 ->assertJsonPath('total_amount', (string)$order->total_amount); // Приведение total_amount к строке
    }

    public function test_delete_order()
    {
        $order = Order::factory()->create();

        $response = $this->deleteJson("/api/deleteOrders/{$order->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('orders', [
            'id' => $order->id
        ]);
    }

    public function test_list_orders()
    {
        // Очистка базы данных
        Order::truncate();
        Order::factory()->count(3)->create();
    
        $response = $this->getJson('/api/orders');
    
        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'order_date', 'order_number', 'customer_id', 'total_amount', 'id_cell', 'created_at', 'updated_at']
                 ]);
    }

    public function test_create_order_validation_error()
    {
        $data = ['order_date' => '', 'order_number' => '', 'customer_id' => '', 'total_amount' => ''];
    
        $response = $this->postJson('/api/createOrders', $data);
    
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['order_date', 'order_number', 'customer_id', 'total_amount']);
    }
   

    public function test_update_order_not_found()
    {
        $updateData = [
            'order_date' => '2024-08-01',
            'order_number' => 'ORD-67890',
            'total_amount' => 299.99
        ];

        $response = $this->postJson('/api/updateOrders/9999', $updateData);

        $response->assertStatus(404);
    }

    public function test_delete_order_not_found()
    {
        $response = $this->deleteJson('/api/deleteOrders/9999');

        $response->assertStatus(404);
    }

    public function test_show_order_not_found()
    {
        $response = $this->getJson('/api/showOrders/9999');

        $response->assertStatus(404);
    }
}

// namespace Tests\Feature;

// //use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\Order;

// class OrderTest extends TestCase
// {
//     //use RefreshDatabase;

//     public function test_example()
//     {
//         $response = $this->get('/');

//         $response->assertStatus(200);
//     }

//     public function test_asserting_an_exact_json_match(): void
//     {
//         $data = Order::factory()->raw();
//         $response = $this->postJson('/api/createOrders', $data);

//         $response->assertStatus(201)
//                  ->assertJsonPath('order_date', $data['order_date'])
//                  ->assertJsonPath('order_number', $data['order_number'])
//                  ->assertJsonPath('customer_id', $data['customer_id'])
//                  ->assertJsonPath('total_amount', $data['total_amount'])
//                  ->assertJsonPath('id_cell', $data['id_cell']);
//     }

//     public function testDatabase()
//     {
//         $order = Order::factory()->create(['order_number' => 'ORD-12345']);

//         $this->assertDatabaseHas('orders', [
//             'order_number' => 'ORD-12345'
//         ]);
//     }

//     public function test_update_order()
//     {
//         $order = Order::factory()->create();
//         $updateData = [
//             'order_date' => '2024-08-01',
//             'order_number' => 'ORD-67890',
//             'total_amount' => 299.99
//         ];

//         $response = $this->postJson("/api/updateOrders/{$order->id}", $updateData);

//         $response->assertStatus(200)
//                  ->assertJsonPath('order_date', $updateData['order_date'])
//                  ->assertJsonPath('order_number', $updateData['order_number'])
//                  ->assertJsonPath('total_amount', $updateData['total_amount']);

//         $this->assertDatabaseHas('orders', [
//             'id' => $order->id,
//             'order_number' => 'ORD-67890',
//             'total_amount' => 299.99
//         ]);
//     }

//     public function test_show_order()
//     {
//         $order = Order::factory()->create();

//         $response = $this->getJson("/api/showOrders/{$order->id}");

//         $response->assertStatus(200)
//                  ->assertJsonPath('id', $order->id)
//                  ->assertJsonPath('order_number', $order->order_number)
//                  ->assertJsonPath('total_amount', $order->total_amount);
//     }

//     public function test_delete_order()
//     {
//         $order = Order::factory()->create();

//         $response = $this->deleteJson("/api/deleteOrders/{$order->id}");

//         $response->assertStatus(200);

//         $this->assertDatabaseMissing('orders', [
//             'id' => $order->id
//         ]);
//     }

//     public function test_list_orders()
//     {
//         Order::factory()->count(3)->create();

//         $response = $this->getJson('/api/orders');

//         $response->assertStatus(200)
//                  ->assertJsonCount(3)
//                  ->assertJsonStructure([
//                      '*' => ['id', 'order_date', 'order_number', 'customer_id', 'total_amount', 'id_cell', 'created_at', 'updated_at']
//                  ]);
//     }

//     public function test_create_order_validation_error()
//     {
//         $data = ['order_date' => '', 'order_number' => '', 'customer_id' => '', 'total_amount' => ''];

//         $response = $this->postJson('/api/createOrders', $data);

//         $response->assertStatus(422)
//                  ->assertJsonValidationErrors(['order_date', 'order_number', 'customer_id', 'total_amount']);
//     }

//     public function test_update_order_not_found()
//     {
//         $updateData = [
//             'order_date' => '2024-08-01',
//             'order_number' => 'ORD-67890',
//             'total_amount' => 299.99
//         ];

//         $response = $this->postJson('/api/updateOrders/9999', $updateData);

//         $response->assertStatus(404);
//     }

//     public function test_delete_order_not_found()
//     {
//         $response = $this->deleteJson('/api/deleteOrders/9999');

//         $response->assertStatus(404);
//     }

//     public function test_show_order_not_found()
//     {
//         $response = $this->getJson('/api/showOrders/9999');

//         $response->assertStatus(404);
//     }
// }






// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\Order;

// class OrderTest extends TestCase
// {
//     /**
//      * A basic feature test example.
//      *
//      * @return void
//      */
//     public function test_example()
//     {
//         $response = $this->get('/');

//         $response->assertStatus(200);
//     }

//     public function test_asserting_an_exact_json_match(): void
//     {
//         $data = Order::factory()->raw();
//         $response = $this->postJson('/api/createOrders', $data);
        
//         $response
//             ->assertStatus(201)
//             ->assertJsonPath('order_date',$data['order_date'])
//             ->assertJsonPath('order_number',$data['order_number'])
//             ->assertJsonPath('customer_id',$data['customer_id'])
//             ->assertJsonPath('total_amount',$data['total_amount'])
//             ->assertJsonPath('id_cell',$data['id_cell']);
//     }

// }
