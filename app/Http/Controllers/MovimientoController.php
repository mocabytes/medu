<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovimientoRequest;
use App\Models\Movimiento;
use App\Models\Medicina;
use App\Models\Lote;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Controlador para registrar movimientos de inventario.
 * 
 * Maneja las entradas, salidas y ajustes de stock. Lo crítico aquí es que
 * todo ocurre dentro de una transacción de base de datos: si algo falla,
 * no se actualiza ni el stock de la medicina ni la cantidad del lote.
 * Esto evita inconsistencias en el inventario.
 */
class MovimientoController extends Controller
{
    /**
     * Muestra el inventario con el formulario de movimientos abierto.
     * 
     * Reutiliza la vista index pero con un flag para mostrar el modal de movimientos.
     * Carga todos los lotes disponibles para que el usuario pueda seleccionar
     * de cuál está entrando o saliendo el medicamento.
     */
    public function create()
    {
        $vencerPronto = Lote::with('medicina')
            ->whereNotNull('fecha_vencimiento')
            ->where('cantidad_restante', '>', 0)
            ->whereDate('fecha_vencimiento', '>=', now())
            ->whereDate('fecha_vencimiento', '<=', now()->addDays(30))
            ->distinct('medicina_id')
            ->count('medicina_id');

        $vencerLotes = Lote::with('medicina')
            ->whereNotNull('fecha_vencimiento')
            ->where('cantidad_restante', '>', 0)
            ->whereDate('fecha_vencimiento', '>=', now())
            ->whereDate('fecha_vencimiento', '<=', now()->addDays(30))
            ->orderBy('fecha_vencimiento')
            ->limit(5)
            ->get();

        return view('medicinas.index', [
            'medicinas' => Medicina::query()->with('categoria')->orderBy('nombre_comercial')->get(),
            'categorias' => \App\Models\Categoria::orderBy('nombre')->get(),
            'lotes' => Lote::with('medicina')->orderBy('codigo_lote')->get(),
            'resumen' => [
                'total_medicinas' => Medicina::count(),
                'stock_total' => Medicina::sum('stock_actual'),
                'categorias' => \App\Models\Categoria::count(),
                'stock_bajo' => Medicina::whereColumn('stock_actual', '<=', 'stock_minimo')->where('stock_actual', '>', 0)->count(),
                'vencer_pronto' => $vencerPronto,
                'valor_total' => Medicina::selectRaw('SUM(stock_actual * precio_venta) as total')->value('total') ?? 0,
            ],
            'vencerLotes' => $vencerLotes,
            'search' => '',
            'categoriaId' => null,
            'stockEstado' => null,
            'show_movimiento_form' => true,
        ]);
    }

    /**
     * Registra un nuevo movimiento de stock dentro de una transacción.
     * 
     * La transacción es crítica porque actualiza dos cosas simultáneamente:
     * 1. El stock actual de la medicina
     * 2. La cantidad restante del lote (si se especifica)
     * 
     * Si algo falla en medio, todo se revierte automáticamente. También usa
     * lockForUpdate() para evitar race conditions si dos usuarios registran
     * movimientos al mismo tiempo sobre el mismo medicamento.
     */
    public function store(StoreMovimientoRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['tipo'] = strtolower($validated['tipo_movimiento']);
        $validated['fecha_movement'] = $validated['fecha'];
        unset($validated['tipo_movimiento'], $validated['fecha']);

        DB::transaction(function () use ($validated) {
            $movimiento = Movimiento::create($validated);

            // Si se especificó un lote, actualizamos su cantidad restante
            if (! empty($validated['lote_id'])) {
                $lote = Lote::lockForUpdate()->find($validated['lote_id']);
                if ($lote) {
                    if ($validated['tipo'] === 'entrada') {
                        $lote->cantidad_restante += $validated['cantidad'];
                    } else {
                        $lote->cantidad_restante -= $validated['cantidad'];
                    }
                    $lote->save();
                }
            }

            // Siempre actualizamos el stock de la medicina
            $medicina = Medicina::lockForUpdate()->findOrFail($validated['medicina_id']);

            if ($validated['tipo'] === 'entrada') {
                $medicina->stock_actual += $validated['cantidad'];
            } else {
                $medicina->stock_actual -= $validated['cantidad'];
            }

            $medicina->save();
        });

        return redirect()->route('medicinas.index')->with('success', 'Movimiento registrado correctamente.');
    }
}
