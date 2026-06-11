<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lote;
use App\Models\Medicina;
use Carbon\Carbon;

class LoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener medicinas existentes
        $medicinas = Medicina::all();
        
        if ($medicinas->isEmpty()) {
            $this->command->warn('No hay medicinas para crear lotes. Ejecuta MedicinaSeeder primero.');
            return;
        }

        $lotes = [];
        $loteCounter = 1;

        // Crear entre 1-3 lotes por medicina
        foreach ($medicinas as $medicina) {
            $num_lotes = rand(1, 3);
            
            for ($i = 0; $i < $num_lotes; $i++) {
                // Generar código de lote único
                $codigo_lote = 'LOT-' . date('Y') . '-' . str_pad($loteCounter++, 4, '0', STR_PAD_LEFT);
                
                // Fecha de vencimiento entre 6 meses y 3 años en el futuro
                $fecha_vencimiento = Carbon::now()->addMonths(rand(6, 36));
                
                // Cantidad inicial entre 50 y 500
                $cantidad_inicial = rand(50, 500);
                
                // Cantidad restante entre 20% y 100% de la inicial
                $cantidad_restante = rand($cantidad_inicial * 0.2, $cantidad_inicial);

                $lotes[] = [
                    'codigo_lote' => $codigo_lote,
                    'medicina_id' => $medicina->id,
                    'fecha_vencimiento' => $fecha_vencimiento->format('Y-m-d'),
                    'cantidad_inicial' => $cantidad_inicial,
                    'cantidad_restante' => $cantidad_restante,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        // Insertar todos los lotes
        Lote::insert($lotes);
        
        $this->command->info('Se crearon ' . count($lotes) . ' lotes.');
    }
}
