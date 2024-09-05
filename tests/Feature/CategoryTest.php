<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    //use RefreshDatabase;

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_asserting_an_exact_json_match()
    {
        $data = Category::factory()->raw();
        $response = $this->postJson('/api/createCategories', $data);

        $response->assertStatus(201)
                 ->assertJsonPath('category_name', $data['category_name'])
                 ->assertJsonPath('parent_id', $data['parent_id']);
    }

    public function testDatabase()
    {
        $category = Category::factory()->create(['category_name' => 'Glasswear']);

        $this->assertDatabaseHas('categories', [
            'category_name' => 'Glasswear'
        ]);
    }

    public function test_update_category()
    {
        $category = Category::factory()->create();
        $updateData = ['category_name' => 'Updated Name', 'parent_id' => null];

        $response = $this->postJson("/api/updateCategories/{$category->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJsonPath('category_name', $updateData['category_name']);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'category_name' => 'Updated Name'
        ]);
    }

    public function test_show_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("/api/showCategories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $category->id)
                 ->assertJsonPath('category_name', $category->category_name);
    }

    public function test_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/deleteCategories/{$category->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);
    }

    public function test_list_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'category_name', 'parent_id', 'created_at', 'updated_at']
                 ]);
    }

    public function test_create_category_validation_error()
    {
        $data = ['category_name' => '', 'parent_id' => null];

        $response = $this->postJson('/api/createCategories', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['category_name']);
    }

    public function test_update_category_not_found()
    {
        $updateData = ['category_name' => 'Updated Name', 'parent_id' => null];

        $response = $this->postJson('/api/updateCategories/9999', $updateData);

        $response->assertStatus(404);
    }

    public function test_delete_category_not_found()
    {
        $response = $this->deleteJson('/api/deleteCategories/9999');

        $response->assertStatus(404);
    }
}






// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\Category;

// class CategoryTest extends TestCase
// {
//     use RefreshDatabase;

//     public function test_example()
//     {
//         $response = $this->get('/');

//         $response->assertStatus(200);
//     }

//     public function test_asserting_an_exact_json_match()
//     {
//         $data = Category::factory()->raw();
//         $response = $this->postJson('/api/createCategories', $data);
 
//         $response
//             ->assertStatus(201)
//             ->assertJsonPath('category_name', $data['category_name'])
//             ->assertJsonPath('parent_id', $data['parent_id']);
//     }

//     public function testDatabase()
//     {
//         $category = Category::factory()->create(['category_name' => 'Glasswear']);
        
//         $this->assertDatabaseHas('categories', [
//             'category_name' => 'Glasswear'
//         ]);
//     }

//     public function test_update_category()
//     {
//         $category = Category::factory()->create();
//         $updateData = ['category_name' => 'Updated Name', 'parent_id' => null];
        
//         $response = $this->postJson("/api/updateCategories/{$category->id}", $updateData);
        
//         $response->assertStatus(200)
//             ->assertJsonPath('category_name', $updateData['category_name']);
        
//         $this->assertDatabaseHas('categories', [
//             'id' => $category->id,
//             'category_name' => 'Updated Name'
//         ]);
//     }

//     public function test_show_category()
//     {
//         $category = Category::factory()->create();
        
//         $response = $this->getJson("/api/showCategories/{$category->id}");
        
//         $response->assertStatus(200)
//             ->assertJsonPath('id', $category->id)
//             ->assertJsonPath('category_name', $category->category_name);
//     }

//     public function test_delete_category()
//     {
//         $category = Category::factory()->create();
        
//         $response = $this->deleteJson("/api/deleteCategories/{$category->id}");
        
//         $response->assertStatus(200);
        
//         $this->assertDatabaseMissing('categories', [
//             'id' => $category->id
//         ]);
//     }

//     public function test_list_categories()
//     {
//         $categories = Category::factory()->count(3)->create();
        
//         $response = $this->getJson('/api/categories');
        
//         $response->assertStatus(200)
//             ->assertJsonCount(3)
//             ->assertJsonStructure([
//                 '*' => ['id', 'category_name', 'parent_id', 'created_at', 'updated_at']
//             ]);
//     }

//     public function test_create_category_validation_error()
//     {
//         $data = ['category_name' => '', 'parent_id' => null];
        
//         $response = $this->postJson('/api/createCategories', $data);
        
//         $response->assertStatus(422)
//             ->assertJsonValidationErrors(['category_name']);
//     }

//     public function test_update_category_not_found()
//     {
//         $updateData = ['category_name' => 'Updated Name', 'parent_id' => null];
        
//         $response = $this->postJson('/api/updateCategories/9999', $updateData);
        
//         $response->assertStatus(404);
//     }

//     public function test_delete_category_not_found()
//     {
//         $response = $this->deleteJson('/api/deleteCategories/9999');
        
//         $response->assertStatus(404);
//     }
// }







// class CategoryTest extends TestCase
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
//         $data = Category::factory()->raw();
//         $response = $this->postJson('/api/createCategories', $data);
 
//         $response
//             ->assertStatus(201)
//             ->assertJsonPath('category_name',$data['category_name'])
//             ->assertJsonPath('parent_id',$data['parent_id']);
//     }

//     public function testDatabase()
//     {
//         // Make call to application...
     
//         $this->assertDatabaseHas('categories', [
//             'category_name' => 'Glasswear'
//         ]);
//     }


    // public function test_wrong_disable_Categories_by_id()
    // {
    //     $response = $this->post('/api/createCategories/1500');

    //     $response->assertStatus(500);
    // }

    // public function test_get_by_id_when_id_is_not_numeric()
    // {
    //     $response = $this->get('/api/showCategories/invalid_id');

    //     $response->assertStatus(500);
    // }
    
//}
