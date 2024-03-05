<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

class OrderTest extends TestCase
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
        $data = Order::factory()->raw();
        $response = $this->postJson('/api/createOrders', $data);
        
        $response
            ->assertStatus(201)
            ->assertJsonPath('order_date',$data['order_date'])
            ->assertJsonPath('order_number',$data['order_number'])
            ->assertJsonPath('customer_id',$data['customer_id'])
            ->assertJsonPath('total_amount',$data['total_amount'])
            ->assertJsonPath('id_cell',$data['id_cell']);
    }

}
