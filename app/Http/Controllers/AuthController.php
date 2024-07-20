<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Inicia sesión para un usuario existente.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                throw ValidationException::withMessages([
                    'email' => ['Las credenciales proporcionadas son incorrectas.'],
                ]);
            }
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'token' => $token,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 401);
        }
    }

    /**
     * Cierra sesión para el usuario autenticado actualmente.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(AuthRequest $request): JsonResponse
    {
        try {
            // Eliminar Token
            $request->user()->tokens()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Cierre de sesión exitoso',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
