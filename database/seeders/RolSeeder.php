<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolPrincipal = Role::create(['name' => 'Principal']);
        $rolSecundario = Role::create(['name' => 'Secundario']);

        //PERMISOS ADMINISTRADOR-USERS
        Permission::create(["name"=> "usuarios"])->assignRole($rolPrincipal);
        Permission::create(["name"=> "create"])->assignRole($rolPrincipal);
        Permission::create(["name"=> "edit"])->assignRole($rolPrincipal);
        Permission::create(["name"=> "delete"])->assignRole($rolPrincipal);

        //PERMISOS ADMINISTRADOR-USERS
        Permission::create(["name"=> "Suppliers"])->syncRoles([$rolPrincipal, $rolSecundario]);
        Permission::create(["name"=> "Suppliers.create"])->syncRoles([$rolPrincipal, $rolSecundario]);
        Permission::create(["name"=> "Suppliers.edit"])->syncRoles([$rolPrincipal, $rolSecundario]);
        Permission::create(["name"=> "Suppliers.delete"])->syncRoles([$rolPrincipal, $rolSecundario]);

        //PERMISOS ADMINISTRADOR-USERS
        Permission::create(["name"=> "Repuestos"])->syncRoles([$rolPrincipal, $rolSecundario]);
        Permission::create(["name"=> "Repuestos.create"])->syncRoles([$rolPrincipal, $rolSecundario]);
        Permission::create(["name"=> "Repuestos.edit"])->syncRoles([$rolPrincipal, $rolSecundario]);
        Permission::create(["name"=> "Repuestos.delete"])->syncRoles([$rolPrincipal, $rolSecundario]);
    }
}
