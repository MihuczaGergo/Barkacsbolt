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

Route::get("/get-role", [RoleController::class, "getRoles"]);
Route::post("/add-role", [RoleController::class, "addRole"]);
Route::put("/update-role", [RoleController::class, "updateRoleName"]);
Route::delete("/delete-role", [RoleController::class, "deleteRole"]);

Route::post('/addProduct',[ProductController::class, 'addProduct']);
Route::post('/showProduct',[ProductController::class, 'showProduct']);
Route::put('/updateproduct',[ProductController::class, 'updateProduct']);
Route::delete('/deleteProduct',[ProductController::class, 'deleteProduct']);
Route::post('/addcategory',[CategoryController::class, 'addCategory']);
Route::put('/updatecategory',[CategoryController::class,'updateCategory']);
Route::delete('/deletecategory',[CategoryController::class, 'deleteCategory']);
Route::post('/addorder',[OrdersController::class, 'addOrder']);