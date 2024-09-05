<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'unit_price' => 'required|numeric',
        ]);
        
        $product = Product::create($data);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::with(['orderitems'])->findOrFail($id);

        return response()->json($product, 200);
    }

    public function list()
    {
        $products = Product::all();

        return response()->json($products, 200);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'unit_price' => 'required|numeric',
        ]);
       

        $product = Product::findOrFail($id);
        $product->update($data);

        return response()->json($product, 200);

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        // Обновление продукта
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}



// namespace App\Http\Controllers;

// use App\Models\Product;

// use Illuminate\Http\Request;

// class ProductController extends Controller
// {
//     public function create(Request $request){

//         $date = $request->validate(['product_name' => 'nullable', 
//                                     'category_id' => 'nullable', 
//                                     'unit_price' => 'integer'
//                                     ]);
                        
//         $product = Product::create($date);

//         return $product;        
//     }


//     public function show($id){
//         $product = Product::with(['orderitems'])->findOrFail($id);

//         return $product;
       
//     }

//     public function list(){
//         $products = Product::get();

//         return $products;
       
//     }


//        public function update(Request $request, $id){
//         $data = $request->validate(['product_name' => 'nullable', 
//                                     'category_id' => 'nullable', 
//                                     'unit_price' => 'integer'
//                                 ]);           

//         $product = Product::findOrFail($id)->update($data);
      
//         return $product;
       
//     }

//     public function delete($id){
//         $product = Product::findOrFail($id)->delete();

//         return $product;
        
//     }
// }
