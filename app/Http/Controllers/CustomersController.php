<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Obtiene el cliente más frecuente.
     *
     * @return JsonResponse
     */
    public function mostFrequentCustomer(): JsonResponse
    {
        try {
            // A cada usuario le cuenta las facturas
            $maxBills = User::withCount('bills')
                ->orderBy('bills_count', 'desc')
                ->first()
                ->bills_count; // Accede al atributo del primer producto para obtener el mayor valor

            $users = User::withCount('bills')
                ->having('bills_count', $maxBills)
                ->orderBy('name', 'asc')
                ->get();

            $data = $users->map(function ($user) {
                return [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'total_sales' => $user->bills_count,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Cliente(s) con más compras',
                'data' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
