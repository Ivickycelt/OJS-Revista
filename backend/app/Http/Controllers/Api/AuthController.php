<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Solo se usan name, email y password: el rol siempre queda como 'lector'.
        $usuario = User::create($datos);
        $usuario->refresh();

        return response()->json([
            'user' => $this->datosUsuario($usuario),
            'token' => $usuario->createToken('horizontes')->plainTextToken,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $usuario = User::where('email', $datos['email'])->first();

        // Mismo mensaje si falla el correo o la contraseña (no revela cuál fue).
        if (! $usuario || ! Hash::check($datos['password'], $usuario->password)) {
            return response()->json(['message' => 'Credenciales incorrectas.'], 401);
        }

        return response()->json([
            'user' => $this->datosUsuario($usuario),
            'token' => $usuario->createToken('horizontes')->plainTextToken,
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($this->datosUsuario($request->user()));
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada.']);
    }

    private function datosUsuario(User $usuario): array
    {
        return [
            'id' => $usuario->id,
            'name' => $usuario->name,
            'email' => $usuario->email,
            'role' => $usuario->role,
        ];
    }
}
