@extends('layouts.auth')

@section('title', 'Iniciar sesión - Medu')

@section('content')
    <div class="mb-8 text-center">
        <img src="{{ asset('images/logo.svg') }}" alt="Medu Logo" class="mx-auto h-16 w-16 mb-4">
        <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.28em] text-emerald-700">Acceso seguro</span>
        <h1 class="mt-5 text-4xl font-extrabold tracking-tight text-slate-950">Iniciar sesión</h1>
        <p class="mt-3 text-sm leading-6 text-slate-500">Usa tus credenciales para entrar al panel de inventario.</p>
    </div>

    @if($errors->any())
        <div class="mb-5 rounded-[1.75rem] border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700 shadow-sm shadow-rose-100">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf
        <label class="block">
            <span class="mb-2 block text-sm font-semibold text-slate-600">Correo electrónico</span>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-full border border-slate-200 bg-slate-50 px-6 py-4 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
        </label>

        <label class="block">
            <span class="mb-2 block text-sm font-semibold text-slate-600">Contraseña</span>
            <div class="relative">
                <input type="password" name="password" id="password" required class="w-full rounded-full border border-slate-200 bg-slate-50 px-6 pr-12 py-4 text-sm text-slate-900 shadow-sm outline-none transition focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100">
                <button type="button" onclick="togglePassword()" class="absolute py-4 right-4 top-1/4 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                    <svg id="eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="eye-off-icon" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.059 10.059 0 013.999-5.42m3.876-1.732A10.05 10.05 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.06 10.06 0 01-3.999 5.42m-6.168-6.168l-3.75 3.75m15.75-3.75l-3.75 3.75" />
                    </svg>
                </button>
            </div>
        </label>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                <span class="text-sm text-slate-600">Recordarme</span>
            </label>
        </div>

        <button type="submit" class="w-full rounded-full bg-emerald-600 px-6 py-2 text-sm font-bold text-white shadow-lg shadow-emerald-200 transition hover:translate-y-px hover:bg-emerald-700">
            Entrar al sistema
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-slate-500">
            ¿No tienes una cuenta?
            <a href="{{ route('register.form') }}" class="font-semibold text-emerald-700 hover:text-emerald-800 transition">Crear usuario</a>
        </p>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }
    </script>
@endsection