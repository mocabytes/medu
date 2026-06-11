<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Analgésicos', 'descripcion' => 'Medicamentos para aliviar el dolor.'],
            ['nombre' => 'Antibióticos', 'descripcion' => 'Medicamentos para combatir infecciones bacterianas.'],
            ['nombre' => 'Antiinflamatorios', 'descripcion' => 'Medicamentos para reducir la inflamación.'],
            ['nombre' => 'Antihistamínicos', 'descripcion' => 'Medicamentos para el tratamiento de alergias.'],
            ['nombre' => 'Antipiréticos', 'descripcion' => 'Medicamentos para reducir la fiebre.'],
            ['nombre' => 'Antiácidos y Antiulcerosos', 'descripcion' => 'Medicamentos que neutralizan el ácido del estómago o tratan úlceras.'],
            ['nombre' => 'Cardiovasculares', 'descripcion' => 'Medicamentos para afecciones del corazón y presión arterial.'],
            ['nombre' => 'Dermatológicos', 'descripcion' => 'Productos para el tratamiento de afecciones de la piel.'],
            ['nombre' => 'Gastrointestinales', 'descripcion' => 'Medicamentos para problemas del sistema digestivo.'],
            ['nombre' => 'Suplementos y Vitaminas', 'descripcion' => 'Complementos nutricionales.'],
            ['nombre' => 'Respiratorios', 'descripcion' => 'Medicamentos para asma, tos y afecciones respiratorias.'],
            ['nombre' => 'Oftalmológicos', 'descripcion' => 'Tratamientos y gotas para los ojos.'],
            ['nombre' => 'Antimicóticos', 'descripcion' => 'Medicamentos para tratar infecciones por hongos.'],
            ['nombre' => 'Psicofármacos', 'descripcion' => 'Medicamentos para trastornos psiquiátricos o neurológicos.'],
            ['nombre' => 'Antidiabéticos', 'descripcion' => 'Medicamentos para el control del azúcar en la sangre.'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(
                ['nombre' => $categoria['nombre']],
                ['descripcion' => $categoria['descripcion']]
            );
        }
    }
}
