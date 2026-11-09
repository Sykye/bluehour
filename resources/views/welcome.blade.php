<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="BlueHour — Sistem Pemesanan Jasa Jahit Online Profesional. Jahit baju impian Anda dengan kualitas terbaik.">
    <title>BlueHour — Jasa Jahit Profesional</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="font-sans antialiased text-gray-900" x-data="{ mobileMenu: false, faqOpen: null }">

    {{-- ─── NAVBAR ─── --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="#" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-navy-700 to-navy-800 flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/>
                        </svg>
                    </div>
                    <span class="text-navy-900 font-bold text-xl tracking-tight">BlueHour</span>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="#beranda" class="text-sm font-medium text-gray-600 hover:text-navy-700 transition-colors">Beranda</a>
                    <a href="#tentang" class="text-sm font-medium text-gray-600 hover:text-navy-700 transition-colors">Tentang</a>
                    <a href="#layanan" class="text-sm font-medium text-gray-600 hover:text-navy-700 transition-colors">Layanan</a>
                    <a href="#keunggulan" class="text-sm font-medium text-gray-600 hover:text-navy-700 transition-colors">Keunggulan</a>
                    <a href="#testimoni" class="text-sm font-medium text-gray-600 hover:text-navy-700 transition-colors">Testimoni</a>
                    <a href="#faq" class="text-sm font-medium text-gray-600 hover:text-navy-700 transition-colors">FAQ</a>
                </div>

                {{-- Right --}}
                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-primary text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6z"/></svg>
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-secondary text-sm">Masuk</a>
                            <a href="{{ route('register') }}" class="btn-primary text-sm">Daftar</a>
                        @endauth
                    @endif

                    {{-- Mobile Toggle --}}
                    <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 rounded-xl text-gray-600 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="mobileMenu" x-cloak x-transition class="md:hidden border-t border-gray-100 py-4 pb-6">
                <div class="flex flex-col gap-2">
                    <a href="#beranda" @click="mobileMenu = false" class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">Beranda</a>
                    <a href="#tentang" @click="mobileMenu = false" class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">Tentang</a>
                    <a href="#layanan" @click="mobileMenu = false" class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">Layanan</a>
                    <a href="#keunggulan" @click="mobileMenu = false" class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">Keunggulan</a>
                    <a href="#testimoni" @click="mobileMenu = false" class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">Testimoni</a>
                    <a href="#faq" @click="mobileMenu = false" class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">FAQ</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- ─── HERO ─── --}}
    <section id="beranda" class="relative min-h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 gradient-hero opacity-95"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMiIvPjwvZz48L2c+PC9zdmc+')] opacity-30"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 backdrop-blur-sm rounded-full text-white/80 text-sm font-medium mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456z"/></svg>
                Premium Tailor Service
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold text-white leading-tight mb-6">
                Wujudkan <span class="text-transparent bg-clip-text bg-gradient-to-r from-royal-300 to-royal-400">Pakaian Impian</span><br>
                Anda Sekarang
            </h1>
            <p class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto mb-10 leading-relaxed">
                Nikmati pengalaman menjahit premium dengan sistem pemesanan online. 
                Dari konsultasi hingga jadi, kami pastikan setiap jahitan sempurna.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-navy-900 font-semibold rounded-xl hover:bg-gray-100 transition-all duration-200 shadow-xl hover:shadow-2xl text-base">
                    Mulai Pesan Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
                <a href="#layanan" class="inline-flex items-center gap-2 px-8 py-3.5 border border-white/30 text-white font-medium rounded-xl hover:bg-white/10 transition-all duration-200 text-base">
                    Lihat Layanan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ─── TENTANG KAMI ─── --}}
    <section id="tentang" class="py-20 lg:py-28 bg-gradient-premium">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-navy-600 font-semibold text-sm tracking-wide uppercase">Tentang Kami</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mt-3 mb-6">
                        Lebih dari Sekadar <span class="text-gradient">Jasa Jahit</span>
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        BlueHour hadir sebagai solusi jahit online modern yang menghubungkan Anda dengan 
                        penjahit profesional. Kami percaya bahwa setiap orang berhak mendapatkan pakaian 
                        yang sempurna — baik dari segi desain, ukuran, maupun kualitas.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        Dengan sistem pemesanan online yang transparan, Anda bisa memantau progress 
                        jahitan dari awal hingga akhir. Tidak perlu lagi khawatir soal estimasi harga, 
                        waktu pengerjaan, atau kualitas hasil.
                    </p>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-navy-700">500+</p>
                            <p class="text-sm text-gray-500">Pelanggan</p>
                        </div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-navy-700">1000+</p>
                            <p class="text-sm text-gray-500">Pesanan</p>
                        </div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-navy-700">98%</p>
                            <p class="text-sm text-gray-500">Puas</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-square rounded-2xl bg-gradient-to-br from-navy-100 to-royal-50 p-8 flex items-center justify-center">
                        <svg class="w-64 h-64 text-navy-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/>
                        </svg>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-navy-700 rounded-2xl -z-10"></div>
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-royal-200 rounded-2xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── CARA KERJA ─── --}}
    <section class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-navy-600 font-semibold text-sm tracking-wide uppercase">Cara Kerja</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mt-3 mb-4">
                    Mudah, Cepat, dan <span class="text-gradient">Terpercaya</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Hanya dalam 3 langkah mudah, pesanan jahitan Anda akan segera diproses oleh penjahit profesional kami.
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
                <div class="text-center group">
                    <div class="w-16 h-16 bg-navy-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-navy-200 transition-colors">
                        <svg class="w-8 h-8 text-navy-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">1. Buat Pesanan</h3>
                    <p class="text-gray-600 leading-relaxed">Pilih layanan, upload referensi desain, tentukan ukuran, dan sampaikan catatan Anda melalui form pemesanan online.</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-royal-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-royal-200 transition-colors">
                        <svg class="w-8 h-8 text-royal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">2. Dapatkan Estimasi</h3>
                    <p class="text-gray-600 leading-relaxed">Admin akan memberikan estimasi harga berdasarkan layanan, bahan, dan detail pesanan Anda dalam waktu singkat.</p>
                </div>
                <div class="text-center group">
                    <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-emerald-200 transition-colors">
                        <svg class="w-8 h-8 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">3. Konfirmasi & Selesai</h3>
                    <p class="text-gray-600 leading-relaxed">Setelah harga disetujui, lakukan pembayaran dan tunggu hasil jahitan berkualitas tinggi sampai di tangan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── LAYANAN ─── --}}
    <section id="layanan" class="py-20 lg:py-28 bg-gradient-premium">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-navy-600 font-semibold text-sm tracking-wide uppercase">Layanan Kami</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mt-3 mb-4">
                    Pilihan <span class="text-gradient">Layanan Premium</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Berbagai layanan jahit siap mewujudkan pakaian impian Anda dengan kualitas terbaik.
                </p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    @if($service->image)
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ Storage::url($service->image) }}"
                             alt="{{ $service->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    @else
                    <div class="aspect-[4/3] bg-gradient-to-br from-navy-50 to-royal-50 flex items-center justify-center">
                        <svg class="w-20 h-20 text-navy-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/>
                        </svg>
                    </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-4">{{ $service->description ?? 'Tidak ada deskripsi.' }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-navy-700">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            <a href="{{ route('register') }}" class="text-sm font-semibold text-navy-600 hover:text-navy-800 transition-colors">
                                Pesan →
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-400 text-lg">Belum ada layanan tersedia.</p>
                </div>
                @endforelse
            </div>
            @if(count($services) > 0)
            <div class="text-center mt-12">
                <a href="{{ route('layanan') }}" class="btn-secondary">
                    Lihat Semua Layanan
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
            @endif
        </div>
    </section>

    {{-- ─── KEUNGGULAN ─── --}}
    <section id="keunggulan" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-navy-600 font-semibold text-sm tracking-wide uppercase">Keunggulan</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mt-3 mb-4">
                    Kenapa Memilih <span class="text-gradient">BlueHour</span>?
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Kami berkomitmen memberikan pengalaman menjahit terbaik untuk setiap pelanggan.
                </p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-6 rounded-2xl bg-gray-50 hover:bg-navy-50 transition-colors duration-300">
                    <div class="w-14 h-14 bg-navy-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-navy-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Penjahit Profesional</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Ditangani oleh penjahit berpengalaman dengan skill dan ketelitian tinggi.</p>
                </div>
                <div class="text-center p-6 rounded-2xl bg-gray-50 hover:bg-navy-50 transition-colors duration-300">
                    <div class="w-14 h-14 bg-royal-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-royal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Garansi Kualitas</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Kami berikan garansi untuk setiap hasil jahitan. Jika tidak sesuai, kami perbaiki gratis.</p>
                </div>
                <div class="text-center p-6 rounded-2xl bg-gray-50 hover:bg-navy-50 transition-colors duration-300">
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Tepat Waktu</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Komitmen waktu pengerjaan yang jelas. Kami hargai waktu Anda.</p>
                </div>
                <div class="text-center p-6 rounded-2xl bg-gray-50 hover:bg-navy-50 transition-colors duration-300">
                    <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Harga Transparan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Tidak ada biaya tersembunyi. Harga jelas dari awal hingga akhir.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── TESTIMONI ─── --}}
    <section id="testimoni" class="py-20 lg:py-28 bg-gradient-premium">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-navy-600 font-semibold text-sm tracking-wide uppercase">Testimoni</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mt-3 mb-4">
                    Apa Kata <span class="text-gradient">Pelanggan</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Kepercayaan dan kepuasan Anda adalah prioritas utama kami.
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-1 mb-4">
                        @for($i=0;$i<5;$i++)
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">"Hasil jahitannya rapi banget! Sesuai dengan referensi yang saya kasih. Adminnya juga responsif. Highly recommended!"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-navy-100 flex items-center justify-center text-navy-700 font-bold">SA</div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Sarah Amanda</p>
                            <p class="text-xs text-gray-400">Pelanggan Setia</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-1 mb-4">
                        @for($i=0;$i<5;$i++)
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">"Sistemnya modern banget! Bisa tracking progress jahitan secara online. Ga perlu bolak-balik tanya ke penjahit."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-royal-100 flex items-center justify-center text-royal-700 font-bold">RD</div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Rizky Dwiputra</p>
                            <p class="text-xs text-gray-400">Pelanggan Baru</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-1 mb-4">
                        @for($i=0;$i<5;$i++)
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">"Kualitas jahitan premium banget! Bahannya juga bagus. Pasti bakal repeat order lagi untuk koleksi baju lainnya."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold">DN</div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Dian Nurhayati</p>
                            <p class="text-xs text-gray-400">Pelanggan Premium</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── FAQ ─── --}}
    <section id="faq" class="py-20 lg:py-28 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-navy-600 font-semibold text-sm tracking-wide uppercase">FAQ</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mt-3 mb-4">
                    Pertanyaan <span class="text-gradient">Umum</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Temukan jawaban atas pertanyaan yang sering diajukan.
                </p>
            </div>
            <div class="space-y-4">
                @php
                    $faqs = [
                        ['q' => 'Bagaimana cara memesan jasa jahit?', 'a' => 'Cukup daftar akun, pilih layanan yang diinginkan, upload referensi desain, isi ukuran, dan kirim pesanan. Admin akan memberikan estimasi harga dalam waktu singkat.'],
                        ['q' => 'Berapa lama waktu pengerjaan?', 'a' => 'Waktu pengerjaan bervariasi tergantung jenis layanan dan tingkat kesulitan. Rata-rata 3-7 hari kerja. Estimasi waktu akan diberikan setelah pesanan dikonfirmasi.'],
                        ['q' => 'Apakah bisa request desain custom?', 'a' => 'Tentu! Anda bisa upload gambar referensi atau desain custom saat pemesanan. Tim kami akan menyesuaikan dengan keinginan Anda.'],
                        ['q' => 'Bagaimana jika ukuran tidak sesuai?', 'a' => 'Kami memberikan garansi kepuasan. Jika hasil jahitan tidak sesuai ukuran, kami akan perbaiki secara gratis.'],
                        ['q' => 'Apa saja metode pembayaran yang tersedia?', 'a' => 'Kami menerima transfer bank (BCA, Mandiri, BRI) dan e-wallet (GoPay, OVO, Dana). Pembayaran dilakukan setelah estimasi harga disetujui.'],
                        ['q' => 'Apakah ada layanan antar jemput?', 'a' => 'Saat ini kami melayani pengiriman via kurir. Untuk area tertentu, tersedia opsi antar jemput langsung.'],
                    ];
                @endphp
                @foreach($faqs as $index => $faq)
                <div class="bg-gray-50 rounded-2xl overflow-hidden border border-gray-100">
                    <button @click="faqOpen = faqOpen === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center justify-between px-6 py-5 text-left">
                        <span class="font-semibold text-gray-900 pr-4">{{ $faq['q'] }}</span>
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform duration-300"
                             :class="faqOpen === {{ $index }} ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>
                    <div x-show="faqOpen === {{ $index }}" x-cloak x-transition>
                        <div class="px-6 pb-5 text-gray-600 text-sm leading-relaxed">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── CTA ─── --}}
    <section class="py-20 lg:py-28 gradient-hero relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMiIvPjwvZz48L2c+PC9zdmc+')] opacity-50"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                Siap Wujudkan Pakaian Impian?
            </h2>
            <p class="text-white/70 text-lg mb-10 max-w-2xl mx-auto">
                Daftar sekarang dan mulailah perjalanan Anda mendapatkan pakaian berkualitas premium yang dirancang khusus untuk Anda.
            </p>
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-navy-900 font-semibold rounded-xl hover:bg-gray-100 transition-all duration-200 shadow-xl hover:shadow-2xl text-base">
                Daftar Gratis Sekarang
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>
    </section>

    {{-- ─── FOOTER ─── --}}
    <footer class="bg-navy-950 text-white/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid md:grid-cols-4 gap-12">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-royal-400 to-navy-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/>
                            </svg>
                        </div>
                        <span class="text-white font-bold text-lg tracking-tight">BlueHour</span>
                    </div>
                    <p class="text-sm leading-relaxed max-w-md">
                        Sistem pemesanan jasa jahit online profesional. Wujudkan pakaian impian Anda dengan kualitas premium dan pelayanan terbaik.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#beranda" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#tentang" class="hover:text-white transition-colors">Tentang</a></li>
                        <li><a href="#layanan" class="hover:text-white transition-colors">Layanan</a></li>
                        <li><a href="#testimoni" class="hover:text-white transition-colors">Testimoni</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                            hello@bluehour.com
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                            +62 812-3456-7890
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            Jakarta, Indonesia
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/10 mt-12 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} BlueHour. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
