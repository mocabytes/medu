<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo para registrar el historial de movimientos de stock.
 * 
 * Cada entrada, salida o ajuste de inventario se registra aquí. Es el kardex del sistema:
 * sabemos quién hizo el movimiento, cuándo, por qué (compra, venta, merma, devolución)
 * y de qué lote provino. Esto es fundamental para auditoría y control.
 */
class Movimiento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'medicina_id',
        'lote_id',
        'user_id',
        'tipo',
        'cantidad',
        'fecha_movement',
        'motivo',
    ];

    /**
     * El movimiento está asociado a una medicina.
     * Por ejemplo, una salida de 5 unidades de "Paracetamol".
     */
    public function medicina(): BelongsTo
    {
        return $this->belongsTo(Medicina::class);
    }

    /**
     * El movimiento puede estar asociado a un lote específico.
     * Esto permite rastrear de qué lote salió o entró el medicamento.
     */
    public function lote(): BelongsTo
    {
        return $this->belongsTo(Lote::class);
    }

    /**
     * Usuario que realizó el movimiento.
     * Importante para saber quién hizo cada operación en el inventario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
