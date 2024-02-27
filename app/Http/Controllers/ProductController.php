<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request){

        $date = $request->validate(['product_name' => 'nullable', 
                                    'category_id' => 'nullable', 
                                    'unit_price' => 'integer'
                                    ]);
                        
        $product = Product::create($date);

        return $product;        
    }


    public function show($id){
        $product = Product::with(['orderitems'])->findOrFail($id);

        return $product;
       
    }

    public function list(){
        $products = Product::get();

        return $products;
       
    }


       public function update(Request $request, $id){
        $data = $request->validate(['product_name' => 'nullable', 
                                    'category_id' => 'nullable', 
                                    'unit_price' => 'integer'
                                ]);           

        $product = Product::findOrFail($id)->update($data);
      
        return $product;
       
    }

    public function delete($id){
        $product = Product::findOrFail($id)->delete();

        return $product;
        
    }
}
