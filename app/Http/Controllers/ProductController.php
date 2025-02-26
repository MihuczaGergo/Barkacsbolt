<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct(){
        $products = Product::all();
        return view('product', ['products' => $products]);

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
}
