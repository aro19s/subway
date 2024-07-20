<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Pepito',
            'email' => 'admin_subway@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $user1->assignRole('admin_subway');

        $user2 = User::create([
            'name' => 'Darío',
            'email' => 'dario_cliente@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('dario123'),
            'remember_token' => Str::random(10),
        ]);
        $user2->assignRole('customer_subway');
    }
}
