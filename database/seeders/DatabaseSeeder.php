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

        if (!$adminRole || !$farmaceuticoRole) {
            $this->command->error('No se encontraron los roles. Verifica que se hayan creado correctamente.');
            return;
        }

        $this->command->info('Creando usuarios...');
        $this->command->info("adminRole ID: {$adminRole->id}, farmaceuticoRole ID: {$farmaceuticoRole->id}");

        $adminUser = User::create([
            'name' => 'Test Admin',
            'email' => 'test@example.com',
            'password' => 'password',
            'role_id' => $adminRole->id,
        ]);
        $this->command->info("Admin user created: ID {$adminUser->id}");

        $farmaceuticoUser = User::create([
            'name' => 'Test Farmacéutico',
            'email' => 'farmacia@example.com',
            'password' => 'password',
            'role_id' => $farmaceuticoRole->id,
        ]);
        $this->command->info("Farmaceutico user created: ID {$farmaceuticoUser->id}");
    }
}
