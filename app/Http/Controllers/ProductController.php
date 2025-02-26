<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct(){
        $products = Product::all();
        return response()->json($products);

    }

    public function addProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        return response()->json(['success' => 'Termék sikeresen felvéve!']);
    }

    public function showProduct(Request $request)
    {
       $product = Product::with('category')->findOrFail("id");
       return response()->json($product);
    }

    public function updateProduct(Request $request)
    {
        $product = Product::findorFail($request->input('id'));
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        return response()->json(['success' => 'Termék sikeresen frissítve!']);
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::findorFail($request->input('id'));
        $product->delete();

        return response()->json(['success' => 'Termék sikeresen törölve!']);
    }
    
}
