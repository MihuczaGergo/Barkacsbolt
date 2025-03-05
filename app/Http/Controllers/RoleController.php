<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function getRoles() {
        $roles = Role::all();
        return response() -> json($roles);
    }

    public function addRole(Request $request) {
        $role = new Role();
        $role -> name = $request["name"];
        $role -> save();
        return response() -> json([$role, "Sikeres jogosultság felvétel!"]);
    }

    public function updateRoleName(Request $request) {
        $role = Role::find("id");
        $role -> name = $request["name"];
        $role -> update();
        return response() -> json([$role, "Sikeres jogosultság né átírás!"]);
    }

    public function deleteRole(Request $request) {
        $role = Role::find($request["id"]);
        $role -> delete();
        return response() -> json([$role, "Sikeres jogosultság törlés!"]);
    }
}