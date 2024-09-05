<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\OrderItem;

class OrderItemTest extends TestCase
{
    //use RefreshDatabase;

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_asserting_an_exact_json_match(): void
    {
        $data = OrderItem::factory()->raw();
        $response = $this->postJson('/api/createOrderItems', $data);

        $response->assertStatus(201)
                 ->assertJsonPath('order_id', $data['order_id'])
                 ->assertJsonPath('product_id', $data['product_id'])
                 ->assertJsonPath('unit_price', $data['unit_price'])
                 ->assertJsonPath('total_amount', $data['total_amount'])
                 ->assertJsonPath('quantity', $data['quantity'])
                 ->assertJsonPath('instructor_id', $data['instructor_id'])
                 ->assertJsonPath('rent_price', $data['rent_price'])
                 ->assertJsonPath('return_date', $data['return_date']);
    }

    public function testDatabase()
    {
        $orderItem = OrderItem::factory()->create(['instructor_id' => '401']);

        $this->assertDatabaseHas('orderitems', [
            'instructor_id' => '401'
        ]);
    }

    public function test_update_order_item()
    {
        $orderItem = OrderItem::factory()->create();
        $updateData = [
            'unit_price' => 150.50,
            'quantity' => 2,
            'total_amount' => 301.00,
            'rent_price' => 50.00,
            'return_date' => '2024-09-01'
        ];

        $response = $this->postJson("/api/updateOrderItems/{$orderItem->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJsonPath('unit_price', $updateData['unit_price'])
                 ->assertJsonPath('quantity', $updateData['quantity'])
                 ->assertJsonPath('total_amount', $updateData['total_amount'])
                 ->assertJsonPath('rent_price', $updateData['rent_price'])
                 ->assertJsonPath('return_date', $updateData['return_date']);

        $this->assertDatabaseHas('orderitems', [
            'id' => $orderItem->id,
            'unit_price' => 150.50,
            'total_amount' => 301.00
        ]);
    }

    public function test_show_order_item()
    {
        $orderItem = OrderItem::factory()->create();

        $response = $this->getJson("/api/showOrderItems/{$orderItem->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $orderItem->id)
                 ->assertJsonPath('unit_price', $orderItem->unit_price)
                 ->assertJsonPath('total_amount', $orderItem->total_amount);
    }

    public function test_delete_order_item()
    {
        $orderItem = OrderItem::factory()->create();

        $response = $this->deleteJson("/api/deleteOrderItems/{$orderItem->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('orderitems', [
            'id' => $orderItem->id
        ]);
    }

    public function test_list_order_items()
    {
        OrderItem::factory()->count(3)->create();

        $response = $this->getJson('/api/orderItems');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'order_id', 'product_id', 'unit_price', 'total_amount', 'quantity', 'instructor_id', 'rent_price', 'return_date', 'created_at', 'updated_at']
                 ]);
    }

    public function test_create_order_item_validation_error()
    {
        $data = ['order_id' => '', 'product_id' => '', 'quantity' => ''];

        $response = $this->postJson('/api/createOrderItems', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['order_id', 'product_id', 'quantity']);
    }

    public function test_update_order_item_not_found()
    {
        $updateData = [
            'unit_price' => 150.50,
            'quantity' => 2,
            'total_amount' => 301.00
        ];

        $response = $this->postJson('/api/updateOrderItems/9999', $updateData);

        $response->assertStatus(404);
    }

    public function test_delete_order_item_not_found()
    {
        $response = $this->deleteJson('/api/deleteOrderItems/9999');

        $response->assertStatus(404);
    }

    public function test_show_order_item_not_found()
    {
        $response = $this->getJson('/api/showOrderItems/9999');

        $response->assertStatus(404);
    }
}






// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\OrderItem;

// class OrderItemTest extends TestCase
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
//         $data = OrderItem::factory()->raw();
//         $response = $this->postJson('/api/createOrderItems', $data);
 
//         $response
//             ->assertStatus(201)
//             ->assertJsonPath('order_id',$data['order_id'])
//             ->assertJsonPath('product_id',$data['product_id'])
//             ->assertJsonPath('unit_price',$data['unit_price'])
//             ->assertJsonPath('total_amount',$data['total_amount'])
//             ->assertJsonPath('quantity',$data['quantity'])
//             ->assertJsonPath('instructor_id',$data['instructor_id'])
//             ->assertJsonPath('rent_price',$data['rent_price'])
//             ->assertJsonPath('return_date',$data['return_date']);
//     }

//     public function testDatabase()
//     {
//         // Make call to application...
     
//         $this->assertDatabaseHas('orderitems', [
//             'instructor_id' => '401'
//         ]);
//     }

// }
