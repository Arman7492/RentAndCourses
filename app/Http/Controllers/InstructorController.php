<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function create(Request $request){

        $date = $request->validate(['first_name' => 'nullable', 
                                    'last_name' => 'nullable', 
                                    'rent_price' => 'float'
                                    ]);
                        
        $instructor = Instructor::create($date);

        return $instructor;        
    }


    public function show($id){
        $instructor = Instructor::with(['orders'])->find($id);

        return $instructor;
       
    }

    public function list(){
        $instructors = Instructor::get();

        return $instructors;
       
    }


       public function update(Request $request, $id){
        $data = $request->validate(['first_name' => 'nullable', 
                                    'last_name' => 'nullable', 
                                    'rent_price' => 'float'
                                    ]);           

        $instructor = Instructor::find($id)->update($data);
      
        return $instructor;
       
    }

    public function delete($id){
        $instructor = Instructor::find($id)->delete();

        return $instructor;
        
    }
}
