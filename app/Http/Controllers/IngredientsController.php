<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ingredients\IngredientRequest;
use App\Models\Ingredient;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    /**
     * Crea un ingrediente
     *
     * @param IngredientRequest $request
     * @return JsonResponse
     */
    public function createIngredient(IngredientRequest $request): JsonResponse
    {
        try {
            $ingredient = Ingredient::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Ingrediente creado con éxito',
                'data' => $ingredient,
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
     * Muestra todos los ingredientes
     *
     * @return JsonResponse
     */
    public function showAllIngredients(): JsonResponse
    {
        try {
            $ingredients = Ingredient::paginate(10);
            return response()->json([
                'success' => true,
                'message' => 'Ingredientes encontrados con éxito',
                'data' => $ingredients,
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
     * Muestra el ingrediente por ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function showIngredientById(int $id): JsonResponse
    {
        try {
            $ingredient = Ingredient::find($id);

            if (!$ingredient) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ingrediente no existe',
                    'data' => null
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Ingrediente encontrado con éxito',
                'data' => $ingredient,
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
     * Actualiza un ingrediente
     *
     * @param IngredientRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateIngredient(IngredientRequest $request, int $id): JsonResponse
    {
        try {
            $ingredient = Ingredient::find($id);
            if (!$ingredient) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ingrediente no encontrado',
                    'data' => null
                ], 404);
            }
            $ingredient->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Ingrediente actualizado con éxito',
                'data' => $ingredient
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    /**
     * Elimina un ingrediente por ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteIngredient(int $id): JsonResponse
    {
        try {
            $ingredient = Ingredient::find($id);
            if (!$ingredient) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ingrediente no encontrado',
                    'data' => null
                ], 404);
            }
            $ingredient->delete();
            return response()->json([
                'success' => true,
                'message' => 'Ingrediente eliminado con éxito',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }
}
