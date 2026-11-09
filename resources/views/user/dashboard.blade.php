@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Selamat datang, {{ auth()->user()->name }}! 👋</h1>
    <p class="text-gray-500 mt-1">Kelola pesanan jahitan Anda dengan mudah.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="stat-card">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $totalMyOrders }}</p>
        <p class="text-sm text-gray-500 mt-1">Total Pesanan</p>
    </div>
    <div class="stat-card">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $activeServices }}</p>
        <p class="text-sm text-gray-500 mt-1">Layanan Tersedia</p>
    </div>
    <div class="stat-card">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $activeOrders }}</p>
        <p class="text-sm text-gray-500 mt-1">Pesanan Aktif</p>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-8">
    {{-- Recent Orders --}}
    <div class="lg:col-span-2 card">
        <div class="card-body">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-900">Pesanan Terbaru</h2>
                <div class="flex gap-2">
                    <a href="{{ route('user.orders.index') }}" class="btn-secondary text-xs">Riwayat</a>
                    <a href="{{ route('user.orders.create') }}" class="btn-primary text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Buat Pesanan
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Layanan</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myOrders as $order)
                        <tr>
                            <td class="font-medium text-gray-900">{{ $order->service->name }}</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $order->status_color }}">{{ $order->status_label }}</span>
                            </td>
                            <td class="text-gray-500 text-xs">{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('user.orders.show', $order) }}" class="text-navy-600 hover:text-navy-800 text-sm font-medium">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-10 text-gray-400">
                            <p>Belum ada pesanan.</p>
                            <a href="{{ route('user.orders.create') }}" class="text-navy-600 font-medium underline mt-1 inline-block">Pesan sekarang!</a>
                        </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card">
        <div class="card-body">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h2>
            <div class="space-y-3">
                <a href="{{ route('user.orders.create') }}" class="flex items-center gap-4 p-4 rounded-xl bg-navy-50 hover:bg-navy-100 transition-colors group">
                    <div class="w-12 h-12 rounded-xl bg-navy-100 flex items-center justify-center group-hover:bg-navy-200 transition-colors">
                        <svg class="w-6 h-6 text-navy-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Buat Pesanan Baru</p>
                        <p class="text-xs text-gray-500">Pesan jasa jahit sekarang</p>
                    </div>
                </a>
                <a href="{{ route('layanan') }}" class="flex items-center gap-4 p-4 rounded-xl bg-royal-50 hover:bg-royal-100 transition-colors group">
                    <div class="w-12 h-12 rounded-xl bg-royal-100 flex items-center justify-center group-hover:bg-royal-200 transition-colors">
                        <svg class="w-6 h-6 text-royal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Lihat Layanan</p>
                        <p class="text-xs text-gray-500">Jelajahi semua layanan</p>
                    </div>
                </a>
                <a href="{{ route('user.orders.index') }}" class="flex items-center gap-4 p-4 rounded-xl bg-emerald-50 hover:bg-emerald-100 transition-colors group">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                        <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Riwayat Pesanan</p>
                        <p class="text-xs text-gray-500">Cek status pesanan Anda</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
