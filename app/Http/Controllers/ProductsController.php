<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $products = $category->products()->get();
        $response =[
            'products'=>$products
        ];
        return response()->json($response);
    }

    public function indexProduct($id)
    {
        $product = Product::where('id', $id)->get(); //Ieškom objekto su $id
        if($product->isEmpty())
        {
            abort(404); // Neradus objekto išvedam 404 klaidą
        }
        else
        {
        $response =[
                'product'=>$product
            ];
            return response()->json($response);
        }

    }

    public function indexAll()
    {
        $products = Product::get();
        $response =[
            'products'=>$products
        ];
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request, Category $category)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $category->id;
        $product->price = $request->input('price');
        $product->image = $request->input('image');
        $product->description = $request->input('description');

        $product->save();
        return response('Produktas sukurtas')->header('Content-type','text/plain');
    }

    // public function create(Request $request)
    // {
    //     $product = new Product();
    //     $product->name = $request->input('name');
    //     $product->category_id = $request->input('category');
    //     $product->price = $request->input('price');
    //     $product->image = $request->input('image');
    //     $product->description = $request->input('description');

    //     $product->save();
    //     return response('Produktas sukurtas')->header('Content-type','text/plain');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
    
        $old_product = clone $product;
        $product->name = $request->input('name');
        $product->category_id = $request->input('category');
        $product->price = $request->input('price');
        $product->image = $request->input('image');
        $product->description = $request->input('description');

        $product->save();
        $response = [
            'old_product'=>$old_product,
            'new_product'=>$product
        ];
        return response()->json($response);
    }

    // public function update(Request $request, Product $product)
    // {
    
    //     $old_product = clone $product;
    //     $product->name = $request->input('name');
    //     $product->category = $request->input('category');
    //     $product->price = $request->input('price');
    //     $product->image = $request->input('image');
    //     $product->description = $request->input('description');

    //     $product->save();
    //     $response = [
    //         'old_product'=>$old_product,
    //         'new_product'=>$product
    //     ];
    //     return response()->json($response);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response('Produktas ištrintas')->header('Content-type','text/plain');
    }
}
