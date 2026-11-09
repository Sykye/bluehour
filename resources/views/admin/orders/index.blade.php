@extends('layouts.app')
@section('title', 'Semua Pesanan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Semua Pesanan</h1>
    <p class="text-sm text-gray-500 mt-1">Kelola dan pantau semua pesanan pelanggan.</p>
</div>

<div class="card">
    <div class="overflow-x-auto">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pelanggan</th>
                    <th>Layanan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="font-mono text-gray-400">#{{ $order->id }}</td>
                    <td>
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-navy-100 flex items-center justify-center text-navy-700 text-xs font-bold">
                                {{ strtoupper(substr($order->user->name, 0, 1)) }}
                            </div>
                            <span class="font-medium text-gray-900">{{ $order->user->name }}</span>
                        </div>
                    </td>
                    <td class="text-gray-600">{{ $order->service->name }}</td>
                    <td class="font-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $order->status_color }}">{{ $order->status_label }}</span>
                    </td>
                    <td class="text-gray-500 text-xs">{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-sm font-medium text-navy-600 hover:text-navy-800">Detail</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-10 text-gray-400">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($orders, 'links'))
    <div class="px-5 py-4 border-t border-gray-50">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
