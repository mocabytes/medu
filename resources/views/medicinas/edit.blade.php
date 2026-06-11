@extends('layouts.dashboard')

@section('title', 'Editar medicina - Medu')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="mb-6 flex items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-emerald-700">Inventario</p>
                <h1 class="mt-2 text-3xl font-bold text-slate-900">Editar medicina</h1>
                <p class="mt-2 text-sm text-slate-500">Ajusta los datos del producto y vuelve al panel con un estilo más limpio.</p>
            </div>
            <a href="{{ route('medicinas.index') }}" class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-800">
                Volver
            </a>
        </div>

        <div class="rounded-4xl border border-white/70 bg-white/85 p-6 shadow-xl shadow-slate-200/50 backdrop-blur sm:p-8">
                        {{-- Mostrar errores de validación --}}
                        @if($errors->any())
                            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                                <ul class="list-disc pl-5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- Mostrar error de autorización --}}
                        @if(session('error'))
                            <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                                {{ session('error') }}
                            </div>
                        @endif
            <form action="{{ route('medicinas.update', $medicina->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Nombre comercial</span>
                        <input type="text" name="nombre_comercial" value="{{ old('nombre_comercial', $medicina->nombre_comercial) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Principio activo</span>
                        <input type="text" name="principio_activo" value="{{ old('principio_activo', $medicina->principio_activo) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Presentación</span>
                        <input type="text" name="presentacion" value="{{ old('presentacion', $medicina->presentacion) }}" placeholder="Ej. Caja con 20 tabletas" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Concentración</span>
                        <input type="text" name="concentracion" value="{{ old('concentracion', $medicina->concentracion) }}" placeholder="Ej. 500mg" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>
                    
                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Laboratorio</span>
                        <input type="text" name="laboratorio" value="{{ old('laboratorio', $medicina->laboratorio) }}" placeholder="Ej. Bayer" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Código de Barras</span>
                        <input type="text" name="codigo_barras" value="{{ old('codigo_barras', $medicina->codigo_barras) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Ubicación física</span>
                        <input type="text" name="ubicacion" value="{{ old('ubicacion', $medicina->ubicacion) }}" placeholder="Ej. Estante A" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Categoría</span>
                        <select name="categoria_id" id="categoria_select" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" @selected((string) old('categoria_id', $medicina->categoria_id) === (string) $categoria->id)>{{ $categoria->nombre }}</option>
                            @endforeach
                            <option value="nueva">+ Crear nueva categoría</option>
                        </select>
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Proveedor</span>
                        <select name="proveedor_id" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                            <option value="">Selecciona un proveedor</option>
                            @foreach($proveedores ?? [] as $proveedor)
                                <option value="{{ $proveedor->id }}" @selected((string) old('proveedor_id', $medicina->proveedor_id) === (string) $proveedor->id)>{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block" id="nueva_categoria_container" style="display: none;">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Nueva categoría</span>
                        <input type="text" name="nueva_categoria" id="nueva_categoria" value="{{ old('nueva_categoria') }}" placeholder="Nombre de la nueva categoría" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Precio de compra ($)</span>
                        <input type="number" step="0.01" min="0" name="precio_compra" value="{{ old('precio_compra', $medicina->precio_compra) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Precio de venta ($)</span>
                        <input type="number" step="0.01" min="0" name="precio_venta" value="{{ old('precio_venta', $medicina->precio_venta) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Stock actual</span>
                        <input type="number" min="0" name="stock_actual" value="{{ old('stock_actual', $medicina->stock_actual) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-semibold text-slate-700">Stock Mínimo (Alerta)</span>
                        <input type="number" min="0" name="stock_minimo" value="{{ old('stock_minimo', $medicina->stock_minimo ?? 10) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                    </label>

                    <label class="block md:col-span-2 items-center gap-3">
                        <input type="checkbox" name="requiere_receta" value="1" @checked(old('requiere_receta', $medicina->requiere_receta)) class="h-5 w-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span class="text-sm font-semibold text-slate-700">Requiere receta médica para su venta</span>
                    </label>
                </div>

                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('medicinas.index') }}" class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Cancelar</a>
                    <button type="submit" class="rounded-full bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700">Actualizar medicina</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
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
    </script>
@endpush