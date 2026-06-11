<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movimiento;
use App\Models\Medicina;
use Carbon\Carbon;

class MovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener medicinas existentes
        $medicinas = Medicina::all();
        
        if ($medicinas->isEmpty()) {
            $this->command->warn('No hay medicinas para crear movimientos. Ejecuta MedicinaSeeder primero.');
            return;
        }

        $movimientos = [];
        $motivos_entrada = ['Compra a proveedor', 'Reposición de stock', 'Devolución de paciente', 'Ajuste de inventario'];
        $motivos_salida = ['Venta a paciente', 'Pérdida', 'Caducado', 'Ajuste de inventario', 'Traspaso a otra unidad'];

        // Crear movimientos para cada medicina
        foreach ($medicinas as $medicina) {
            // Crear entre 2-5 movimientos por medicina
            $num_movimientos = rand(2, 5);
            
            for ($i = 0; $i < $num_movimientos; $i++) {
                $tipo = rand(0, 1) === 0 ? 'Entrada' : 'Salida';
                $motivo = $tipo === 'Entrada' 
                    ? $motivos_entrada[array_rand($motivos_entrada)]
                    : $motivos_salida[array_rand($motivos_salida)];
                
                // Fecha aleatoria en los últimos 90 días
                $fecha = Carbon::now()->subDays(rand(0, 90));
                
                // Cantidad aleatoria entre 5 y 100
                $cantidad = rand(5, 100);

                $movimientos[] = [
                    'medicina_id' => $medicina->id,
                    'tipo_movimiento' => $tipo,
                    'cantidad' => $cantidad,
                    'fecha_movement' => $fecha->format('Y-m-d'),
                    'motivo' => $motivo,
                    'created_at' => $fecha,
                    'updated_at' => $fecha,
                ];
            }
        }

        // Insertar todos los movimientos
        Movimiento::insert($movimientos);
        
        $this->command->info('Se crearon ' . count($movimientos) . ' movimientos.');
    }
}
