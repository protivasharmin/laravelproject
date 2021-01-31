<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Product;


class ProductController extends Controller
{
    public $successStatus = 200;

    public function index()
    {
        $products = Product::all();
    
        return $products;

        if(empty($products)){
            return response()->json(["message" => "Record not found"], 404);
        }else{
            return response()->json(['success' => $products], $this->successStatus);        
        }
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->title       = $request->input('title');
        $product->description = $request->input('description');
        $product->price       = $request->input('price');

        if ($request->hasFile('p-img')){
            $image = $request->file('p-img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/galeryImages/');
            $path = $image->move($destinationPath, $name);
            $product->image = $name;
        }

        $product->save();

        if($product->save()){
            return response()->json(['success' => $products], $this->successStatus);        
        }else{
            return response()->json(["message" => "Operation fail"], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $product->title       = $request->input('title');
        $product->description = $request->input('description');
        $product->price       = $request->input('price');

        if ($request->hasFile('p-img')){
            $image = $request->file('p-img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/galeryImages/');
            $path = $image->move($destinationPath, $name);
            $product->image = $name;
        }

        $product->save();

        if($product->save()){
            return response()->json(['success' => $products], $this->successStatus);        
        }else{
            return response()->json(["message" => "Operation fail"], 404);
        }
    }
}
