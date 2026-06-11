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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            // FK conectando con Medicinas:
            $table->foreignId('medicina_id')->constrained('medicinas')->onDelete('cascade');
            $table->enum('tipo_movimiento', ['Entrada', 'Salida']); // Solo permite estas dos palabras
            $table->integer('cantidad');
            $table->date('fecha');
            $table->string('motivo');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
