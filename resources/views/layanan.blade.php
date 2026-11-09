{{-- Layout ini menggunakan file sendiri (tidak extends layout lain) karena halaman publik --}}
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="BlueHour — Layanan Jasa Jahit Profesional">
    <title>Layanan — BlueHour</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-navy-700 to-navy-800 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/>
                        </svg>
                    </div>
                    <span class="text-navy-900 font-bold text-lg">BlueHour</span>
                </a>
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-secondary text-sm">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary text-sm">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Header --}}
    <div class="gradient-hero py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Layanan Kami</h1>
            <p class="text-white/70 text-lg max-w-2xl mx-auto">
                Pilih layanan jahit sesuai kebutuhan Anda. Kami siap mewujudkan pakaian impian Anda dengan kualitas premium.
            </p>
        </div>
    </div>

    {{-- Services Grid --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
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
                        @auth
                            @if(auth()->user()->isUser())
                            <a href="{{ route('user.orders.create') }}" class="text-sm font-semibold text-navy-600 hover:text-navy-800">Pesan →</a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="text-sm font-semibold text-navy-600 hover:text-navy-800">Pesan →</a>
                        @endauth
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-400 text-lg">Belum ada layanan tersedia.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $services->links() }}
        </div>
    </div>
</body>
</html>
