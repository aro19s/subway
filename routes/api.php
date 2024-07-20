<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\SalesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    // Ingredientes
    Route::post('/ingredients/createIngredient', [IngredientsController::class, 'createIngredient'])->middleware('permission:añadir ingredientes');
    Route::get('/ingredients/showAllIngredients', [IngredientsController::class, 'showAllIngredients'])->middleware('permission:ver ingredientes');
    Route::get('/ingredients/showIngredientById/{id}', [IngredientsController::class, 'showIngredientById'])->middleware('permission:ver ingredientes');
    Route::delete('/ingredients/deleteIngredient/{id}', [IngredientsController::class, 'deleteIngredient'])->middleware('permission:borrar ingredientes');
    Route::put('/ingredients/updateIngredient/{id}', [IngredientsController::class, 'updateIngredient'])->middleware('permission:editar ingredientes');
    // Productos
    Route::post('/products/createProduct', [ProductsController::class, 'createProduct'])->middleware('permission:añadir productos');
    Route::get('/products/showProductById/{id}', [ProductsController::class, 'showProductById'])->middleware('permission:ver productos');
    Route::get('/products/showAllProducts', [ProductsController::class, 'showAllProducts'])->middleware('permission:ver productos');
    Route::put('/products/updateProduct/{id}', [ProductsController::class, 'updateProduct'])->middleware('permission:editar productos');
    Route::delete('/products/deleteProduct/{id}', [ProductsController::class, 'deleteProduct'])->middleware('permission:borrar productos');
    //Comprar
    Route::post('/purchase/purchaseProduct', [PurchasesController::class, 'purchase'])->middleware('permission:comprar productos');
    // Ver producto más comprado
    Route::get('/sales/topProduct', [SalesController::class, 'topProduct']);
    // Historial de compras
    Route::middleware(['role:admin_subway'])->group(function () {
        Route::get('/sales/salesHistory', [SalesController::class, 'salesHistory']);
    });
    // Cliente con más compras
    Route::middleware(['role:admin_subway'])->group(function () {
        Route::get('/customers/mostFrequentCustomer', [CustomersController::class, 'mostFrequentCustomer']);
    });
});
