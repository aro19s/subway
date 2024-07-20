<?php

namespace Database\Seeders;

use App\Models\ProductIngredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductIngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_ingredient')->insert([

            // Sándwich de Pollo
            ['product_id' => 1, 'ingredient_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Pan francés
            ['product_id' => 1, 'ingredient_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Lechuga
            ['product_id' => 1, 'ingredient_id' => 5, 'created_at' => now(), 'updated_at' => now()], // Pollo
            ['product_id' => 1, 'ingredient_id' => 6, 'created_at' => now(), 'updated_at' => now()], // Tomate
            ['product_id' => 1, 'ingredient_id' => 7, 'created_at' => now(), 'updated_at' => now()], // Pepino

            // Sándwich de Atún
            ['product_id' => 2, 'ingredient_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Pan blanco
            ['product_id' => 2, 'ingredient_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Lechuga
            ['product_id' => 2, 'ingredient_id' => 8, 'created_at' => now(), 'updated_at' => now()], // Atún
            ['product_id' => 2, 'ingredient_id' => 6, 'created_at' => now(), 'updated_at' => now()], // Tomate
            ['product_id' => 2, 'ingredient_id' => 9, 'created_at' => now(), 'updated_at' => now()], // Cebolla cabezona

            // Sándwich Italianísimo
            ['product_id' => 3, 'ingredient_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Pan baguette
            ['product_id' => 3, 'ingredient_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Lechuga
            ['product_id' => 3, 'ingredient_id' => 10, 'created_at' => now(), 'updated_at' => now()], // Salami
            ['product_id' => 3, 'ingredient_id' => 11, 'created_at' => now(), 'updated_at' => now()], // Zanahoria
            ['product_id' => 3, 'ingredient_id' => 12, 'created_at' => now(), 'updated_at' => now()], // Pimentón

        ]);
    }
}
