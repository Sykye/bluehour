@extends('layouts.app')
@section('title', 'Pesanan Saya')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Pesanan Saya</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola semua pesanan jahit Anda.</p>
    </div>
    <a href="{{ route('user.orders.create') }}" class="btn-primary self-start">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
        Buat Pesanan Baru
    </a>
</div>

<div class="card">
    <div class="overflow-x-auto">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Layanan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="font-mono text-xs text-gray-400">#{{ $order->id }}</td>
                    <td class="font-medium text-gray-900">{{ $order->service->name }}</td>
                    <td class="font-semibold text-navy-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td><span class="badge {{ $order->status_color }}">{{ $order->status_label }}</span></td>
                    <td><span class="badge {{ $order->payment_status_color }}">{{ $order->payment_status_label }}</span></td>
                    <td class="text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('user.orders.show', $order) }}" class="text-navy-600 hover:text-navy-800 text-sm font-medium">Detail</a>
                            @if($order->canBeCancelled())
                            <form method="POST" action="{{ route('user.orders.destroy', $order) }}" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 text-sm font-medium">Batalkan</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-12 text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15a2.25 2.25 0 012.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                    <p class="text-sm">Belum ada pesanan.</p>
                    <a href="{{ route('user.orders.create') }}" class="text-navy-600 underline text-sm font-medium mt-2 inline-block">Pesan sekarang!</a>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($orders, 'links'))
    <div class="px-5 py-4 border-t border-gray-50">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
