<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request){

        $date = $request->validate(['product_name' => 'nullable', 
                                    'category_id' => 'nullable', 
                                    'unit_price' => 'float'
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
        $data = $request->validate(['product_name' => 'nullable', 
                                    'category_id' => 'nullable', 
                                    'unit_price' => 'float'
                                ]);           

        $order = Order::find($id)->update($data);
      
        return $order;
       
    }

    public function delete($id){
        $order = Order::find($id)->delete();

        return $order;
        
    }
}
