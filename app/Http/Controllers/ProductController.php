<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect(route('home'))->with('successMgs', 'Successfully Added'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
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

        return redirect(route('home'))->with('successMgs', 'Successfully Added'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product, $id)
    {
        $product = Product::findOrFail($id)->delete();
        return redirect(route('home'))->with('successMgs', 'Successfully Added'); 
    }
}
