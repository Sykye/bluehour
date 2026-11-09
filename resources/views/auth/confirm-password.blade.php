@extends('layouts.guest')
@section('title', 'Konfirmasi Password')

@section('content')
<div class="text-center mb-6">
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm mb-4">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
    </div>
    <h1 class="text-3xl font-bold text-white">BlueHour</h1>
    <p class="text-white/60 mt-2">Sistem Pemesanan Jasa Jahit Online</p>
</div>

<div class="bg-white rounded-2xl shadow-2xl p-8">
    <h2 class="text-xl font-bold text-gray-900 mb-1">Konfirmasi Password</h2>
    <p class="text-sm text-gray-500 mb-6">Ini adalah area aman. Harap konfirmasi password Anda sebelum melanjutkan.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-6">
            <label class="form-label">Password</label>
            <input type="password" name="password" required autocomplete="current-password"
                   class="form-input @error('password') form-error @enderror"
                   placeholder="Masukkan password">
            @error('password')<p class="form-error-msg">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="w-full py-3 rounded-xl font-bold text-white shadow-lg hover:shadow-xl transition-all duration-200" style="background: linear-gradient(135deg, #1e3a5f, #2d5a87);">
            Konfirmasi
        </button>
    </form>
</div>
@endsection