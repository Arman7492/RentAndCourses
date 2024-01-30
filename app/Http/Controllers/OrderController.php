<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request){

        $date = $request->validate(['order_date' => 'nullable', 'order_number' => 'nullable', 'customer_id' => 'nullable', 'total_amount' => 'nullable', 'id_cell'=> 'nullable']);
                        
        $order = Order::create($date);

        return $order;        
    }


    public function item($id){
        $student = Student::with(['school'])->find($id);

        return $student;
       
    }

    public function list(){
        $schools = Student::get();

        return $schools;
       
    }


       public function update(Request $request, $id){
        $data = $request->validate(['FirstName' => 'nullable', 
                                    'SecondName' => 'nullable',     
                                     'school_id' => 'nullable']);           

        $student = Student::find($id)->update($data);
      
        return $student;
       
    }

    public function delete($id){
        $student = Student::find($id)->delete();

        return $student;
        
    }
}
