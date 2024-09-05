<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_asserting_an_exact_json_match()
    {
        $data = Product::factory()->raw();
        $response = $this->postJson('/api/createProducts', $data);

        $response->assertStatus(201)
                 ->assertJsonPath('product_name', $data['product_name'])
                 ->assertJsonPath('category_id', $data['category_id'])
                 ->assertJsonPath('unit_price', $data['unit_price']);
    }

    public function test_update_product()
    {
        $product = Product::factory()->create();
        $updateData = ['product_name' => 'Updated Product Name', 'unit_price' => 199.99];

        $response = $this->putJson("/api/updateProducts/{$product->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJsonPath('product_name', $updateData['product_name'])
                 ->assertJsonPath('unit_price', $updateData['unit_price']);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'product_name' => 'Updated Product Name',
            'unit_price' => 199.99
        ]);
    }

    public function test_show_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/showProducts/{$product->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $product->id)
                 ->assertJsonPath('product_name', $product->product_name)
                 ->assertJsonPath('unit_price', (string)$product->unit_price);
    }

    public function test_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/deleteProducts/{$product->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }

    public function test_list_products()
    {
        Product::factory()->count(50)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonCount(50)
                 ->assertJsonStructure([
                     '*' => ['id', 'product_name', 'category_id', 'unit_price']
                 ]);
    }

    public function test_create_product_validation_error()
    {
        $data = ['product_name' => '', 'category_id' => '', 'unit_price' => ''];

        $response = $this->postJson('/api/createProducts', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['product_name', 'category_id', 'unit_price']);
    }

    public function test_update_product_not_found()
    {
        $updateData = ['product_name' => 'Updated Product Name', 'unit_price' => 199.99];

        $response = $this->putJson('/api/updateProducts/9999', $updateData);

        $response->assertStatus(404);
    }

    public function test_delete_product_not_found()
    {
        $response = $this->deleteJson('/api/deleteProducts/9999');

        $response->assertStatus(404);
    }

    public function test_show_product_not_found()
    {
        $response = $this->getJson('/api/showProducts/9999');

        $response->assertStatus(404);
    }
}



// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\Product;

// class ProductTest extends TestCase
// {
//     use RefreshDatabase;

//     public function test_example()
//     {
//         $response = $this->get('/');

//         $response->assertStatus(200);
//     }

//     public function test_asserting_an_exact_json_match()
//     {
//         $data = Product::factory()->raw();
//         $response = $this->postJson('/api/createProducts', $data);

//         $response->assertStatus(201)
//                  ->assertJsonPath('product_name', $data['product_name'])
//                  ->assertJsonPath('category_id', $data['category_id'])
//                  ->assertJsonPath('unit_price', $data['unit_price']);
//     }

//     public function testDatabase()
//     {
//         $product = Product::factory()->create(['product_name' => 'Test Product']);

//         $this->assertDatabaseHas('products', [
//             'product_name' => 'Test Product'
//         ]);
//     }

//     public function test_update_product()
//     {
//         $product = Product::factory()->create();
//         $updateData = ['product_name' => 'Updated Product Name', 'unit_price' => 199.99];

//         $response = $this->postJson("/api/updateProducts/{$product->id}", $updateData);

//         $response->assertStatus(200)
//                  ->assertJsonPath('product_name', $updateData['product_name'])
//                  ->assertJsonPath('unit_price', $updateData['unit_price']);

//         $this->assertDatabaseHas('products', [
//             'id' => $product->id,
//             'product_name' => 'Updated Product Name',
//             'unit_price' => 199.99
//         ]);
//     }

//     public function test_show_product()
//     {
//         $product = Product::factory()->create();

//         $response = $this->getJson("/api/showProducts/{$product->id}");

//         $response->assertStatus(200)
//                  ->assertJsonPath('id', $product->id)
//                  ->assertJsonPath('product_name', $product->product_name)
//                  ->assertJsonPath('unit_price', $product->unit_price);
//     }

//     public function test_delete_product()
//     {
//         $product = Product::factory()->create();

//         $response = $this->deleteJson("/api/deleteProducts/{$product->id}");

//         $response->assertStatus(200);

//         $this->assertDatabaseMissing('products', [
//             'id' => $product->id
//         ]);
//     }

//     public function test_list_products()
//     {
//         Product::factory()->count(50)->create();

//         $response = $this->getJson('/api/products');

//         $response->assertStatus(200)
//                  ->assertJsonCount(50)
//                  ->assertJsonStructure([
//                      '*' => ['id', 'product_name', 'category_id', 'unit_price']
//                  ]);
//     }

//     public function test_create_product_validation_error()
//     {
//         $data = ['product_name' => '', 'category_id' => '', 'unit_price' => ''];

//         $response = $this->postJson('/api/createProducts', $data);

//         $response->assertStatus(422)
//                  ->assertJsonValidationErrors(['product_name', 'category_id', 'unit_price']);
//     }

//     public function test_update_product_not_found()
//     {
//         $updateData = ['product_name' => 'Updated Product Name', 'unit_price' => 199.99];

//         $response = $this->postJson('/api/updateProducts/9999', $updateData);

//         $response->assertStatus(404);
//     }

//     public function test_delete_product_not_found()
//     {
//         $response = $this->deleteJson('/api/deleteProducts/9999');

//         $response->assertStatus(404);
//     }

//     public function test_show_product_not_found()
//     {
//         $response = $this->getJson('/api/showProducts/9999');

//         $response->assertStatus(404);
//     }
// }






// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\Product;

// class ProductTest extends TestCase
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
//         $data = Product::factory()->raw();
//         $response = $this->postJson('/api/createProducts', $data);
 
//         $response
//             ->assertStatus(201)
//             ->assertJsonPath('product_name',$data['product_name'])
//             ->assertJsonPath('category_id',$data['category_id'])
//             ->assertJsonPath('unit_price',$data['unit_price']);
//     }
// }
