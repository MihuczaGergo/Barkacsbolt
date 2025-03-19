<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Support\Facades\Gate;

class OrdersController extends Controller
{
    public function getOrders(){
        Gate::before(function($user){
            $user = auth("sanctum")->user();
            if($user -> role_id == 1){
                return true;
            }
        }); 

        if( !Gate::allows( "admin" )) {

            return response()->json( ["Autentikációs hiba", "Nincs jogosultság"] );
        }
        $orders = Orders::all();
        return response()->json($orders);
    }

    public function addOrder(Request $request)
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

        Gate::before(function($user){
            $user = auth("sanctum")->user();
            if($user -> role_id == 1){
                return true;
            }
        }); 

        if( !Gate::allows( "admin" )) {

            return response()->json( ["Autentikációs hiba", "Nincs jogosultság"] );
        }

       $order = Orders::findOrFail($request["id"]);
       return response()->json($order);
    }

    public function updateOrder(Request $request)
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

        $order = Orders::findorFail($request["id"]);
        $order->total = $request["total"];
        $order->status = $request["status"];
        $order->user_id = $request["user_id"];
        $order->product_id = $request["product_id"];
        $order->save();

        return response()->json(['success' => 'Rendelés sikeresen frissítve!']);
    }

    public function deleteOrder(Request $request)
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

        $order = Orders::findorFail($request["id"]);
        $order->delete();

        return response()->json(['success' => 'Rendelés sikeresen törölve!']);
    }
}
