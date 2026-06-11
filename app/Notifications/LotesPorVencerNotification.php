<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

/**
 * Notificación por email para alertar sobre lotes próximos a vencer.
 * 
 * Se envía a todos los administradores cuando el comando de vencimientos
 * detecta lotes que expiran en los próximos 30 días. Incluye el código
 * del lote, nombre del medicamento, fecha de vencimiento y cantidad restante.
 */
class LotesPorVencerNotification extends Notification
{
    use Queueable;

    public Collection $lotes;

    /**
     * Constructor que recibe la colección de lotes próximos a vencer.
     */
    public function __construct(Collection $lotes)
    {
        $this->lotes = $lotes;
    }

    /**
     * Canales por los que se envía la notificación.
     * Por ahora solo email, pero se podría agregar database o broadcast.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Construye el email que se enviará a los administradores.
     * 
     * Incluye un saludo personalizado, la lista de lotes con sus detalles,
     * y un llamado a la acción para revisar el inventario.
     */
    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Alerta de lotes próximos a vencer')
            ->greeting('Hola ' . $notifiable->name . ',')
            ->line('Se han detectado lotes que vencen en los próximos 30 días.');

        foreach ($this->lotes as $lote) {
            $message->line("- Lote {$lote->codigo_lote} de {$lote->medicina->nombre_comercial} vence el {$lote->fecha_vencimiento} y tiene {$lote->cantidad_restante} unidades.");
        }

        return $message->line('Por favor, revise el inventario y tome las acciones necesarias.');
    }

    /**
     * Representación en array de la notificación.
     * 
     * Útil si se quiere guardar en la base de datos o enviar por otros canales.
     * Incluye el conteo y los detalles estructurados de cada lote.
     */
    public function toArray($notifiable)
    {
        return [
            'count' => $this->lotes->count(),
            'lotes' => $this->lotes->map(function ($lote) {
                return [
                    'codigo_lote' => $lote->codigo_lote,
                    'medicina' => $lote->medicina->nombre_comercial,
                    'fecha_vencimiento' => $lote->fecha_vencimiento,
                    'cantidad_restante' => $lote->cantidad_restante,
                ];
            })->toArray(),
        ];
    }
}
