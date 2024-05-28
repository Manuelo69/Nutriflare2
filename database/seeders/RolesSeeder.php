<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);

        // Asignar rol de admin al primer usuario registrado
        $firstUser = User::find(1);
        if ($firstUser)
            $firstUser->assignRole($adminRole);
    }
}
