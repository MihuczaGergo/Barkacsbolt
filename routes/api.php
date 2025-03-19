<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrdersController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::post("/logout", [UserController::class, "logout"]);




Route::middleware( "auth:sanctum" )->group( function(){

    Route::post('/addorder',[OrdersController::class, 'addOrder']);
    Route::put('/updateorder',[OrdersController::class, 'updateOrder']);
    Route::delete('/deleteorder',[OrdersController::class, 'deleteOrder']);
    Route::get('/getorder',[OrdersController::class, 'getOrders']);

    Route::post('/addproduct',[ProductController::class, 'addProduct']);
    Route::post('/showproduct',[ProductController::class, 'showProduct']);
    Route::put('/updateproduct',[ProductController::class, 'updateProduct']);
    Route::delete('/deleteproduct',[ProductController::class, 'deleteProduct']);
    Route::get('/getproduct',[ProductController::class,'getproduct']);

    Route::post('/addcategory',[CategoryController::class, 'addCategory']);
    Route::put('/updatecategory',[CategoryController::class,'updateCategory']);
    Route::delete('/deletecategory',[CategoryController::class, 'deleteCategory']);
    Route::get('/getcategory',[CategoryController::class,'getCategory']);

    Route::get("users", [UserController::class, "getUsers"]);

    Route::get("/get-role", [RoleController::class, "getRoles"]);
    Route::post("/add-role", [RoleController::class, "addRole"]);
    Route::put("/update-role", [RoleController::class, "updateRoleName"]);
    Route::delete("/delete-role", [RoleController::class, "deleteRole"]);
    });