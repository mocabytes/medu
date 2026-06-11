<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles
        Role::firstOrCreate(['name' => 'admin'], ['description' => 'Acceso total al sistema']);
        Role::firstOrCreate(['name' => 'farmaceutico'], ['description' => 'Acceso operativo de farmacia']);

        // Crear categorías comunes de medicamentos
        $this->call(CategoriasSeeder::class);

        // Crear proveedores
        $this->call(ProveedorSeeder::class);

        // Crear medicinas con datos realistas
        $this->call(MedicinaSeeder::class);

        // Crear lotes de medicamentos
        $this->call(LoteSeeder::class);

        // Crear movimientos de entrada/salida
        $this->call(MovimientoSeeder::class);

        // Crear usuarios de prueba
        $adminRole = Role::where('name', 'admin')->first();
        $farmaceuticoRole = Role::where('name', 'farmaceutico')->first();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test Admin',
                'password' => bcrypt('password'),
                'role_id' => $adminRole->id,
            ]
        );

        User::firstOrCreate(
            ['email' => 'farmacia@example.com'],
            [
                'name' => 'Test Farmacéutico',
                'password' => bcrypt('password'),
                'role_id' => $farmaceuticoRole->id,
            ]
        );
    }
}
