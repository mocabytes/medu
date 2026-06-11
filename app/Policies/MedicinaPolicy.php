<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Medicina;

/**
 * Policy para controlar el acceso a las operaciones de medicinas.
 * 
 * Define quién puede hacer qué con el inventario. La regla es simple:
 * - Cualquier usuario autenticado puede ver el inventario
 * - Solo los admins pueden crear, editar o eliminar medicinas
 * 
 * Los farmacéuticos solo pueden consultar y registrar movimientos, no modificar
 * el catálogo de productos.
 */
class MedicinaPolicy
{
    /**
     * Cualquier usuario autenticado puede ver la lista de medicinas.
     * Tanto admins como farmacéuticos necesitan consultar el inventario.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Cualquier usuario autenticado puede ver los detalles de una medicina.
     * Necesario para mostrar el kardex y la información completa.
     */
    public function view(User $user, Medicina $medicina): bool
    {
        return true;
    }

    /**
     * Solo los administradores pueden crear nuevas medicinas.
     * Los farmacéuticos no deben agregar productos al catálogo.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Solo los administradores pueden editar medicinas existentes.
     * Cambios de precios, proveedores o categorías requieren autorización.
     */
    public function update(User $user, Medicina $medicina): bool
    {
        return $user->isAdmin();
    }

    /**
     * Solo los administradores pueden eliminar medicinas.
     * Es una acción destructiva que afecta el historial de movimientos.
     */
    public function delete(User $user, Medicina $medicina): bool
    {
        return $user->isAdmin();
    }
}
