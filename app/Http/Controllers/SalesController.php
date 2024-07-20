<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Producto más vendido
     *
     * @return JsonResponse
     */
    public function topProduct(): JsonResponse
    {
        try {
            // Obtener la cantidad máxima vendida por cada producto individualmente
            $maxSales = Product::withSum('bills', 'amount')
                ->orderBy('bills_sum_amount', 'desc') // Siempre se nombra relación_sum_campo
                ->first()
                ->bills_sum_amount; // Accede al atributo del primer producto para obtener el mayor valor

            // Obtener todos los productos con la cantidad máxima vendida
            $topProducts = Product::withSum('bills', 'amount')
                ->having('bills_sum_amount', $maxSales) // Filtra los productos que bills_sum_amount sea igual a $maxSales
                ->orderBy('product_name', 'asc')
                ->get();

            if ($topProducts->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay información de productos vendidos',
                    'data' => null
                ], 404);
            }

            // Da formato a la respuesta puesto que son datos recuperados de una base de datos
            $data = $topProducts->map(function ($product) {
                return [
                    'product_id' => $product->id,
                    'name' => $product->product_name,
                    'total_sales' => $product->bills_sum_amount,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Producto(s) más vendido(s)',
                'data' => $data
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Historial de ventas
     *
     * @return JsonResponse
     */
    public function salesHistory(): JsonResponse
    {
        try {
            $history = Bill::with('users')->paginate(10);
            return response()->json([
                'success' => true,
                'message' => 'Historial encontrado con éxito',
                'data' => $history,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }
}
