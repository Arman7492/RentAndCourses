<?php

namespace App\Http\Controllers;

use App\Models\Customer;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create(Request $request){

        $date = $request->validate([
                                    'first_name' => 'nullable',
                                    'last_name' => 'nullable',
                                    'phone_number' => 'string', 
                                    'password' => 'required'
                                    ]);
                                    
        $customer = Customer::create($date);

        return $customer;        
    }


    public function show($id){
        $customer = Customer::with(['orders'])->find($id);

        return $customer;
       
    }

    public function list(){
        $customers = Customer::get();

        return $customers;
       
    }


       public function update(Request $request, $id){
        $data = $request->validate(['first_name' => 'nullable', 
                                    'last_name' => 'nullable',
                                    'phone_number' => 'string', 
                                    'password' => 'required'
                                    ]);           

        $customer = Customer::find($id)->update($data);
      
        return $customer;
       
    }

    public function delete($id){
        $customer = Customer::find($id)->delete();

        return $customer;
        
    }
}
