<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
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
        $data = Category::factory()->raw();
        $response = $this->postJson('/api/createCategories', $data);
 
        $response
            ->assertStatus(201)
            ->assertJsonPath('category_name',$data['category_name'])
            ->assertJsonPath('parent_id',$data['parent_id']);
    }

    public function testDatabase()
    {
        // Make call to application...
     
        $this->assertDatabaseHas('categories', [
            'category_name' => 'Skis'
        ]);
    }
    
}
