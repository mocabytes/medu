<?php

namespace Tests\Feature;

use App\Models\Lote;
use App\Models\Medicina;
use App\Models\User;
use App\Notifications\LotesPorVencerNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class CheckVencimientosCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_vencimientos_command_sends_notification_to_admins()
    {
        Notification::fake();

        $adminRole = \App\Models\Role::firstOrCreate(['name' => 'admin'], ['description' => 'Administrador']);
        $admin = User::factory()->create(['role_id' => $adminRole->id]);

        $medicina = Medicina::create([
            'categoria_id' => \App\Models\Categoria::create(['nombre' => 'TestCategoria', 'descripcion' => null])->id,
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
            'stock_actual' => 5,
            'stock_minimo' => 2,
            'requiere_receta' => false,
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);

        Lote::create([
            'codigo_lote' => 'LOT-001',
            'medicina_id' => $medicina->id,
            'fecha_vencimiento' => now()->addDays(10),
            'cantidad_inicial' => 5,
            'cantidad_restante' => 5,
        ]);

        $this->artisan('medu:check-vencimientos')->assertExitCode(0);

        Notification::assertSentTo([$admin], LotesPorVencerNotification::class, function ($notification, $channels) {
            return $notification->lotes->count() === 1;
        });
    }
}
