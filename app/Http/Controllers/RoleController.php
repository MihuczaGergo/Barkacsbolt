<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    public function getRoles() {
        $roles = Role::all();
        return response() -> json($roles);
    }

    public function addRole(RoleRequest $request) {
        $request -> validated();
        $role = new Role();
        $role -> name = $request["name"];
        $role -> save();
        return response() -> json([$role, "Sikeres jogosultság felvétel!"]);
    }

    public function updateRoleName(RoleRequest $request) {
        $request -> validated();
        $role = Role::find($request["id"]);
        $role -> name = $request["name"];
        $role -> update();
        return response() -> json([$role, "Sikeres jogosultság név átírás!"]);
    }

    public function deleteRole(Request $request) {
        $role = Role::find($request["id"]);
        $role -> delete();
        return response() -> json([$role, "Sikeres jogosultság törlés!"]);
    }

    public function getRoleId($roleName) {
        $role = Role::where("name", $roleName) -> first();
        $id = $role -> id;
        return $id;
    }
}