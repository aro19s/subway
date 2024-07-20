<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert([
            ['ingredient_name' => 'Pan francés', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Pan blanco', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Pan baguette', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Lechuga', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Pollo', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Tomate', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Pepino', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Atún', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Cebolla cabezona', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Salami', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Zanahoria', 'created_at' => now(), 'updated_at' => now()],
            ['ingredient_name' => 'Pimentón', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
