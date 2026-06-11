<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            if (Schema::hasColumn('movimientos', 'medicamento_id')) {
                $table->dropForeign(['medicamento_id']);
                $table->dropColumn('medicamento_id');
            }

            if (Schema::hasColumn('movimientos', 'tipo_movimiento')) {
                $table->dropColumn('tipo_movimiento');
            }

            if (Schema::hasColumn('movimientos', 'fecha')) {
                $table->dropColumn('fecha');
            }
        });
    }

    public function down(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            if (! Schema::hasColumn('movimientos', 'tipo_movimiento')) {
                $table->enum('tipo_movimiento', ['Entrada', 'Salida'])->after('medicina_id');
            }

            if (! Schema::hasColumn('movimientos', 'fecha')) {
                $table->date('fecha')->nullable()->after('cantidad');
            }

            if (! Schema::hasColumn('movimientos', 'medicamento_id')) {
                $table->foreignId('medicamento_id')->nullable()->after('medicina_id')->constrained('medicinas')->nullOnDelete();
            }
        });
    }
};
