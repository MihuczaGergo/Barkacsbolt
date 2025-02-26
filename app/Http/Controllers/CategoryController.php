<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    public function getCategory(){
        $categories = Category::all();
        return response()->json($categories);
    }

    public function addCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request["name"];
        $category->save();

        return response()->json(['success' => 'Kategória sikeresen felvéve!']);
    }

    public function showCategory(Request $request)
    {
        $category = Category::findOrFail($request["id"]);
        return response()->json($category);
    }

    public function updateCategory(Request $request)
    {
        $category = Category::findOrFail($request["id"]);
        $category->name = $request["name"];
        $category->save();

        return response()->json(['success' => 'Kategória sikeresen frissítve!']);
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::findOrFail($request["id"]);
        $category->delete();

        return response()->json(['success' => 'Kategória sikeresen törölve!']);
    }
}
