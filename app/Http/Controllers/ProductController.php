<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function getProduct(){
        
        Gate::before(function($user){
            $user = auth("sanctum")->user();
            if($user -> role_id == 1){
                return true;
            }
        }); 

        if( !Gate::allows( "admin" )) {

            return response()->json( ["Autentikációs hiba", "Nincs jogosultság"] );
        }

        $products = Product::all();
        return response()->json($products);
    }

    public function addProduct(Request $request)
    {

        Gate::before(function($user){
            $user = auth("sanctum")->user();
            if($user -> role_id == 1){
                return true;
            }
        }); 

        if( !Gate::allows( "admin" )) {

            return response()->json( ["Autentikációs hiba", "Nincs jogosultság"] );
        }

        $product = new Product();
        $product->name = $request["name"];
        $product->price = $request["price"];
        $product->description = $request["description"];
        $product->category_id = $request["category_id"];
        $product->save();

        return response()->json(['success' => 'Termék sikeresen felvéve!']);
    }

    public function showProduct(Request $request)
    {


        Gate::before(function($user){
            $user = auth("sanctum")->user();
            if($user -> role_id == 1){
                return true;
            }
        }); 

        if( !Gate::allows( "admin" )) {

            return response()->json( ["Autentikációs hiba", "Nincs jogosultság"] );
        }

       $product = Product::with('category')->findOrFail($request["id"]);
       return response()->json($product);
    }

    public function updateProduct(Request $request)
    {

        Gate::before(function($user){
            $user = auth("sanctum")->user();
            if($user -> role_id == 1){
                return true;
            }
        }); 

        if( !Gate::allows( "admin" )) {

            return response()->json( ["Autentikációs hiba", "Nincs jogosultság"] );
        }

        $product = Product::findorFail($request["id"]);
        $product->name = $request["name"];
        $product->price = $request["price"];
        $product->description = $request["description"];
        $product->category_id = $request["category_id"];
        $product->save();

        return response()->json(['success' => 'Termék sikeresen frissítve!']);
    }

    public function deleteProduct(Request $request)
    {

        Gate::before(function($user){
            $user = auth("sanctum")->user();
            if($user -> role_id == 1){
                return true;
            }
        }); 

        if( !Gate::allows( "admin" )) {

            return response()->json( ["Autentikációs hiba", "Nincs jogosultság"] );
        }

        $product = Product::findorFail($request["id"]);
        $product->delete();

        return response()->json(['success' => 'Termék sikeresen törölve!']);
    }
}
