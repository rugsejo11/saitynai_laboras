<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\createResponse
     */
    public function index()
    {
        $categories = Category::get();
        $response =[
            'categories'=>$categories
        ];
        return response()->json($response);
    }
    public function indexCategory($id)
    {
        $categories = Category::where('id', $id)->get();

        if($categories->isEmpty())
            abort(404);
        else{
        $response =[
            'categories'=>$categories
        ];
        
        return response()->json($response);
         }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->user()->role == "admin") {
            $category = new Category();
            $category->name = $request->input('name');
            $category->save();
            return response('Kategorija sukurta')->header('Content-type','text/plain');
        } else {
            return response('Priega uždrausta')->header('Content-type','text/plain');
        }

    }

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
    public function update(Request $request, Category $category)
    {

        if ($request->user()->role == "admin") {
            $old_category = clone $category;
            $category->name = $request->input('name');
            $category->price = $request->input('price');
            $category->image = $request->input('image');
            $category->description = $request->input('description');
    
            $category->save();
            $response = [
                'old_category'=>$old_category,
                'new_category'=>$category
            ];
            return response()->json($response);
        } else {
            return response('Priega uždrausta')->header('Content-type','text/plain');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($request->user()->role == "admin") {
            $category->delete();
            return response('Kategorija ištrinta')->header('Content-type','text/plain');
        } else {
            return response('Priega uždrausta')->header('Content-type','text/plain');
        }

    }
}
