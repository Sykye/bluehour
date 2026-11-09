@extends('layouts.guest')
@section('title', 'Masuk')

@section('content')
<div class="text-center mb-6">
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm mb-4">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/></svg>
    </div>
    <h1 class="text-3xl font-bold text-white">BlueHour</h1>
    <p class="text-white/60 mt-2">Sistem Pemesanan Jasa Jahit Online</p>
</div>

<div class="bg-white rounded-2xl shadow-2xl p-8">
    <h2 class="text-xl font-bold text-gray-900 mb-1">Selamat Datang</h2>
    <p class="text-sm text-gray-500 mb-6">Silakan masuk ke akun Anda.</p>

    @if (session('status'))
        <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="form-input @error('email') form-error @enderror" placeholder="nama@email.com">
            @error('email')<p class="form-error-msg">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" required autocomplete="current-password" class="form-input @error('password') form-error @enderror" placeholder="Masukkan password">
            @error('password')<p class="form-error-msg">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center justify-between mb-6">
            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-navy-600 focus:ring-navy-500">
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-navy-600 hover:text-navy-800 font-medium">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="w-full py-3 rounded-xl font-bold text-white shadow-lg hover:shadow-xl transition-all duration-200" style="background: linear-gradient(135deg, #1e3a5f, #2d5a87);">
            Masuk
        </button>

        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-navy-600 hover:text-navy-800 font-semibold">Daftar</a>
        </p>
    </form>
</div>
@endsection
