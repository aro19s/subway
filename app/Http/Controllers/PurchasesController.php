<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\PurchaseRequest;
use App\Models\Bill;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasesController extends Controller
{
    /**
     * Comprar producto
     *
     * @param PurchaseRequest $request
     * @return JsonResponse
     */
    public function purchase(PurchaseRequest $request): JsonResponse
    {
        try {
            // Asegura que las operaciones sean completadas con éxito antes de confirmar los cambios
            DB::beginTransaction();

            $user = $request->user();

            $product = Product::findOrFail($request->product_id);
            $totalPrice = $product->price * $request->amount;

            $bill = Bill::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'amount' => $request->amount,
                'total_price' => $totalPrice,
            ]);

            // Confirmar los cambios
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Factura generada con éxito',
                'data' => $bill
            ], 201);

        } catch (Exception $e) {
            // En caso de error, se revierten los cambios
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
