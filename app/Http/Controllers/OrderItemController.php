<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function create(Request $request){

        $date = $request->validate(['order_id' => 'nullable',
                                    'product_id' => 'nullable', 
                                    'unit_price' => 'float', 
                                    'total_amount' => 'float', 
                                    'quantity'=> 'integer'
                                    'instructor_id' => 'nullable',
                                    'rent_price' => 'float', 
                                    'return_date' => 'nullable|date', 
                                    ]);
                        
        $order = Order::create($date); 

        return $order;        
    }


    public function show($id){
        $student = Student::with(['school'])->find($id);

        return $student;
       
    }

    public function list(){
        $customers = Order::get();

        return $customers;
       
    }


       public function update(Request $request, $id){
        $data = $request->validate(['order_id' => 'nullable',
                                    'product_id' => 'nullable', 
                                    'unit_price' => 'float', 
                                    'total_amount' => 'float', 
                                    'quantity'=> 'integer'
                                    'instructor_id' => 'nullable',
                                    'rent_price' => 'float', 
                                    'return_date' => 'nullable|date', 
                                    ]);           

        $order = Order::find($id)->update($data);
      
        return $order;
       
    }

    public function delete($id){
        $order = Order::find($id)->delete();

        return $order;
        
    }
}
