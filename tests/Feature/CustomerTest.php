<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Customer;

class CustomerTest extends TestCase
{
    //use RefreshDatabase;

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_asserting_an_exact_json_match()
    {
        $data = Customer::factory()->raw();
        $response = $this->postJson('/api/createCustomers', $data);

        $response->assertStatus(201)
                 ->assertJsonPath('first_name', $data['first_name'])
                 ->assertJsonPath('last_name', $data['last_name'])
                 ->assertJsonPath('phone_number', $data['phone_number'])
                 ->assertJsonPath('password', $data['password']);
    }

    public function testDatabase()
    {
        $customer = Customer::factory()->create(['last_name' => 'Spencer']);

        $this->assertDatabaseHas('customers', [
            'last_name' => 'Spencer'
        ]);
    }

    public function test_update_customer()
    {
        $customer = Customer::factory()->create();
        $updateData = ['first_name' => 'UpdatedName', 'last_name' => 'UpdatedLastName'];

        $response = $this->postJson("/api/updateCustomers/{$customer->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJsonPath('first_name', $updateData['first_name'])
                 ->assertJsonPath('last_name', $updateData['last_name']);

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'first_name' => 'UpdatedName',
            'last_name' => 'UpdatedLastName'
        ]);
    }

    public function test_show_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->getJson("/api/showCustomers/{$customer->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('id', $customer->id)
                 ->assertJsonPath('first_name', $customer->first_name)
                 ->assertJsonPath('last_name', $customer->last_name);
    }

    public function test_delete_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->deleteJson("/api/deleteCustomers/{$customer->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id
        ]);
    }

    public function test_list_customers()
    {
        Customer::factory()->count(3)->create();

        $response = $this->getJson('/api/customers');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'first_name', 'last_name', 'phone_number', 'created_at', 'updated_at']
                 ]);
    }

    public function test_create_customer_validation_error()
    {
        $data = ['first_name' => '', 'last_name' => '', 'phone_number' => ''];

        $response = $this->postJson('/api/createCustomers', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['first_name', 'last_name', 'phone_number']);
    }

    public function test_update_customer_not_found()
    {
        $updateData = ['first_name' => 'UpdatedName', 'last_name' => 'UpdatedLastName'];

        $response = $this->postJson('/api/updateCustomers/9999', $updateData);

        $response->assertStatus(404);
    }

    public function test_delete_customer_not_found()
    {
        $response = $this->deleteJson('/api/deleteCustomers/9999');

        $response->assertStatus(404);
    }

    public function test_show_customer_not_found()
    {
        $response = $this->getJson('/api/showCustomers/9999');

        $response->assertStatus(404);
    }
}






// namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\Customer;

// class CustomerTest extends TestCase
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
//         $data = Customer::factory()->raw();
//         $response = $this->postJson('/api/createCustomers', $data);
 
//         $response
//             ->assertStatus(201)
//             ->assertJsonPath('first_name',$data['first_name'])
//             ->assertJsonPath('last_name',$data['last_name'])
//             ->assertJsonPath('phone_number',$data['phone_number'])
//             ->assertJsonPath('password',$data['password']);
//     }

//     public function testDatabase()
//     {
//         // Make call to application...
     
//         $this->assertDatabaseHas('customers', [
//             'last_name' => 'Spencer'
//         ]);
//     }
// }
