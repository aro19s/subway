<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Resetea el caché
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permisos
        Permission::create(['name' => 'añadir productos']);
        Permission::create(['name' => 'editar productos']);
        Permission::create(['name' => 'ver productos']);
        Permission::create(['name' => 'borrar productos']);
        Permission::create(['name' => 'añadir ingredientes']);
        Permission::create(['name' => 'editar ingredientes']);
        Permission::create(['name' => 'ver ingredientes']);
        Permission::create(['name' => 'borrar ingredientes']);
        Permission::create(['name' => 'comprar productos']);

        // Rol admin
        $role = Role::create(['name' => 'admin_subway']);
        $role->givePermissionTo('añadir productos','editar productos','ver productos','borrar productos','añadir ingredientes','editar ingredientes','ver ingredientes','borrar ingredientes','comprar productos');
        // Rol customer
        $role = Role::create(['name' => 'customer_subway']);
        $role->givePermissionTo('comprar productos','ver productos');
    }
}
