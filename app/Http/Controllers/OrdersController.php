<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class OrdersController extends Controller
{
    public function getOrders(){
        $orders = Orders::all();
        return response()->json($orders);
    }

    public function addOrder(Request $request)
    {
        $order = new Orders();
        $order->total = $request["total"];
        $order->status = $request["status"];
        $order->user_id = $request["user_id"];
        $order->product_id = $request["product_id"];
        $order->save();

        return response()->json(['success' => 'Rendelés sikeresen felvéve!']);
    }

    public function showOrder(Request $request)
    {
       $order = Orders::findOrFail($request["id"]);
       return response()->json($order);
    }

    public function updateOrder(Request $request)
    {
        $order = Orders::findorFail($request["id"]);
        $order->total = $request["total"];
        $order->status = $request["status"];
        $order->customers_id = $request["customers_id"];
        $order->product_id = $request["product_id"];
        $order->save();

        return response()->json(['success' => 'Rendelés sikeresen frissítve!']);
    }

    public function deleteOrder(Request $request)
    {
        $order = Orders::findorFail($request["id"]);
        $order->delete();

        return response()->json(['success' => 'Rendelés sikeresen törölve!']);
    }
}
