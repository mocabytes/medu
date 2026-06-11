<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            if (! Schema::hasColumn('movimientos', 'tipo')) {
                $table->enum('tipo', ['entrada', 'salida', 'ajuste'])->default('ajuste')->after('medicina_id');
            }
            if (! Schema::hasColumn('movimientos', 'fecha_movement')) {
                $table->date('fecha_movement')->nullable()->after('motivo');
            }
            if (! Schema::hasColumn('movimientos', 'medicamento_id')) {
                $table->foreignId('medicamento_id')->nullable()->after('medicina_id')->constrained('medicinas')->nullOnDelete();
            }
        });

        DB::table('movimientos')->whereNotNull('tipo_movimiento')->get()->each(function ($movimiento) {
            DB::table('movimientos')->where('id', $movimiento->id)->update([
                'tipo' => strtolower($movimiento->tipo_movimiento),
                'fecha_movement' => $movimiento->fecha,
                'medicamento_id' => $movimiento->medicina_id,
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            if (Schema::hasColumn('movimientos', 'tipo')) {
                $table->dropColumn('tipo');
            }
            if (Schema::hasColumn('movimientos', 'fecha_movement')) {
                $table->dropColumn('fecha_movement');
            }
            if (Schema::hasColumn('movimientos', 'medicamento_id')) {
                $table->dropForeign(['medicamento_id']);
                $table->dropColumn('medicamento_id');
            }
        });
    }
};
