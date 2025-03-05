<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/addProduct',[ProductController::class, 'addProduct']);
Route::post('/showProduct',[ProductController::class, 'showProduct']);
Route::put('/updateproduct',[ProductController::class, 'updateProduct']);
Route::delete('/deleteProduct',[ProductController::class, 'deleteProduct']);
Route::post('/addcategory',[CategoryController::class, 'addCategory']);
Route::put('/updatecategory',[CategoryController::class,'updateCategory']);
Route::delete('/deletecategory',[CategoryController::class, 'deleteCategory']);