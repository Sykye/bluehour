@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin</h1>
    <p class="text-gray-500 mt-1">Selamat datang kembali, {{ auth()->user()->name }}!</p>
</div>

{{-- Stats Grid --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    <div class="stat-card">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
        <p class="text-sm text-gray-500 mt-1">Total Pelanggan</p>
    </div>
    <div class="stat-card">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $totalServices }}</p>
        <p class="text-sm text-gray-500 mt-1">Layanan</p>
    </div>
    <div class="stat-card">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-yellow-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
        <p class="text-sm text-gray-500 mt-1">Total Pesanan</p>
    </div>
    <div class="stat-card">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        <p class="text-sm text-gray-500 mt-1">Pendapatan</p>
    </div>
    <div class="stat-card">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $pendingEstimation }}</p>
        <p class="text-sm text-gray-500 mt-1">Estimasi</p>
    </div>
    <div class="stat-card">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-orange-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $pendingPayment }}</p>
        <p class="text-sm text-gray-500 mt-1">Menunggu Bayar</p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-8">
    {{-- Recent Orders --}}
    <div class="card">
        <div class="card-body">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-900">Pesanan Terbaru</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-navy-600 hover:text-navy-800">Lihat Semua →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td>
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-lg bg-navy-100 flex items-center justify-center text-navy-700 text-xs font-bold">
                                        {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $order->user->name }}</span>
                                </div>
                            </td>
                            <td class="text-gray-600">{{ $order->service->name }}</td>
                            <td>
                                <span class="badge {{ $order->status_color }}">{{ $order->status_label }}</span>
                            </td>
                            <td class="text-gray-500 text-xs">{{ $order->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-gray-400 py-8">Belum ada pesanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="card">
        <div class="card-body">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-900">Aktivitas Terbaru</h2>
                <a href="{{ route('admin.activity-log.index') }}" class="text-sm font-medium text-navy-600 hover:text-navy-800">Lihat Semua →</a>
            </div>
            <div class="space-y-3">
                @forelse(\App\Models\ActivityLog::with('user')->latest()->take(5)->get() as $log)
                <div class="flex items-start gap-3 p-3 rounded-xl bg-gray-50">
                    <div class="w-8 h-8 rounded-lg bg-navy-100 flex items-center justify-center text-navy-700 text-xs font-bold flex-shrink-0">
                        {{ $log->user ? strtoupper(substr($log->user->name, 0, 1)) : 'S' }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm text-gray-900">
                            <span class="font-semibold">{{ $log->user?->name ?? 'System' }}</span>
                            <span class="text-gray-500">{{ str_replace('_', ' ', $log->action) }}</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $log->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-400 text-sm text-center py-4">Belum ada aktivitas.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
