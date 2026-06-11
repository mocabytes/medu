@extends('layouts.auth')

@section('title', 'Crear cuenta - Medu')

@section('content')
    <div class="mb-8">
        <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.28em] text-emerald-700">Nuevo acceso</span>
        <h1 class="mt-5 text-4xl font-extrabold tracking-tight text-slate-950">Crear cuenta</h1>
        <p class="mt-3 text-sm leading-6 text-slate-500">Registra un usuario para entrar al panel y administrar el inventario.</p>
    </div>

    @if($errors->any())
        <div class="mb-5 rounded-[1.75rem] border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700 shadow-sm shadow-rose-100">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="space-y-5">
        @csrf
        <label class="block">
            <span class="mb-2 block text-sm font-semibold text-slate-600">Nombre completo</span>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-full border border-slate-200 bg-slate-50 px-6 py-4 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
        </label>

        <label class="block">
            <span class="mb-2 block text-sm font-semibold text-slate-600">Correo electrónico</span>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-full border border-slate-200 bg-slate-50 px-6 py-4 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
        </label>

        <label class="block">
            <span class="mb-2 block text-sm font-semibold text-slate-600">Contraseña</span>
            <input type="password" name="password" required class="w-full rounded-full border border-slate-200 bg-slate-50 px-6 py-4 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
        </label>

        <label class="block">
            <span class="mb-2 block text-sm font-semibold text-slate-600">Confirmar contraseña</span>
            <input type="password" name="password_confirmation" required class="w-full rounded-full border border-slate-200 bg-slate-50 px-6 py-4 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
        </label>

        <button type="submit" class="w-full rounded-full bg-emerald-600 px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700">
            Crear usuario
        </button>
    </form>

    <p class="mt-6 text-sm text-slate-500">
        ¿Ya tienes una cuenta?
        <a href="{{ route('login.form') }}" class="font-semibold text-emerald-700 hover:text-emerald-800">Inicia sesión</a>
    </p>
@endsection