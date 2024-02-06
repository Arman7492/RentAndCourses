<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;

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
                        
        $orderitem = OrderItem::create($date); 

        return $orderitem;        
    }


    public function show($id){
        $orderitem = OrderItem::with(['orderitems'])->find($id);

        return $orderitem;
       
    }

    public function list(){
        $orderitems = OrderItem::get();

        return $orderitems;
       
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

        $orderitem = OrderItem::find($id)->update($data);
      
        return $orderitem;
       
    }

    public function delete($id){
        $orderitem = OrderItem::find($id)->delete();

        return $orderitem;
        
    }
}
