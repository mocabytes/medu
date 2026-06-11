@extends('layouts.dashboard')

@section('title', 'Editar proveedor - Medu')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-emerald-700">Proveedor</p>
                <h1 class="mt-3 text-3xl font-bold text-slate-900">Editar proveedor</h1>
                <p class="mt-2 text-sm text-slate-500">Actualiza los datos del proveedor registrado.</p>
            </div>
            <a href="{{ route('proveedores.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Volver a proveedores</a>
        </div>

        <div class="rounded-4xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/50">
            <form action="{{ route('proveedores.update', $proveedor) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <label class="block">
                    <span class="mb-2 block text-sm font-semibold text-slate-700">Nombre</span>
                    <input type="text" name="nombre" value="{{ old('nombre', $proveedor->nombre) }}" required class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-semibold text-slate-700">Correo electrónico</span>
                    <input type="email" name="email" value="{{ old('email', $proveedor->email) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-semibold text-slate-700">Teléfono</span>
                    <input type="text" name="telefono" value="{{ old('telefono', $proveedor->telefono) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-semibold text-slate-700">Dirección</span>
                    <input type="text" name="direccion" value="{{ old('direccion', $proveedor->direccion) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                </label>

                <button type="submit" class="rounded-full bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700">Actualizar proveedor</button>
            </form>
        </div>
    </div>
@endsection
