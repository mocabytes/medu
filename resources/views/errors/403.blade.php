@extends('layouts.dashboard')

@section('title', '403 - No autorizado')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="rounded-4xl border border-rose-200 bg-rose-50 p-8 text-rose-900 shadow-xl shadow-rose-100">
            <div class="mb-6">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-rose-700">Acceso denegado</p>
                <h1 class="mt-3 text-4xl font-bold">No tienes permisos para ver esta página</h1>
                <p class="mt-4 text-sm text-rose-800">La acción que intentaste realizar requiere permisos de administrador. Si crees que debería tener acceso, contacta al responsable del sistema.</p>
            </div>
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('medicinas.index') }}" class="inline-flex items-center justify-center rounded-full bg-white px-5 py-3 text-sm font-semibold text-rose-700 shadow-sm shadow-rose-200 transition hover:bg-rose-100">Volver al inventario</a>
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('users.index') }}" class="inline-flex items-center justify-center rounded-full bg-rose-700 px-5 py-3 text-sm font-semibold text-white shadow-sm shadow-rose-900/20 transition hover:bg-rose-800">Ir a administración</a>
                @endif
            </div>
        </div>
    </div>
@endsection
