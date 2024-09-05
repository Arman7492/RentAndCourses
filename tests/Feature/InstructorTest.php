<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Instructor;

class InstructorTest extends TestCase
{
    //use RefreshDatabase;

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_asserting_an_exact_json_match()
    {
        $data = Instructor::factory()->raw();
        $response = $this->postJson('/api/createInstructors', $data);

        $response->assertStatus(201)
                 ->assertJsonPath('first_name', $data['first_name'])
                 ->assertJsonPath('last_name', $data['last_name'])
                 ->assertJsonPath('rent_price', $data['rent_price']);
    }

    public function testDatabase()
    {
        $instructor = Instructor::factory()->create(['first_name' => 'Stanislav']);

        $this->assertDatabaseHas('instructors', [
            'first_name' => 'Stanislav'
        ]);
    }

    public function test_update_instructor()
    {
        $instructor = Instructor::factory()->create();
        $updateData = ['first_name' => 'UpdatedFirstName', 'last_name' => 'UpdatedLastName'];

        $response = $this->postJson("/api/updateInstructors/{$instructor->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJsonPath('first_name', $updateData['first_name'])
                 ->assertJsonPath('last_name', $updateData['last_name']);

        $this->assertDatabaseHas('instructors', [
            'id' => $instructor->id,
            'first_name' => 'UpdatedFirstName',
            'last_name' => 'UpdatedLastName'
        ]);
    }

    public function test_show_instructor()
    {
        $instructor = Instructor::factory()->create();

        $response = $this->getJson("/api/showInstructors/{$instructor->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $instructor->id)
                 ->assertJsonPath('first_name', $instructor->first_name)
                 ->assertJsonPath('last_name', $instructor->last_name);
    }

    public function test_delete_instructor()
    {
        $instructor = Instructor::factory()->create();

        $response = $this->deleteJson("/api/deleteInstructors/{$instructor->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('instructors', [
            'id' => $instructor->id
        ]);
    }

    public function test_list_instructors()
    {
        Instructor::factory()->count(3)->create();

        $response = $this->getJson('/api/instructors');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'first_name', 'last_name', 'rent_price', 'created_at', 'updated_at']
                 ]);
    }

    public function test_create_instructor_validation_error()
    {
        $data = ['first_name' => '', 'last_name' => '', 'rent_price' => ''];

        $response = $this->postJson('/api/createInstructors', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['first_name', 'last_name', 'rent_price']);
    }

    public function test_update_instructor_not_found()
    {
        $updateData = ['first_name' => 'UpdatedFirstName', 'last_name' => 'UpdatedLastName'];

        $response = $this->postJson('/api/updateInstructors/9999', $updateData);

        $response->assertStatus(404);
    }

    public function test_delete_instructor_not_found()
    {
        $response = $this->deleteJson('/api/deleteInstructors/9999');

        $response->assertStatus(404);
    }

    public function test_show_instructor_not_found()
    {
        $response = $this->getJson('/api/showInstructors/9999');

        $response->assertStatus(404);
    }
}







// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\Instructor;

// class InstructorTest extends TestCase
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
//         $data = Instructor::factory()->raw();
//         $response = $this->postJson('/api/createInstructors', $data);
 
//         $response
//             ->assertStatus(201)
//             ->assertJsonPath('first_name',$data['first_name'])
//             ->assertJsonPath('last_name',$data['last_name'])
//             ->assertJsonPath('rent_price',$data['rent_price']);
//     }

//     public function testDatabase()
//     {
//         // Make call to application...
     
//         $this->assertDatabaseHas('instructors', [
//             'first_name' => 'Stanislav'
//         ]);
//     }
// }
