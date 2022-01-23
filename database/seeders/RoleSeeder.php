<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'usuario']);

        Permission::create(['name' => 'admin.clientes.index',
                            'description' => 'Ver listado de clientes'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.clientes.create',
                            'description' => 'Crear clientes'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.clientes.edit',
                            'description' => 'Editar clientes'])->syncRoles([$role1]);

        Permission::create(['name' => 'productos.productos.index',
                            'description' => 'Ver listado de productos'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'productos.productos.create',
                            'description' => 'Crear productos'])->syncRoles([$role1]);
        Permission::create(['name' => 'productos.productos.edit',
                            'description' => 'Editar productos'])->syncRoles([$role1]);
        Permission::create(['name' => 'productos.productos.destroy',
                            'description' => 'Eliminar productos'])->syncRoles([$role1]);
    }
}
