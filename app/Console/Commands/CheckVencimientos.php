<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Lote;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LotesPorVencerNotification;

/**
 * Comando Artisan para revisar lotes próximos a vencer.
 * 
 * Este comando se debe ejecutar diariamente (por ejemplo, via cron job) para
 * alertar a los administradores sobre lotes que vencen en los próximos 30 días.
 * Envía notificaciones por email y también escribe en el log para tener registro.
 */
class CheckVencimientos extends Command
{
    /**
     * Nombre del comando para ejecutarlo desde la terminal.
     * Uso: php artisan medu:check-vencimientos
     */
    protected $signature = 'medu:check-vencimientos';

    /**
     * Descripción del comando (aparece al listar comandos con php artisan list).
     */
    protected $description = 'Revisa los lotes que vencen en los próximos 30 días y notifica a los administradores';

    /**
     * Ejecuta la lógica del comando.
     * 
     * Busca lotes con cantidad restante > 0 que vencen en los próximos 30 días.
     * Si encuentra lotes, notifica a todos los administradores por email y
     * escribe los detalles en el log para auditoría.
     */
    public function handle()
    {
        // Buscamos lotes que vencen en los próximos 30 días y todavía tienen stock
        $vencerPronto = Lote::with('medicina')
            ->whereNotNull('fecha_vencimiento')
            ->where('cantidad_restante', '>', 0)
            ->whereDate('fecha_vencimiento', '>=', now())
            ->whereDate('fecha_vencimiento', '<=', now()->addDays(30))
            ->orderBy('fecha_vencimiento')
            ->get();

        if ($vencerPronto->count() > 0) {
            $this->info("Se encontraron {$vencerPronto->count()} lotes por vencer.");

            // Obtenemos todos los usuarios con rol de administrador
            $administradores = User::whereHas('role', function ($query) {
                $query->where('name', 'admin');
            })->get();

            if ($administradores->isNotEmpty()) {
                // Enviamos la notificación por email a cada admin
                Notification::send($administradores, new LotesPorVencerNotification($vencerPronto));
                $this->info('Notificación enviada a los administradores.');
            } else {
                Log::warning('No se encontraron administradores para notificar.');
            }

            // También escribimos en el log para tener registro permanente
            Log::warning("MEDU ALERTA: Hay {$vencerPronto->count()} lotes que vencen en los próximos 30 días.");
            foreach ($vencerPronto as $lote) {
                Log::warning("- Lote {$lote->codigo_lote} de " . ($lote->medicina->nombre_comercial ?? 'Desconocida') . " vence el {$lote->fecha_vencimiento}.");
            }
        } else {
            $this->info('Todo en orden. No hay lotes próximos a vencer.');
        }
    }
}
