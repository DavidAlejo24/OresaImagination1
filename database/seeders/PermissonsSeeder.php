<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        Permission::create(["name"=>"usuarios.listar"]);
        Permission::create(["name"=>"usuarios.ver"]);
        Permission::create(["name"=>"usuarios.crear"]);
        Permission::create(["name"=>"usuarios.editar"]);
        Permission::create(["name"=>"usuarios.eliminar"]);
        Permission::create(["name"=>"users.ver"]);


        Role::first()->givePermissionTo(1);
        Role::first()->givePermissionTo(2);
        Role::first()->givePermissionTo(3);
        Role::first()->givePermissionTo(4);
        Role::first()->givePermissionTo(5);
        Role::first()->givePermissionTo(6);

        Role::find(2)->givePermissionTo(1);
        Role::find(2)->givePermissionTo(2);
        Role::find(2)->givePermissionTo(6);

        User::first()->assignRole(1);
        User::find(2)->assignRole(1);
        User::find(3)->assignRole(1);
        User::find(4)->assignRole(1);
        User::find(5)->assignRole(2);
    }
}
