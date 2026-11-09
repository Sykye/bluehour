@extends('layouts.guest')
@section('title', 'Verifikasi Email')

@section('content')
<div class="text-center mb-6">
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-sm mb-4">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
    </div>
    <h1 class="text-3xl font-bold text-white">BlueHour</h1>
    <p class="text-white/60 mt-2">Sistem Pemesanan Jasa Jahit Online</p>
</div>

<div class="bg-white rounded-2xl shadow-2xl p-8">
    <h2 class="text-xl font-bold text-gray-900 mb-1">Verifikasi Email</h2>
    <p class="text-sm text-gray-500 mb-6">Terima kasih telah mendaftar! Sebelum memulai, verifikasi email Anda dengan mengklik tautan yang kami kirimkan.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium">
            Tautan verifikasi baru telah dikirim ke email Anda.
        </div>
    @endif

    <div class="flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full py-3 rounded-xl font-bold text-white shadow-lg hover:shadow-xl transition-all duration-200" style="background: linear-gradient(135deg, #1e3a5f, #2d5a87);">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-3 rounded-xl font-medium text-gray-600 border border-gray-200 hover:bg-gray-50 transition-all duration-200">
                Keluar
            </button>
        </form>
    </div>
</div>
@endsection