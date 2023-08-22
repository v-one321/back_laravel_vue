<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginLaravel()
    {
    }
    public function registro(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users|email",
            "password" => "required|string",
            "c_password" => "required|some:password",
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->save();
        return response()->json(["mensaje" => "Usuario registrado"]);
    }
    public function perfil()
    {
    }
    public function logout()
    {
    }
    public function prueba(Request $request)
    {
        return response()->json(["mensaje" => "controlador api"]);
    }
}
