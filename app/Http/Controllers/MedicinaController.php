<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMedicinaRequest;

use App\Models\Lote;
use App\Models\Medicina;
use App\Models\Categoria;
use App\Models\Proveedor;

/**
 * Controlador principal para gestionar el inventario de medicamentos.
 * 
 * Maneja el CRUD completo de medicinas, filtrado avanzado, exportación (PDF/CSV),
 * y consulta del kardex de movimientos. Solo los admins pueden crear/editar/eliminar,
 * mientras que farmacéuticos solo pueden consultar y registrar movimientos.
 */
class MedicinaController extends Controller
{
    /**
     * Aplica las policies de autorización automáticamente.
     * Esto asegura que solo los admins puedan modificar medicinas.
     */
    public function __construct()
    {
        $this->authorizeResource(\App\Models\Medicina::class, 'medicina');
    }

    /**
     * Construye la consulta de medicinas con todos los filtros aplicados.
     * 
     * Permite buscar por nombre comercial o principio activo, filtrar por categoría,
     * y filtrar por estado de stock (agotado, bajo, medio, alto). Se reutiliza en
     * index, exportPdf y exportCsv para mantener consistencia.
     */
    protected function buildMedicinasQuery(Request $request): Builder
    {
        $search = trim((string) $request->input('search', ''));
        $categoriaId = $request->input('categoria_id');
        $stockEstado = $request->input('stock_estado');

        $query = Medicina::query()->with('categoria');

        if ($search !== '') {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('nombre_comercial', 'like', "%{$search}%")
                    ->orWhere('principio_activo', 'like', "%{$search}%");
            });
        }

        if ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
        }

        if ($stockEstado === 'agotado') {
            $query->where('stock_actual', 0);
        } elseif ($stockEstado === 'bajo') {
            $query->whereColumn('stock_actual', '<=', 'stock_minimo')->where('stock_actual', '>', 0);
        } elseif ($stockEstado === 'medio') {
            $query->whereColumn('stock_actual', '>', 'stock_minimo')->whereRaw('stock_actual <= (stock_minimo * 3)');
        } elseif ($stockEstado === 'alto') {
            $query->whereRaw('stock_actual > (stock_minimo * 3)');
        }

        return $query;
    }

    /**
     * Muestra el inventario principal con todos los filtros y estadísticas.
     * 
     * Calcula resúmenes en tiempo real: total de medicinas, stock total, valor del inventario,
     * medicinas con stock bajo, y lotes próximos a vencer (30 días). Esta información
     * se muestra en el dashboard para toma de decisiones rápidas.
     */
    public function index(Request $request)
    {
        $categorias = Categoria::orderBy('nombre')->get();
        $search = trim((string) $request->input('search', ''));
        $categoriaId = $request->input('categoria_id');
        $stockEstado = $request->input('stock_estado');

        $medicinas = $this->buildMedicinasQuery($request)
            ->orderBy('nombre_comercial')
            ->paginate(15)
            ->appends($request->all());

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

        $resumen = [
            'total_medicinas' => Medicina::count(),
            'stock_total' => Medicina::sum('stock_actual'),
            'categorias' => Categoria::count(),
            'stock_bajo' => Medicina::whereColumn('stock_actual', '<=', 'stock_minimo')->where('stock_actual', '>', 0)->count(),
            'vencer_pronto' => $vencerPronto,
            'valor_total' => Medicina::selectRaw('SUM(stock_actual * precio_venta) as total')->value('total') ?? 0,
        ];

        return view('medicinas.index', compact('medicinas', 'categorias', 'resumen', 'search', 'categoriaId', 'stockEstado', 'vencerLotes'))
            ->with('proveedores', Proveedor::orderBy('nombre')->get());
    }

    /**
     * Muestra el inventario con el formulario de creación abierto.
     * 
     * Reutiliza la vista index pero con un flag para mostrar el modal de creación.
     * Esto permite agregar medicinas rápidamente sin salir de la vista principal.
     */
    public function create()
    {
        $this->authorize('create', Medicina::class);

        $categorias = Categoria::orderBy('nombre')->get();
        $medicinas = Medicina::query()->with('categoria')->orderBy('nombre_comercial')->paginate(15);

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

        $resumen = [
            'total_medicinas' => Medicina::count(),
            'stock_total' => Medicina::sum('stock_actual'),
            'categorias' => Categoria::count(),
            'stock_bajo' => Medicina::whereColumn('stock_actual', '<=', 'stock_minimo')->where('stock_actual', '>', 0)->count(),
            'vencer_pronto' => $vencerPronto,
            'valor_total' => Medicina::selectRaw('SUM(stock_actual * precio_venta) as total')->value('total') ?? 0,
        ];

        return view('medicinas.index', [
            'medicinas' => $medicinas,
            'categorias' => $categorias,
            'proveedores' => Proveedor::orderBy('nombre')->get(),
            'resumen' => $resumen,
            'search' => '',
            'categoriaId' => null,
            'stockEstado' => null,
            'show_create_form' => true,
            'vencerLotes' => $vencerLotes,
        ]);
    }

    /**
     * Exporta el inventario actual a PDF.
     * 
     * Usa DomPDF para generar un documento profesional con los resultados
     * de la búsqueda actual (respeta los filtros aplicados).
     */
    public function exportPdf(Request $request)
    {
        $medicinas = $this->buildMedicinasQuery($request)
            ->orderBy('nombre_comercial')
            ->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('medicinas.pdf', compact('medicinas'));
        return $pdf->download('Inventario_Medu.pdf');
    }

    /**
     * Exporta el inventario actual a CSV.
     * 
     * Genera un archivo compatible con Excel con BOM UTF-8 para mostrar
     * correctamente caracteres especiales. Incluye todos los campos importantes.
     */
    public function exportCsv(Request $request)
    {
        $medicinas = $this->buildMedicinasQuery($request)
            ->orderBy('nombre_comercial')
            ->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=inventario_medu.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($medicinas) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8
            fputcsv($file, ['Nombre Comercial', 'Principio Activo', 'Categoria', 'Precio de venta', 'Stock Actual', 'Stock Minimo', 'Ubicacion', 'Requiere Receta']);

            foreach ($medicinas as $medicina) {
                fputcsv($file, [
                    $medicina->nombre_comercial,
                    $medicina->principio_activo,
                    $medicina->categoria ? $medicina->categoria->nombre : 'Sin categoria',
                    $medicina->precio_venta,
                    $medicina->stock_actual,
                    $medicina->stock_minimo,
                    $medicina->ubicacion,
                    $medicina->requiere_receta ? 'Si' : 'No'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Retorna el kardex de movimientos de una medicina específica.
     * 
     * Se usa vía AJAX para mostrar el historial en un modal sin recargar la página.
     * Incluye el usuario que hizo el movimiento y el lote asociado si existe.
     */
    public function movimientos(Medicina $medicina)
    {
        $movimientos = \App\Models\Movimiento::with(['user', 'lote'])
            ->where('medicina_id', $medicina->id)
            ->orderBy('fecha_movement', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($movimientos);
    }

    /**
     * Guarda una nueva medicina en el inventario.
     * 
     * Si el usuario selecciona "crear nueva categoría", la crea automáticamente.
     * La validación se delega al FormRequest para mantener el controlador limpio.
     */
    public function store(StoreMedicinaRequest $request)
    {
        $this->authorize('create', Medicina::class);

        $validated = $request->validated();
        $categoriaId = $request->categoria_id;

        // Si el usuario quiere crear una categoría nueva, la hacemos al vuelo
        if ($categoriaId === 'nueva') {
            $categoria = Categoria::create([
                'nombre' => $request->nueva_categoria,
                'descripcion' => null,
            ]);
            $categoriaId = $categoria->id;
        }

        $data = $validated;
        $data['categoria_id'] = $categoriaId;
        Medicina::create($data);

        return redirect()->route('medicinas.index')->with('success', '¡Medicina guardada exitosamente!');
    }

    /**
     * Muestra el formulario para editar una medicina existente.
     * 
     * Carga todas las categorías y proveedores para permitir cambios.
     * La edición está protegida por policy (solo admins).
     */
    public function edit(Medicina $medicina)
    {
        $this->authorize('update', $medicina);

        $categorias = Categoria::all();
        $proveedores = Proveedor::orderBy('nombre')->get();
        return view('medicinas.edit', compact('medicina', 'categorias', 'proveedores'));
    }

    /**
     * Actualiza los datos de una medicina existente.
     * 
     * También permite crear una categoría nueva si el usuario lo selecciona.
     * Mantiene la lógica de validación en el FormRequest.
     */
    public function update(StoreMedicinaRequest $request, Medicina $medicina)
    {
        $this->authorize('update', $medicina);

        $validated = $request->validated();

        $categoriaId = $request->categoria_id;

        if ($categoriaId === 'nueva') {
            $categoria = Categoria::create([
                'nombre' => $request->nueva_categoria,
                'descripcion' => null,
            ]);
            $categoriaId = $categoria->id;
        }

        $data = $validated;
        $data['categoria_id'] = $categoriaId;
        $medicina->update($data);

        return redirect()->route('medicinas.index');
    }

    /**
     * Elimina una medicina del inventario (soft delete).
     * 
     * Usa soft deletes así que no se pierde el historial de movimientos.
     * Solo los admins pueden eliminar medicinas.
     */
    public function destroy(Medicina $medicina)
    {
        $this->authorize('delete', $medicina);

        $medicina->delete();

        return redirect()->route('medicinas.index')->with('success', 'La medicina ha sido eliminada.');
    }
}
