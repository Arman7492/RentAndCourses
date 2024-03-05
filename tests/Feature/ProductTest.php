<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
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
        $data = Product::factory()->raw();
        $response = $this->postJson('/api/createProducts', $data);
 
        $response
            ->assertStatus(201)
            ->assertJsonPath('product_name',$data['product_name'])
            ->assertJsonPath('category_id',$data['category_id'])
            ->assertJsonPath('unit_price',$data['unit_price']);
    }
}
