@extends('layouts.dashboard')

@section('title', 'Proveedores - Medu')

@section('content')
    <div class="flex flex-col gap-4 animate-slide-up">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-emerald-700">Proveedores</p>
                <h1 class="mt-3 text-3xl font-bold text-slate-900">Administración de Proveedores</h1>
                <p class="mt-2 text-sm text-slate-500">Crea, edita y elimina proveedores asociados a tus medicinas.</p>
            </div>
            <a href="{{ route('proveedores.create') }}" class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700 hover:scale-105 hover:shadow-xl hover:shadow-emerald-600/30">+ Nuevo proveedor</a>
        </div>
        <section class="rounded-4xl border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/50 animate-slide-up" style="animation-delay: 0.2s">
            @if(session('success'))
                <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-900 animate-fade-in">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-rose-900 animate-fade-in">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mt-6 overflow-hidden rounded-3x1 border border-slate-200 shadow-sm">
            <div class="overflow-x-auto bg-white">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.2em]">Nombre</th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.2em]">Email</th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.2em]">Teléfono</th>
                            <th class="px-6 py-4 text-left font-semibold uppercase tracking-[0.2em]">Dirección</th>
                            <th class="px-6 py-4 text-center font-semibold uppercase tracking-[0.2em]">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($proveedores as $proveedor)
                            <tr class="hover:bg-slate-50/80 transition animate-fade-in" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                <td class="px-4 py-4 font-medium text-slate-900">{{ $proveedor->nombre }}</td>
                                <td class="px-4 py-4">{{ $proveedor->email ?? '—' }}</td>
                                <td class="px-4 py-4">{{ $proveedor->telefono ?? '—' }}</td>
                                <td class="px-4 py-4">{{ $proveedor->direccion ?? '—' }}</td>
                                <td class="px-4 py-4 text-right">
                                    <div class="inline-flex gap-2">
                                        <a href="{{ route('proveedores.edit', $proveedor) }}" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-50 hover:scale-105 hover:shadow-md">Editar</a>
                                        <form action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" onsubmit="return confirm('¿Eliminar este proveedor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-full bg-rose-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-rose-700 hover:scale-105 hover:shadow-md hover:shake">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-10 text-center text-sm text-slate-500">No hay proveedores registrados aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">{{ $proveedores->links() }}</div>
            </div>
        </section>
    </div>
@endsection
