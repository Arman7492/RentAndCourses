<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\OrderItem;

class OrderItemTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_asserting_an_exact_json_match(): void
    {
        $data = OrderItem::factory()->raw();
        $response = $this->postJson('/api/createOrderItems', $data);
 
        $response
            ->assertStatus(201)
            ->assertJsonPath('order_id',$data['order_id'])
            ->assertJsonPath('product_id',$data['product_id'])
            ->assertJsonPath('unit_price',$data['unit_price'])
            ->assertJsonPath('total_amount',$data['total_amount'])
            ->assertJsonPath('quantity',$data['quantity'])
            ->assertJsonPath('instructor_id',$data['instructor_id'])
            ->assertJsonPath('rent_price',$data['rent_price'])
            ->assertJsonPath('return_date',$data['return_date']);
    }

    public function testDatabase()
    {
        // Make call to application...
     
        $this->assertDatabaseHas('orderitems', [
            'instructor_id' => '401'
        ]);
    }

}
