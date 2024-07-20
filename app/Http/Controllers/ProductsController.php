<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    /**
     * Crea un producto
     *
     * @param CreateProductRequest $request
     * @return JsonResponse
     */
    public function createProduct(CreateProductRequest $request): JsonResponse
    {
        try {
            $product = Product::create($request->all());
            if ($request->has('ingredient_ids')) {
                $product->ingredients()->attach($request->ingredient_ids);
            }
            return response()->json([
                'success' => true,
                'message' => 'Producto creado con éxito',
                'data' => $product,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    /**
     * Muestra el producto por ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function showProductById($product_id): JsonResponse
    {
        try {
            $product = Product::with('ingredients')->findOrFail($product_id);
            return response()->json([
                'success' => true,
                'message' => 'Producto encontrado con éxito',
                'data' => $product,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    /**
     * Muestra todos los productos
     *
     * @return JsonResponse
     */
    public function showAllProducts(): JsonResponse
    {
        try {
            $products = Product::with('ingredients')->paginate(10);
            return response()->json([
                'success' => true,
                'message' => 'Productos encontrados con éxito',
                'data' => $products,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    /**
     * Actualiza un producto por su ID, incluyendo sus ingredientes
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateProduct(UpdateProductRequest $request, int $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());

            if ($request->has('ingredient_ids')) {
                $product->ingredients()->sync($request->ingredient_ids);
            }
            $product->load('ingredients');
            return response()->json([
                'success' => true,
                'message' => 'Producto actualizado con éxito',
                'data' => $product,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Elimina un producto
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteProduct($product_id): JsonResponse
    {
        try {
            $product = Product::findOrFail($product_id);
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado con éxito',
                'data' => null,
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
