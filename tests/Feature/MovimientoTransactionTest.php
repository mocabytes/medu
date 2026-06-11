<?php

namespace Tests\Feature;

use App\Models\Lote;
use App\Models\Medicina;
use App\Models\Movimiento;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovimientoTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_movimiento_store_updates_stock_and_lote_inside_transaction()
    {
        $user = User::factory()->create();

        $categoria = \App\Models\Categoria::create([
            'nombre' => 'TestCategoria',
            'descripcion' => null,
        ]);

        $medicina = Medicina::create([
            'categoria_id' => $categoria->id,
            'proveedor_id' => null,
            'nombre_comercial' => 'TestMed',
            'principio_activo' => 'Test',
            'presentacion' => 'Caja',
            'concentracion' => '10mg',
            'laboratorio' => 'TestLab',
            'codigo_barras' => '1234',
            'ubicacion' => 'A1',
            'precio_compra' => 10,
            'precio_venta' => 15,
            'stock_actual' => 0,
            'stock_minimo' => 5,
            'requiere_receta' => false,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $lote = Lote::create([
            'codigo_lote' => 'LOT-2026',
            'medicina_id' => $medicina->id,
            'fecha_vencimiento' => now()->addDays(20),
            'cantidad_inicial' => 10,
            'cantidad_restante' => 0,
        ]);

        $response = $this->actingAs($user)->post(route('movimientos.store'), [
            'medicina_id' => $medicina->id,
            'lote_id' => $lote->id,
            'tipo_movimiento' => 'Entrada',
            'cantidad' => 5,
            'fecha' => now()->toDateString(),
            'motivo' => 'compra',
        ]);

        $response->assertRedirect(route('medicinas.index'));

        $this->assertDatabaseHas('movimientos', [
            'medicina_id' => $medicina->id,
            'lote_id' => $lote->id,
            'user_id' => $user->id,
            'tipo_movimiento' => 'Entrada',
            'cantidad' => 5,
            'motivo' => 'compra',
        ]);

        $this->assertEquals(5, $medicina->fresh()->stock_actual);
        $this->assertEquals(5, $lote->fresh()->cantidad_restante);
    }
}
