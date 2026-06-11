<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para categorizar los medicamentos.
 * 
 * Las categorías ayudan a organizar el inventario: Analgésicos, Antibióticos, Vitaminas, etc.
 * Es una forma simple de clasificación para facilitar búsquedas y reportes.
 */
class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}
