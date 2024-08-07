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
        $order = Order::with(['orderitems'])->findOrFail($id);

        return $order;
       
    }

    public function list(){
        $orders = Order::get();

        return $orders;
       
    }


       public function update(Request $request, $id){
        $data = $request->validate(['order_date' => 'nullable|date', 
                                    'order_number' => 'integer', 
                                    'customer_id' => 'integer', 
                                    'total_amount' => 'integer', 
                                    'id_cell'=> 'integer'
                                    ]);           

        $order = Order::findOrFail($id)->update($data);
      
        return $order;
       
    }

    public function delete($id){
        $order = Order::findOrFail($id)->delete();

        return $order;
        
    }
}
