<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    public function register(Request $request) {
        $customer = Custumers::create([
            "name" => $request["name"],
            "email" => $request["email"],
            "password" => bcrypt($request["password"]),
            "address" => $request["address"]
        ]);
        return response() -> json([$name, "Sikeres regisztráció!"]);
    }

    public function login(Request $request) {
        if(Auth::attempt(["email" => $request["email"], "password" => $request["password"]])) {
            $authCustomer = Auth::user();
                $token = $authCustomer->createToken($authCustomer->name."Token")->plainTextToken;
                $data["user"] = ["user" => $authCustomer->name];
                $data["token"] = $token;
                return response() -> json([$data, "Sikeres bejelentkezés!"]);
            }
        else {
            return response() -> json("Hibás e-mail vagy jelszó!");
        }
    }

    public function logout(Request $request) {
        auth("sanctum") -> user() -> currentAccessToken() -> delete();
        $name = auth("sanctum") -> user() -> name;
        return response() -> json([$name, "Sikeresen kijelentkezett!"]);
    }
}