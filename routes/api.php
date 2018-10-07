<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Produktai
Route::post('/categories/{category}/product','ProductsController@create'); //Sukurti x kategorijos produktą
Route::get('/categories/products','ProductsController@indexAll'); //Paimti visus produktus
Route::get('/categories/products/get/{id}','ProductsController@indexProduct'); //Paimti x id produktą
Route::get('/categories/{category}/products','ProductsController@index'); //Paimti x kategorijos produktus
Route::patch('/categories/products/{product}','ProductsController@update'); //Atnaujinti produktą
Route::delete('/categories/products/{product}','ProductsController@destroy'); //Pašalinti produktą

//Kategorijos
Route::post('/category', 'CategoryController@create'); //Sukurti kategoriją
Route::get('/categories/get/{id}','CategoryController@indexCategory'); //Paimti kategoriją pagal id
Route::get('/categories','CategoryController@index'); //Paimti kategorijas
Route::patch('/categories/{category}','CategoryController@update'); //Atnaujinti kategoriją
Route::delete('/categories/{category}','CategoryController@destroy'); //Pašalinti kategoriją