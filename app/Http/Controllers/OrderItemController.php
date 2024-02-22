<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;

use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function create(Request $request){

        $date = $request->validate(['order_id' => 'nullable',
                                    'product_id' => 'nullable', 
                                    'unit_price' => 'integer', 
                                    'total_amount' => 'integer', 
                                    'quantity'=> 'integer',
                                    'instructor_id' => 'nullable',
                                    'rent_price' => 'integer', 
                                    'return_date' => 'nullable|date', 
                                    ]);
                        
        $orderItem = OrderItem::create($date); 

        return $orderItem;        
    }


    public function show($id){
        $orderItem = OrderItem::with(['orderItems'])->findOrFail($id);

        return $orderItem;
       
    }

    public function list(){
        $orderItems = OrderItem::get();

        return $orderItems;
       
    }


       public function update(Request $request, $id){
        $data = $request->validate(['order_id' => 'nullable',
                                    'product_id' => 'nullable', 
                                    'unit_price' => 'integer', 
                                    'total_amount' => 'integer', 
                                    'quantity'=> 'integer',
                                    'instructor_id' => 'nullable',
                                    'rent_price' => 'integer', 
                                    'return_date' => 'nullable|date', 
                                    ]);           

        $orderItem = OrderItem::findOrFail($id)->update($data);
      
        return $orderItem;
       
    }

    public function delete($id){
        $orderItem = OrderItem::findOrFail($id)->delete();

        return $orderItem;
        
    }
}
