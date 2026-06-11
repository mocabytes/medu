<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->string('numero_lote')->nullable()->after('motivo');
            $table->date('fecha_creacion')->nullable()->after('numero_lote');
            $table->date('fecha_vencimiento')->nullable()->after('fecha_creacion');
            $table->string('laboratorio')->nullable()->after('fecha_vencimiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropColumn(['numero_lote', 'fecha_creacion', 'fecha_vencimiento', 'laboratorio']);
        });
    }
};
