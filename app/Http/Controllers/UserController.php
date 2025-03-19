<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Carbon\Carbon;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request) {
        $request -> validated();
        $user = User::create([
            "name" => $request["name"],
            "password" => bcrypt($request["password"]),
            "email" => $request["email"],
            "address" => $request["address"],
            "role_id" => (new RoleController) -> getRoleId($request["role"])
        ]);
        return response() -> json([$user -> name, "Sikeres felhasználó felvétel!"]);
    }

    public function login(UserLoginRequest $request) {
        $request->validated();
        if(Auth::attempt(["email" => $request["email"], "password" => $request["password"]])) {
            $actualTime = Carbon::now();
            $authUser = Auth::user();
            $bannedTime = (new BannerController) -> getBannedTime($authUser -> email);
            (new BannerController)->resetLoginCounter($authUser -> email);
            if($bannedTime < $actualTime) {
                (new BannerController) -> resetBannedTime($authUser -> email);
                $token = $authUser -> createToken($authUser -> name."Token") -> plainTextToken;
                $data["user"] = ["user" => $authUser -> name];
                $data["time"] = $bannedTime;
                $data["admin"] = $authUser -> admin;
                $data["token"] = $token;
                return response() -> json([$data, "Sikeres bejelentkezés!"]);
            }
            else {
                return response() -> json(["Azonosítási hiba!", ["Következő lehetőség: ", $bannedTime]]); 
            }
        }
        else {
            $loginCounter = (new BannerController) -> getLoginCounter($request["email"]);
            if($loginCounter < 3) {
                (new BannerController) -> setLoginCounter($request["email"]);
                return response() -> json("Hibás felhasználónév vagy jelszó!");
            }
            else {
                (new BannerController) -> setBannedTime($request["email"]);
                $bannedTime = (new BannerController) -> getBannedTime($request["email"]);
                return response() -> json(["Azonosítási hiba!", ["Következő lehetőség: ", $bannedTime]]);
            }
        }
    }

    public function logout(Request $request) {
        auth("sanctum") -> user() -> currentAccessToken() -> delete();
        $name = auth("sanctum") -> user() -> name;
        return response() -> json([$name, "Sikeresen kijelentkezett!"]);
    }

    public function getUsers() {
        $users = User::all();
        return response() -> json($users);
    }
}