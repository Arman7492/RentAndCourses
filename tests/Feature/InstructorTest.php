<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Instructor;

class InstructorTest extends TestCase
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
        $data = Instructor::factory()->raw();
        $response = $this->postJson('/api/createInstructors', $data);
 
        $response
            ->assertStatus(201)
            ->assertJsonPath('first_name',$data['first_name'])
            ->assertJsonPath('last_name',$data['last_name'])
            ->assertJsonPath('rent_price',$data['rent_price']);
    }

    public function testDatabase()
    {
        // Make call to application...
     
        $this->assertDatabaseHas('instructors', [
            'first_name' => 'Stanislav'
        ]);
    }
}
