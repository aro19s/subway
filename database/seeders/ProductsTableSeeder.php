<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['product_name' => 'Sándwich de pollo', 'price' => 5.00, 'created_at' => now(), 'updated_at' => now()],
            ['product_name' => 'Sándwich de atún', 'price' => 6.00, 'created_at' => now(), 'updated_at' => now()],
            ['product_name' => 'Sándwich italianísimo', 'price' => 7.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
