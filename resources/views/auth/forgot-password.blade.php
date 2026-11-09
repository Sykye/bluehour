@extends('layouts.guest')
@section('title', 'Lupa Password')

@section('content')
<div class="text-center mb-6">
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm mb-4">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
    </div>
    <h1 class="text-3xl font-bold text-white">BlueHour</h1>
    <p class="text-white/60 mt-2">Sistem Pemesanan Jasa Jahit Online</p>
</div>

<div class="bg-white rounded-2xl shadow-2xl p-8">
    <h2 class="text-xl font-bold text-gray-900 mb-1">Lupa Password</h2>
    <p class="text-sm text-gray-500 mb-6">Masukkan email Anda, kami akan kirim tautan reset password.</p>

    @if (session('status'))
        <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="form-input @error('email') form-error @enderror"
                   placeholder="nama@email.com">
            @error('email')<p class="form-error-msg">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="w-full py-3 rounded-xl font-bold text-white shadow-lg hover:shadow-xl transition-all duration-200" style="background: linear-gradient(135deg, #1e3a5f, #2d5a87);">
            Kirim Tautan Reset
        </button>

        <p class="text-center text-sm text-gray-500 mt-6">
            <a href="{{ route('login') }}" class="text-navy-600 hover:text-navy-800 font-semibold">Kembali ke Login</a>
        </p>
    </form>
</div>
@endsection