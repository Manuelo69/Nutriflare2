<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
        DB::table('ejercicios')->delete();
        $this->call(EjerciciosSeeder::class);
        DB::table('platos')->delete();
        DB::table('valores_nutricionales')->delete();
        $this->call(PlatosSeeder::class);
        DB::table('users')->delete();
        $this->call(UserSeeder::class);
        User::factory(20)->create();
    }
}