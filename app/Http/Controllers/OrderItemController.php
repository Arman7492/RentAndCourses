<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;

use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function create(Request $request){

        $date = $request->validate(['order_id' => 'required',
                                    'product_id' => 'required', 
                                    'unit_price' => 'integer', 
                                    'total_amount' => 'integer', 
                                    'quantity'=> 'required|integer',
                                    'instructor_id' => 'nullable',
                                    'rent_price' => 'integer', 
                                    'return_date' => 'nullable|date', 
                                    ]);
                        
        $orderItem = OrderItem::create($date); 

        return $orderItem;        
    }


    public function show($id){
        $orderItem = OrderItem::with(['orderitems'])->findOrFail($id);

        return $orderItem;
       
    }

    public function list(){
        $orderItems = OrderItem::get();

        return $orderItems;
       
    }


       public function update(Request $request, $id){
        $orderItem = OrderItem::find($id);

        if (!$orderItem) {
        return response()->json(['message' => 'Order item not found'], 404);
        }

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
      
        $orderItem->update($data);
       
    }

    public function delete($id){
        $orderItem = OrderItem::findOrFail($id)->delete();

        return $orderItem;
        
    }
}
