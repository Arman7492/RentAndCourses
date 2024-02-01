<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request){

        $date = $request->validate(['order_date' => 'nullable|date', 
                                    'order_number' => 'integer', 
                                    'customer_id' => 'nullable', 
                                    'total_amount' => 'integer', 
                                    'id_cell'=> 'nullable'
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
        $data = $request->validate(['order_date' => 'nullable|date', 
                                    'order_number' => 'integer', 
                                    'customer_id' => 'nullable', 
                                    'total_amount' => 'integer', 
                                    'id_cell'=> 'nullable'
                                    ]);           

        $order = Order::find($id)->update($data);
      
        return $order;
       
    }

    public function delete($id){
        $order = Order::find($id)->delete();

        return $order;
        
    }
}
