@extends('layouts.auth')

@section('title', 'Verifica tu correo - Medu')

@section('content')
    <div class="mb-8">
        <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.28em] text-emerald-700">Verificación de correo</span>
        <h1 class="mt-5 text-4xl font-extrabold tracking-tight text-slate-950">Confirma tu dirección de email</h1>
        <p class="mt-3 text-sm leading-6 text-slate-500">Antes de acceder al panel, revisa tu bandeja y haz clic en el enlace de verificación que te hemos enviado.</p>
    </div>

    @if(session('status') === 'verification-link-sent')
        <div class="mb-5 rounded-[1.75rem] border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700 shadow-sm shadow-emerald-100">
            Hemos reenviado el enlace de verificación a tu correo electrónico.
        </div>
    @endif

    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-xl shadow-slate-200/50">
        <p class="text-sm text-slate-600">Si no recibiste el correo, pulsa el botón para reenviarlo. Deberías recibirlo en unos segundos.</p>

        <form method="POST" action="{{ route('verification.send') }}" class="mt-6">
            @csrf
            <button type="submit" class="w-full rounded-full bg-emerald-600 px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700">Reenviar enlace de verificación</button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="w-full rounded-full bg-slate-900 px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-slate-900/15 transition hover:bg-slate-800">Cerrar sesión</button>
        </form>
    </div>
@endsection
