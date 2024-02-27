<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request){

        $date = $request->validate(['category_name' => 'nullable', 
                                    'parent_id' => 'nullable'
                                    ]);
                        
        $category = Category::create($date);

        return $category;        
    }


    public function show($id){
        $category = Category::with(['products'])->findOrFail($id);

        return $category;
       
    }

    public function list(){
        $categories = Category::get();

        return $categories;
       
    }


       public function update(Request $request, $id){
        $data = $request->validate(['category_name' => 'nullable', 
                                    'parent_id' => 'nullable']); 
                                                  

        $category = Category::findOrFail($id)->update($data);
      
        return $category;
       
    }

    public function delete($id){
        $category = Category::findOrFail($id)->delete();

        return $category;
        
    }
}
