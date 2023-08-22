<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginLaravel(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);
        $credenciales = request(["email", "password"]);
        if (!Auth::attempt($credenciales)) {
            return response()->json(["mensaje" => "No autorizado"], 401);
        } else {
            $usuario = $request->user();
            $tokenResult = $usuario->createToken('Personal token');
            $token = $tokenResult->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        }
    }
    public function registro(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users|email",
            "password" => "required|string",
            "c_password" => "required|same:password",
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
        $user = Auth::user();
        return response()->json([$user, 200]);
    }
    public function logout()
    {
        Auth::user()->tokens()->delete();        
        return response()->json(["mensaje" => "Tokens eliminados"]);
    }
    public function prueba()
    {
        return response()->json(["mensaje" => "controlador"]);
    }
}
