<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory(){
        $categories = Category::all();
        return response()->json($categories);
    }

    public function addCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return response()->json(['success' => 'Kategória sikeresen felvéve!']);
    }

    public function showCategory(Request $request)
    {
        $category = Category::findOrFail($request->input('id'));
        return response()->json($category);
    }

    public function updateCategory(Request $request)
    {
        $category = Category::findOrFail($request->input('id'));
        $category->name = $request->input('name');
        $category->save();

        return response()->json(['success' => 'Kategória sikeresen frissítve!']);
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::findOrFail($request->input('id'));
        $category->delete();

        return response()->json(['success' => 'Kategória sikeresen törölve!']);
    }
}
