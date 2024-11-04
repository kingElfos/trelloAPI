<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Método para registrar un nuevo usuario
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'token'   => $token,
        ], 201);
    }

    // Método para iniciar sesión
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'    => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Credenciales inválidas'], 401);
            }

            try {
                $token = $user->createToken('auth_token')->plainTextToken;
            } catch (\Exception $e) {
                // Error al generar el token
                return response()->json([
                    'message' => 'Error al generar el token de autenticación',
                    'error'   => $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'token'   => $token,
            ], 200);

        } catch (\Exception $e) {
            // Error general en el proceso de login
            return response()->json([
                'message' => 'Error al intentar iniciar sesión',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    // Método para cerrar sesión
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente',
        ]);
    }
}
