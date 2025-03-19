<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Gate;


class CategoryController extends Controller
{
    public function getCategory(){
        Gate::before(function($user){
            $user = auth("sanctum")->user();
            if($user -> role_id == 1){
                return true;
            }
        }); 

        if( !Gate::allows( "admin" )) {

            return response()->json( ["Autentikációs hiba", "Nincs jogosultság"] );
        }

        $categories = Category::all();
        return response()->json($categories);
    }

    public function addCategory(Request $request)
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

        $category = new Category();
        $category->name = $request["name"];
        $category->save();

        return response()->json(['success' => 'Kategória sikeresen felvéve!']);
    }

    public function showCategory(Request $request)
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
        $category = Category::findOrFail($request["id"]);
        return response()->json($category);
    }

    public function updateCategory(Request $request)
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

        $category = Category::findOrFail($request["id"]);
        $category->name = $request["name"];
        $category->save();

        return response()->json(['success' => 'Kategória sikeresen frissítve!']);
    }

    public function deleteCategory(Request $request)
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

        $category = Category::findOrFail($request["id"]);
        $category->delete();

        return response()->json(['success' => 'Kategória sikeresen törölve!']);
    }
}
