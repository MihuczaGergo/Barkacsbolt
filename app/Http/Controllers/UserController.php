<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function addUser(Request $request) {
        $user = User::create([
            "name" => $request["name"],
            "password" => bcrypt($request["password"]),
            "phone" => $request["phone"],
            "email" => $request["email"],
            "address" => $request["address"],
            "birth_date" => $request["birth_date"]
        ]);
        return response() -> json([$name, "Sikeres dolgozó felvétel!"]);
    }

    public function login(Request $request) {
        if(Auth::attempt(["email" => $request["email"], "password" => $request["password"]])) {
            $authUser = Auth::user();
                $token = $authUser->createToken($authUser->name."Token")->plainTextToken;
                $data["user"] = ["user" => $authUser->name];
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