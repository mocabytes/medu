<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo para gestionar los lotes de medicamentos.
 * 
 * Esta es la parte crítica del sistema de vencimientos. Cada lote tiene su fecha de vencimiento
 * y controlamos la cantidad restante para saber cuándo estamos por quedarnos sin stock.
 * El comando de vencimientos revisa esta tabla para alertar sobre lotes próximos a vencer.
 */
class Lote extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_lote',
        'medicina_id',
        'fecha_vencimiento',
        'cantidad_inicial',
        'cantidad_restante',
    ];

    /**
     * Un lote pertenece a una sola medicina.
     * Por ejemplo, el lote "LOT-2026-001" puede ser del medicamento "Paracetamol 500mg".
     */
    public function medicina(): BelongsTo
    {
        return $this->belongsTo(Medicina::class);
    }
}
