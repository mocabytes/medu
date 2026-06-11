@extends('layouts.dashboard')

@section('title', 'Inventario - Medu')

@section('content')
    <div class="space-y-6">
        <section class="grid gap-4 lg:grid-cols-[1.45fr_1fr] animate-slide-up">
            <div class="overflow-hidden rounded-4xl border border-emerald-100 bg-white/95 p-8 text-slate-900 shadow-2xl shadow-emerald-900/5 animate-slide-up hover:scale-[1.02] hover:-translate-y-1 transition-all duration-300">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center rounded-full border border-emerald-100 bg-emerald-50/60 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.28em] text-emerald-700">
                        Dashboard clínico
                    </div>
                    <h1 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl text-slate-900">
                        Controla medicinas, stock y trazabilidad desde un solo panel.
                    </h1>
                    <p class="mt-4 max-w-xl text-sm leading-7 text-slate-600 sm:text-base">
                        Una vista más limpia, más profesional y pensada para operar rápido: inventario, lotes, vencimientos y movimientos en un mismo espacio.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        @can('create', App\Models\Medicina::class)
                        <button type="button" id="abrir-formulario" class="rounded-full bg-emerald-600 px-4 py-2 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:translate-y-px hover:bg-emerald-700 hover:scale-105 hover:shadow-xl hover:shadow-emerald-300">
                            + Nueva medicina
                        </button>
                        @endcan
                        <button type="button" id="abrir-formulario-movimiento" class="rounded-full border border-emerald-200 bg-white px-4 py-2 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50 hover:scale-105 hover:shadow-md">
                            Registrar movimiento
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-[1.75rem] min-w-0 border border-white/70 bg-white/85 p-5 shadow-xl shadow-slate-200/50 backdrop-blur animate-slide-up hover:scale-[1.02] hover:-translate-y-1 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-100/30" style="animation-delay: 0.1s">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Medicinas</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">{{ number_format($resumen['total_medicinas']) }}</p>
                    <p class="mt-2 text-sm text-slate-600">Registros activos en inventario.</p>
                </div>
                <div class="rounded-[1.75rem] min-w-0 border border-white/70 bg-white/85 p-5 shadow-xl shadow-slate-200/50 backdrop-blur animate-slide-up hover:scale-[1.02] hover:-translate-y-1 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-100/30" style="animation-delay: 0.2s">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Stock total</p>
                    <p class="mt-3 text-2xl font-bold text-slate-900 truncate">{{ number_format($resumen['stock_total']) }}</p>
                    <p class="mt-2 text-sm text-slate-600">Unidades sumadas entre todas las medicinas.</p>
                </div>
                <div class="rounded-[1.75rem] min-w-0 border border-white/70 bg-white/85 p-5 shadow-xl shadow-slate-200/50 backdrop-blur animate-slide-up hover:scale-[1.02] hover:-translate-y-1 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-100/30" style="animation-delay: 0.3s">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Categorías</p>
                    <p class="mt-3 text-3xl font-bold text-slate-900">{{ number_format($resumen['categorias']) }}</p>
                    <p class="mt-2 text-sm text-slate-600">Clasificación disponible para filtrar.</p>
                </div>
                @php
                    $isBajo = $resumen['stock_bajo'] > 0;
                    $cardClass = $isBajo 
                        ? 'border-amber-200 bg-amber-50/90 shadow-amber-100/50' 
                        : 'border-white/70 bg-white/85 shadow-slate-200/50';
                    $titleClass = $isBajo ? 'text-amber-700' : 'text-slate-500';
                    $numClass = $isBajo ? 'text-amber-900' : 'text-slate-900';
                    $descClass = $isBajo ? 'text-amber-800/80' : 'text-slate-600';
                @endphp
                <div class="rounded-[1.75rem] min-w-0 border {{ $cardClass }} p-5 shadow-xl backdrop-blur animate-slide-up hover:scale-[1.02] hover:-translate-y-1 transition-all duration-300 hover:shadow-2xl" style="animation-delay: 0.4s">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] {{ $titleClass }}">Stock bajo</p>
                    <p class="mt-3 text-3xl font-bold {{ $numClass }}">{{ number_format($resumen['stock_bajo']) }}</p>
                    <p class="mt-2 text-sm {{ $descClass }}">Medicinas por debajo del umbral recomendado.</p>
                </div>
                @php
                    $isVencer = $resumen['vencer_pronto'] > 0;
                    $vCardClass = $isVencer 
                        ? 'border-rose-200 bg-rose-50/90 shadow-rose-100/50' 
                        : 'border-white/70 bg-white/85 shadow-slate-200/50';
                    $vTitleClass = $isVencer ? 'text-rose-700' : 'text-slate-500';
                    $vNumClass = $isVencer ? 'text-rose-900' : 'text-slate-900';
                    $vDescClass = $isVencer ? 'text-rose-800/80' : 'text-slate-600';
                @endphp
                <div class="rounded-[1.75rem] min-w-0 border {{ $vCardClass }} p-5 shadow-xl backdrop-blur animate-slide-up hover:scale-[1.02] hover:-translate-y-1 transition-all duration-300 hover:shadow-2xl" style="animation-delay: 0.5s">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] {{ $vTitleClass }}">Por vencer</p>
                    <p class="mt-3 text-3xl font-bold {{ $vNumClass }}">{{ number_format($resumen['vencer_pronto']) }}</p>
                    <p class="mt-2 text-sm {{ $vDescClass }}">Lotes que vencen en los próximos 30 días.</p>
                </div>
                
                <!-- Tarjeta 6: Valor de Inventario -->
                <div class="rounded-[1.75rem] min-w-0 border border-white/70 bg-white/85 p-5 shadow-xl shadow-slate-200/50 backdrop-blur animate-slide-up hover:scale-[1.02] hover:-translate-y-1 transition-all duration-300 hover:shadow-2xl hover:shadow-emerald-100/30" style="animation-delay: 0.6s">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Valor en stock</p>
                    <p class="mt-3 text-2xl font-bold text-slate-900 break-all overflow-wrap-anywhere">${{ number_format($resumen['valor_total']) }}</p>
                    <p class="mt-2 text-sm text-slate-600">Suma total del capital invertido.</p>
                </div>
            </div>
        </section>

        @php
            $currentUser = auth()->user();
            $currentRoleName = $currentUser?->role_name;
        @endphp
        @if($currentUser && ! $currentUser->isAdmin())
            <div class="rounded-4xl border border-slate-200 bg-slate-50 p-4 text-slate-900 shadow-sm shadow-slate-200 mb-6 animate-slide-up" style="animation-delay: 0.1s">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-900">Acceso limitado</p>
                        @if($currentRoleName && $currentRoleName !== 'sin rol')
                            <p class="text-sm text-slate-600">Tu rol actual es <span class="font-semibold">{{ ucfirst($currentRoleName) }}</span>. Solo puedes registrar movimientos y consultar el inventario.</p>
                        @else
                            <p class="text-sm text-slate-600">No se ha asignado un rol válido a tu cuenta. Contacta al administrador para poder continuar.</p>
                        @endif
                    </div>
                    @if($currentRoleName && $currentRoleName !== 'sin rol')
                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-slate-700">{{ ucfirst($currentRoleName) }}</span>
                    @endif
                </div>
            </div>
        @endif

        @if(session('success'))
            <div id="alerta-exito" class="flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-4 text-emerald-900 shadow-sm shadow-emerald-100 animate-fade-in">
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-600 text-white">✓</div>
                <div>
                    <p class="font-semibold">Operación completada</p>
                    <p class="text-sm text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if($resumen['vencer_pronto'] > 0)
            <div class="flex flex-col gap-4 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-4 text-rose-900 shadow-sm shadow-rose-100 sm:flex-row sm:items-center sm:justify-between animate-fade-in" style="animation-delay: 0.2s">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-rose-600 text-white">⚠️</div>
                    <div>
                        <p class="font-semibold">Alerta de vencimientos</p>
                        <p class="text-sm text-rose-800">Hay {{ number_format($resumen['vencer_pronto']) }} lote(s) que vencen en los próximos 30 días.</p>
                    </div>
                </div>
                <a href="#vencer-lotes" class="inline-flex items-center rounded-full border border-rose-200 bg-white px-4 py-2 text-sm font-semibold text-rose-700 transition hover:bg-rose-100 hover:scale-105 hover:shadow-md">
                    Ver lotes en riesgo
                </a>
            </div>

            @if(!empty($vencerLotes) && $vencerLotes->isNotEmpty())
                <div id="vencer-lotes" class="mt-4 overflow-hidden rounded-4xl border border-rose-200 bg-white/90 p-4 shadow-sm shadow-rose-100 animate-slide-up" style="animation-delay: 0.3s">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-rose-700">Lotes próximos a vencer</p>
                            <p class="mt-2 text-sm text-slate-600">Se muestran los primeros {{ number_format($vencerLotes->count()) }} lotes con vencimiento dentro de 30 días.</p>
                        </div>
                    </div>
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full text-left text-sm text-slate-700">
                            <thead class="border-b border-rose-100 text-slate-500">
                                <tr>
                                    <th class="px-3 py-3">Código</th>
                                    <th class="px-3 py-3">Medicina</th>
                                    <th class="px-3 py-3">Vence</th>
                                    <th class="px-3 py-3 text-right">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vencerLotes as $lote)
                                    <tr class="border-b border-slate-100 hover:bg-rose-50/50 transition animate-fade-in" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                        <td class="px-3 py-3 font-medium text-slate-900">{{ $lote->codigo_lote }}</td>
                                        <td class="px-3 py-3">{{ $lote->medicina->nombre_comercial ?? 'Sin medicina' }}</td>
                                        <td class="px-3 py-3 text-rose-700">{{ $lote->fecha_vencimiento }}</td>
                                        <td class="px-3 py-3 text-right font-semibold text-slate-900">{{ number_format($lote->cantidad_restante) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endif

        <section class="rounded-4xl border border-white/70 bg-white/85 p-5 shadow-xl shadow-slate-200/50 backdrop-blur sm:p-6 animate-slide-up" style="animation-delay: 0.2s">
            <div class="flex flex-col gap-3 border-b border-slate-200 pb-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Filtrar inventario</h2>
                    <p class="mt-1 text-sm text-slate-500">Encuentra medicinas por nombre, principio activo, categoría o nivel de stock.</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="relative inline-block text-left">
                        <button type="button" onclick="document.getElementById('export-menu').classList.toggle('hidden')" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800 hover:scale-105 hover:shadow-md">
                            Exportar
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="export-menu" class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-xl border border-slate-200 bg-white shadow-xl focus:outline-none overflow-hidden">
                            <a href="{{ route('medicinas.exportPdf', request()->all()) }}" target="_blank" class="block px-4 py-3 text-sm font-medium text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 transition">
                                📄 Exportar a PDF
                            </a>
                            <a href="{{ route('medicinas.exportCsv', request()->all()) }}" class="block px-4 py-3 text-sm font-medium text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 transition border-t border-slate-100">
                                📊 Exportar a Excel
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('medicinas.index') }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800 hover:scale-105 hover:shadow-md">
                        Limpiar filtros
                    </a>
                </div>
            </div>

            <form method="GET" class="mt-5 grid gap-4 lg:grid-cols-[1.2fr_0.8fr_0.8fr_auto]" id="filter-form">
                <label class="block">
                    <span class="mb-2 block text-sm font-semibold text-slate-700">Búsqueda</span>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Nombre comercial o principio activo" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-semibold text-slate-700">Categoría</span>
                    <select name="categoria_id" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        <option value="">Todas las categorías</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @selected((string) $categoriaId === (string) $categoria->id)>{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-semibold text-slate-700">Stock</span>
                    <select name="stock_estado" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        <option value="">Todos</option>
                        <option value="agotado" @selected($stockEstado === 'agotado')>Agotado</option>
                        <option value="bajo" @selected($stockEstado === 'bajo')>Bajo</option>
                        <option value="medio" @selected($stockEstado === 'medio')>Medio</option>
                        <option value="alto" @selected($stockEstado === 'alto')>Alto</option>
                    </select>
                </label>

                <div class="flex items-end">
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-slate-900/15 transition hover:bg-slate-800 hover:scale-105 hover:shadow-xl hover:shadow-slate-900/25">
                        Aplicar
                    </button>
                </div>
            </form>
        </section>
                    
        <section class="overflow-hidden rounded-4xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50 animate-slide-up" style="animation-delay: 0.3s">
            <div class="flex flex-col gap-4 border-b border-slate-200 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Inventario de medicinas</h2>
                    <p class="text-sm text-slate-500">Información resumida y acción rápida para cada registro.</p>
                </div>
                <div class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">{{ $medicinas->count() }} resultados</div>
            </div>

            <div id="table-container">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.24em] text-slate-500">Medicina</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.24em] text-slate-500">Categoría</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.24em] text-slate-500">Ubicación</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.24em] text-slate-500">Precio de venta</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-[0.24em] text-slate-500">Stock</th>
                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-[0.24em] text-slate-500">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse ($medicinas as $medicina)
                                @php
                                    $stockBadge = match (true) {
                                        $medicina->stock_actual === 0 => 'bg-rose-100 text-rose-700 ring-1 ring-rose-200',
                                        $medicina->stock_actual <= $medicina->stock_minimo => 'bg-amber-100 text-amber-800 ring-1 ring-amber-200',
                                        default => 'bg-emerald-100 text-emerald-700 ring-1 ring-emerald-200',
                                    };
                                @endphp
                                <tr class="transition hover:bg-slate-50/80 hover:scale-[1.01] hover:shadow-md animate-fade-in" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                    <td class="px-6 py-5">
                                        <div class="font-bold text-slate-900 text-base">
                                            {{ $medicina->nombre_comercial }} 
                                            @if($medicina->concentracion) <span class="font-medium text-slate-500 text-sm">({{ $medicina->concentracion }})</span> @endif
                                        </div>
                                        <div class="mt-1 text-sm text-slate-600">
                                            <span class="font-medium text-slate-700">{{ $medicina->principio_activo }}</span>
                                            @if($medicina->presentacion) <span class="text-slate-400 mx-1">•</span> {{ $medicina->presentacion }} @endif
                                        </div>
                                        @if($medicina->laboratorio || $medicina->codigo_barras)
                                            <div class="mt-2 flex flex-wrap items-center gap-3 text-[11px] font-semibold tracking-wider uppercase text-slate-400">
                                                @if($medicina->laboratorio) <span>🏢 {{ $medicina->laboratorio }}</span> @endif
                                                @if($medicina->codigo_barras) <span>🔢 Cód: {{ $medicina->codigo_barras }}</span> @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">{{ $medicina->categoria?->nombre ?? 'Sin categoría' }}</span>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-medium text-slate-600">
                                        {{ $medicina->ubicacion ?: '--' }}
                                    </td>
                                    <td class="px-6 py-5 text-sm font-semibold text-slate-700">${{ number_format((float) $medicina->precio_venta, 2) }}</td>
                                    <td class="px-6 py-5">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $stockBadge }}">{{ $medicina->stock_actual }} unidades</span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <div class="inline-flex items-center gap-2">
                                            <button type="button" onclick="verKardex({{ $medicina->id }})" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-indigo-600 transition hover:border-indigo-200 hover:bg-indigo-50 hover:scale-110 hover:rotate-12" title="Ver Historial (Kardex)">📋</button>
                                            @can('update', $medicina)
                                                <a href="{{ route('medicinas.edit', $medicina->id) }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-sky-700 transition hover:border-sky-200 hover:bg-sky-50 hover:scale-110 hover:-rotate-12" title="Editar">✎</a>
                                            @endcan
                                            @can('delete', $medicina)
                                                <form action="{{ route('medicinas.destroy', $medicina->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas borrar esta medicina?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-white text-rose-600 transition hover:border-rose-200 hover:bg-rose-50 hover:scale-110 hover:shake" title="Borrar">🗑</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="mx-auto max-w-md">
                                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-2xl">💊</div>
                                            @if(empty($search) && empty($categoriaId) && empty($stockEstado))
                                                <h3 class="mt-4 text-lg font-bold text-slate-900">Aún no hay medicinas registradas</h3>
                                                <p class="mt-2 text-sm leading-6 text-slate-500">¡Comienza agregando tu primera medicina al inventario usando el botón superior!</p>
                                            @else
                                                <h3 class="mt-4 text-lg font-bold text-slate-900">No hay medicinas con esos filtros</h3>
                                                <p class="mt-2 text-sm leading-6 text-slate-500">Prueba limpiar la búsqueda para ver el resto del inventario.</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($medicinas->hasPages())
                    <div class="border-t border-slate-200 p-5">
                        {{ $medicinas->links() }}
                    </div>
                @endif
            </div>
        </section>
    </div>

    <div id="modal-medicina" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/60 px-4 py-8 backdrop-blur-sm animate-fade-in">
        <div class="relative w-full max-w-2xl rounded-4xl border border-white/20 bg-white shadow-2xl shadow-slate-950/30 animate-slide-up">
            <button type="button" id="cerrar-formulario" class="absolute right-4 top-4 rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-600 transition hover:bg-slate-200 hover:scale-110">Cerrar</button>
            <div class="p-6 sm:p-8">
                <div class="mb-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-700">Nuevo registro</p>
                    <h2 class="mt-2 text-2xl font-bold text-slate-900">Registrar medicina</h2>
                    <p class="mt-2 text-sm text-slate-500">Alta rápida para el inventario con datos principales y categoría.</p>
                </div>

                @if($errors->any() && old('form_type') === 'medicina')
                    <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 animate-fade-in">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('medicinas.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="form_type" value="medicina">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Nombre comercial</span>
                            <input type="text" name="nombre_comercial" value="{{ old('nombre_comercial') }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Principio activo</span>
                            <input type="text" name="principio_activo" value="{{ old('principio_activo') }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Presentación</span>
                            <input type="text" name="presentacion" value="{{ old('presentacion') }}" placeholder="Ej. Caja con 20 tabletas" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Concentración</span>
                            <input type="text" name="concentracion" value="{{ old('concentracion') }}" placeholder="Ej. 500mg" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>
                        
                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Laboratorio</span>
                            <input type="text" name="laboratorio" value="{{ old('laboratorio') }}" placeholder="Ej. Bayer" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Código de Barras</span>
                            <input type="text" name="codigo_barras" value="{{ old('codigo_barras') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Ubicación física</span>
                            <input type="text" name="ubicacion" value="{{ old('ubicacion') }}" placeholder="Ej. Estante A" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Categoría</span>
                            <select name="categoria_id" id="categoria_select" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                                <option value="">Selecciona una categoría...</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @selected((string) old('categoria_id') === (string) $categoria->id)>{{ $categoria->nombre }}</option>
                                @endforeach
                                <option value="nueva">+ Crear nueva categoría</option>
                            </select>
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Proveedor</span>
                            <select name="proveedor_id" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                                <option value="">Selecciona un proveedor</option>
                                @foreach($proveedores ?? [] as $proveedor)
                                    <option value="{{ $proveedor->id }}" @selected((string) old('proveedor_id') === (string) $proveedor->id)>{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="block" id="nueva_categoria_container" style="display: none;">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Nueva categoría</span>
                            <input type="text" name="nueva_categoria" id="nueva_categoria" value="{{ old('nueva_categoria') }}" placeholder="Nombre de la nueva categoría" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Precio de compra ($)</span>
                            <input type="number" step="0.01" min="0" name="precio_compra" value="{{ old('precio_compra') }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Precio de venta ($)</span>
                            <input type="number" step="0.01" min="0" name="precio_venta" value="{{ old('precio_venta') }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Stock inicial</span>
                            <input type="number" min="0" name="stock_actual" value="{{ old('stock_actual', 0) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Stock Mínimo (Alerta)</span>
                            <input type="number" min="0" name="stock_minimo" value="{{ old('stock_minimo', 10) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 focus:scale-[1.02]">
                        </label>

                        <label class="block md:col-span-2 items-center gap-3">
                            <input type="checkbox" name="requiere_receta" value="1" @checked(old('requiere_receta')) class="h-5 w-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="text-sm font-semibold text-slate-700">Requiere receta médica para su venta</span>
                        </label>
                    </div>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <button type="button" id="cancelar-formulario" class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:scale-105 animate-fade-in">Cancelar</button>
                        <button type="submit" class="rounded-full bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700 hover:scale-105 hover:shadow-xl hover:shadow-emerald-600/30 animate-fade-in">Guardar medicina</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modal-movimiento" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/60 px-4 py-8 backdrop-blur-sm">
    <div class="relative w-full max-w-2xl rounded-4xl border border-white/20 bg-white shadow-2xl shadow-slate-950/30">
            <button type="button" id="cerrar-formulario-movimiento" class="absolute right-4 top-4 rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-600 transition hover:bg-slate-200">Cerrar</button>
            <div class="p-6 sm:p-8">
                <div class="mb-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-sky-700">Movimientos</p>
                    <h2 class="mt-2 text-2xl font-bold text-slate-900">Registrar entrada o salida</h2>
                    <p class="mt-2 text-sm text-slate-500">En entradas podrás seleccionar un lote existente para llevar trazabilidad de inventario.</p>
                </div>

                @if($errors->any() && old('form_type') === 'movimiento')
                    <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('movimientos.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="form_type" value="movimiento">

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <label class="block md:col-span-2">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Medicina</span>
                            <select name="medicina_id" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-sky-400 focus:ring-4 focus:ring-sky-100">
                                <option value="">Selecciona el medicamento...</option>
                                @foreach($medicinas as $medicina)
                                    <option value="{{ $medicina->id }}" @selected((string) old('medicina_id') === (string) $medicina->id)>{{ $medicina->nombre_comercial }} (stock: {{ $medicina->stock_actual }})</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Tipo de movimiento</span>
                            <select name="tipo_movimiento" id="tipo_movimiento" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-sky-400 focus:ring-4 focus:ring-sky-100">
                                <option value="Entrada" @selected(old('tipo_movimiento', 'Entrada') === 'Entrada')>Entrada (compra a proveedor)</option>
                                <option value="Salida" @selected(old('tipo_movimiento') === 'Salida')>Salida (venta a cliente)</option>
                            </select>
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Cantidad</span>
                            <input type="number" min="1" name="cantidad" value="{{ old('cantidad') }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-sky-400 focus:ring-4 focus:ring-sky-100">
                        </label>

                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Fecha</span>
                            <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-sky-400 focus:ring-4 focus:ring-sky-100">
                        </label>

                        <label class="block md:col-span-2">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Motivo</span>
                            <select name="motivo" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-sky-400 focus:ring-4 focus:ring-sky-100">
                                <option value="compra" @selected(old('motivo') === 'compra')>Compra</option>
                                <option value="venta" @selected(old('motivo') === 'venta')>Venta</option>
                                <option value="merma" @selected(old('motivo') === 'merma')>Merma</option>
                                <option value="devolucion" @selected(old('motivo') === 'devolucion')>Devolución</option>
                            </select>
                        </label>
                    </div>

                    <div id="campos-entrada" class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <label class="block">
                            <span class="mb-2 block text-sm font-semibold text-slate-700">Lote</span>
                            <select name="lote_id" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-sky-400 focus:ring-4 focus:ring-sky-100">
                                <option value="">Selecciona un lote</option>
                                @foreach($lotes ?? [] as $lote)
                                    <option value="{{ $lote->id }}" @selected((string) old('lote_id') === (string) $lote->id)>{{ $lote->codigo_lote }} — {{ $lote->medicina->nombre_comercial ?? 'Medicamento desconocido' }} @if($lote->fecha_vencimiento) (vence {{ $lote->fecha_vencimiento }})@endif</option>
                                @endforeach
                            </select>
                        </label>

                    </div>

                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                        <button type="button" id="cancelar-formulario-movimiento" class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Cancelar</button>
                        <button type="submit" class="rounded-full bg-sky-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-sky-600/20 transition hover:bg-sky-700">Registrar movimiento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Kardex -->
    <div id="modal-kardex" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/60 px-4 py-8 backdrop-blur-sm">
    <div class="relative w-full max-w-4xl rounded-4xl border border-white/20 bg-white shadow-2xl shadow-slate-950/30">
            <button type="button" onclick="closeModal(document.getElementById('modal-kardex'))" class="absolute right-4 top-4 rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-600 transition hover:bg-slate-200">Cerrar</button>
            <div class="p-6 sm:p-8">
                <div class="mb-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-indigo-700">Auditoría</p>
                    <h2 class="mt-2 text-2xl font-bold text-slate-900">Kardex de Movimientos</h2>
                </div>
                <div class="overflow-x-auto max-h-96">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-widest text-slate-500">Fecha</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-widest text-slate-500">Tipo</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-widest text-slate-500">Motivo</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-widest text-slate-500">Usuario</th>
                                <th class="px-4 py-3 text-right text-xs font-bold uppercase tracking-widest text-slate-500">Cant.</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-widest text-slate-500">Lote / Venc.</th>
                            </tr>
                        </thead>
                        <tbody id="kardex-tbody" class="divide-y divide-slate-100 bg-white">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const modal = document.getElementById('modal-medicina');
        const modalMovimiento = document.getElementById('modal-movimiento');
        const openButton = document.getElementById('abrir-formulario');
        const openMovimientoButton = document.getElementById('abrir-formulario-movimiento');
        const closeButtons = [document.getElementById('cerrar-formulario'), document.getElementById('cancelar-formulario')];
        const closeMovimientoButtons = [document.getElementById('cerrar-formulario-movimiento'), document.getElementById('cancelar-formulario-movimiento')];
        const tipoMovimientoSelect = document.getElementById('tipo_movimiento');
        const camposEntrada = document.getElementById('campos-entrada');

        function openModal(element) {
            element.classList.remove('hidden');
            element.classList.add('flex');
        }

        function closeModal(element) {
            element.classList.add('hidden');
            element.classList.remove('flex');
        }

        function toggleCamposEntrada() {
            const isEntrada = tipoMovimientoSelect?.value === 'Entrada';
            camposEntrada?.classList.toggle('hidden', !isEntrada);

            camposEntrada?.querySelectorAll('input').forEach((input) => {
                if (isEntrada) {
                    input.setAttribute('required', 'required');
                } else {
                    input.removeAttribute('required');
                    input.value = '';
                }
            });
        }

        const categoriaSelect = document.getElementById('categoria_select');
        const nuevaCategoriaContainer = document.getElementById('nueva_categoria_container');
        const nuevaCategoriaInput = document.getElementById('nueva_categoria');

        function toggleNuevaCategoria() {
            const isNueva = categoriaSelect?.value === 'nueva';
            nuevaCategoriaContainer.style.display = isNueva ? 'block' : 'none';
            if (isNueva) {
                nuevaCategoriaInput.setAttribute('required', 'required');
                nuevaCategoriaInput.focus();
            } else {
                nuevaCategoriaInput.removeAttribute('required');
                nuevaCategoriaInput.value = '';
            }
        }

        categoriaSelect?.addEventListener('change', toggleNuevaCategoria);
        toggleNuevaCategoria(); // Initialize on page load

        openButton?.addEventListener('click', () => openModal(modal));
        openMovimientoButton?.addEventListener('click', () => openModal(modalMovimiento));
        closeButtons.forEach((button) => button?.addEventListener('click', () => closeModal(modal)));
        closeMovimientoButtons.forEach((button) => button?.addEventListener('click', () => closeModal(modalMovimiento)));

        modal?.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal(modal);
            }
        });

        modalMovimiento?.addEventListener('click', (event) => {
            if (event.target === modalMovimiento) {
                closeModal(modalMovimiento);
            }
        });

        tipoMovimientoSelect?.addEventListener('change', toggleCamposEntrada);
        toggleCamposEntrada();

        @if(session('show_create_form') || request()->routeIs('medicinas.create') || old('form_type') === 'medicina')
            openModal(modal);
        @endif

        @if(session('show_movimiento_form') || request()->routeIs('movimientos.create') || old('form_type') === 'movimiento')
            openModal(modalMovimiento);
        @endif

        const successAlert = document.getElementById('alerta-exito');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 400);
            }, 3500);
        }

        // AJAX Search
        const filterForm = document.getElementById('filter-form');
        let debounceTimer;
        
        function submitAjaxForm() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const url = new URL(window.location.href);
                const formData = new FormData(filterForm);
                formData.forEach((value, key) => url.searchParams.set(key, value));
                
                fetch(url.toString(), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newTable = doc.getElementById('table-container');
                    const tableContainer = document.getElementById('table-container');
                    if (newTable && tableContainer) {
                        tableContainer.innerHTML = newTable.innerHTML;
                    }
                    window.history.pushState({}, '', url.toString());
                });
            }, 300);
        }

        filterForm?.addEventListener('input', (e) => {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'SELECT') {
                submitAjaxForm();
            }
        });
        filterForm?.addEventListener('submit', (e) => {
            e.preventDefault();
            submitAjaxForm();
        });

        // Kardex
        function verKardex(id) {
            const modalK = document.getElementById('modal-kardex');
            const tbody = document.getElementById('kardex-tbody');
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-slate-500">Cargando movimientos...</td></tr>';
            openModal(modalK);
            
            fetch(`/medicinas/${id}/movimientos`, {
                headers: { 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-8 text-slate-500">No hay movimientos registrados para esta medicina.</td></tr>';
                    return;
                }
                tbody.innerHTML = data.map(m => {
                    const typeValue = m.tipo || m.tipo_movimiento || '';
                    const normalizedType = typeValue.toString().toLowerCase();
                    const isEntrada = normalizedType === 'entrada';
                    const actionText = m.tipo ? (m.tipo === 'entrada' ? 'Entrada' : 'Salida') : (m.tipo_movimiento || '-');
                    const badge = isEntrada ? 'bg-sky-100 text-sky-700' : 'bg-rose-100 text-rose-700';
                    const loteText = m.lote ? `${m.lote.codigo_lote} <br><span class="text-xs text-slate-400">Vence: ${m.lote.fecha_vencimiento || '-'}</span>` : '-';
                    const userName = m.user ? m.user.name : 'Sistema';
                    const fecha = m.fecha_movement || m.fecha || '-';
                    return `
                        <tr class="transition hover:bg-slate-50">
                            <td class="px-4 py-4 text-sm text-slate-700">${fecha}</td>
                            <td class="px-4 py-4 text-sm"><span class="inline-flex px-2 py-1 rounded-full text-xs font-bold ${badge}">${actionText}</span></td>
                            <td class="px-4 py-4 text-sm font-medium text-slate-800">${m.motivo}</td>
                            <td class="px-4 py-4 text-sm font-medium text-slate-600">${userName}</td>
                            <td class="px-4 py-4 text-sm text-right font-bold ${isEntrada ? 'text-sky-700' : 'text-rose-700'}">${isEntrada ? '+' : '-'}${m.cantidad}</td>
                            <td class="px-4 py-4 text-sm text-slate-500">${loteText}</td>
                        </tr>
                    `;
                }).join('');
            });
        }
        document.addEventListener('click', function(event) {
            const button = event.target.closest('button[onclick*="export-menu"]');
            const menu = document.getElementById('export-menu');
            if (!button && menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });
    </script>
@endpush