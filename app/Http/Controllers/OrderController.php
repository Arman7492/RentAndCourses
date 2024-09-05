<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'order_date' => 'required|date',
            'order_number' => 'required|string',
            'customer_id' => 'nullable|integer',
            'total_amount' => 'required|numeric',
            'id_cell' => 'nullable|string'
        ]);

        $order = Order::create($data);
        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = Order::with(['orderitems'])->findOrFail($id);
        return response()->json($order, 200);
    }

    public function list()
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'order_date' => 'required|date',
            'order_number' => 'required|string',
            'customer_id' => 'nullable|integer',
            'total_amount' => 'required|numeric',
            'id_cell' => 'nullable|string'
        ]);

        $order = Order::findOrFail($id);
        $order->update($data);
        return response()->json($order, 200);
    }

    public function delete($id)
    {
        Order::findOrFail($id)->delete();
        return response()->json(['success' => true], 200);
    }
}



// namespace App\Http\Controllers;

// use App\Models\Order;
// use Illuminate\Http\Request;

// class OrderController extends Controller
// {
//     public function create(Request $request)
//     {
//         $data = $request->validate([
//             'order_date' => 'nullable|date',
//             'order_number' => 'required|string', // Изменено на string
//             'customer_id' => 'nullable|integer',
//             'total_amount' => 'required|numeric', // Изменено на numeric
//             'id_cell' => 'nullable|string' // Изменено на string
//         ]);

//         $order = Order::create($data);
//         return $order;
//     }

//     public function show($id)
//     {
//         $order = Order::with(['orderitems'])->findOrFail($id);
//         return $order;
//     }

//     public function list()
//     {
//         $orders = Order::all();
//         return $orders;
//     }

//     public function update(Request $request, $id)
//     {
//         $data = $request->validate([
//             'order_date' => 'required|date',
//             'order_number' => 'required|string', // Изменено на string
//             'customer_id' => 'nullable|integer',
//             'total_amount' => 'required|numeric', // Изменено на numeric
//             'id_cell' => 'nullable|string' // Изменено на string
//         ]);

//         $order = Order::findOrFail($id);
//         $order->update($data);
//         return $order;
//     }

//     public function delete($id)
//     {
//         $order = Order::findOrFail($id)->delete();
//         return response()->json(['success' => true]);
//     }
// }



// namespace App\Http\Controllers;

// use App\Models\Order;

// use Illuminate\Http\Request;

// class OrderController extends Controller
// {
//     public function create(Request $request){

//         $date = $request->validate(['order_date' => 'nullable|date', 
//                                     'order_number' => 'integer', 
//                                     'customer_id' => 'nullable', 
//                                     'total_amount' => 'integer', 
//                                     'id_cell'=> 'nullable'
//                                     ]);
                        
//         $order = Order::create($date);

//         return $order;        
//     }


//     public function show($id){
//         $order = Order::with(['orderitems'])->findOrFail($id);

//         return $order;
       
//     }

//     public function list(){
//         $orders = Order::get();

//         return $orders;
       
//     }


//        public function update(Request $request, $id){
//         $data = $request->validate(['order_date' => 'required|date', 
//                                     'order_number' => 'required|string', 
//                                     'customer_id' => 'integer', 
//                                     'total_amount' => 'required|numeric', 
//                                     'id_cell'=> 'integer'
//                                     ]);           

//         $order = Order::findOrFail($id)->update($data);
      
//         return $order;
       
//     }

//     public function delete($id){
//         $order = Order::findOrFail($id)->delete();

//         return $order;
        
//     }
// }
