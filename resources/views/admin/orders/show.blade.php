@extends('layouts.app')
@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-navy-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Detail Pesanan #{{ $order->id }}</h1>
    </div>

    {{-- Order Info --}}
    <div class="card mb-6">
        <div class="card-body">
            <dl class="grid grid-cols-2 gap-6 text-sm">
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Pelanggan</dt>
                    <dd class="font-semibold text-gray-900 mt-1">{{ $order->user->name }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Email</dt>
                    <dd class="font-medium text-gray-700 mt-1">{{ $order->user->email }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Layanan</dt>
                    <dd class="font-semibold text-gray-900 mt-1">{{ $order->service->name }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Total Harga</dt>
                    <dd class="font-bold text-navy-700 mt-1">Rp {{ number_format($order->total_price, 0, ',', '.') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Estimasi Harga</dt>
                    <dd class="font-medium mt-1">
                        @if($order->estimated_price)
                            Rp {{ number_format($order->estimated_price, 0, ',', '.') }}
                        @else
                            <span class="text-gray-400">Belum ada estimasi</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Status Pesanan</dt>
                    <dd class="mt-1"><span class="badge {{ $order->status_color }}">{{ $order->status_label }}</span></dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Status Pembayaran</dt>
                    <dd class="mt-1"><span class="badge {{ $order->payment_status_color }}">{{ $order->payment_status_label }}</span></dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Catatan</dt>
                    <dd class="font-medium text-gray-700 mt-1">{{ $order->notes ?? '-' }}</dd>
                </div>
            </dl>

            @if($order->reference_image || $order->design_image)
            <div class="grid grid-cols-2 gap-4 mt-6 pt-4 border-t border-gray-100">
                @if($order->reference_image)
                <div>
                    <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 mb-2">Gambar Referensi</p>
                    <img src="{{ Storage::url($order->reference_image) }}" class="w-full h-40 object-cover rounded-xl border">
                </div>
                @endif
                @if($order->design_image)
                <div>
                    <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 mb-2">Gambar Desain</p>
                    <img src="{{ Storage::url($order->design_image) }}" class="w-full h-40 object-cover rounded-xl border">
                </div>
                @endif
            </div>
            @endif

            @if($order->lingkar_dada || $order->lingkar_pinggang || $order->lebar_bahu)
            <div class="mt-6 pt-4 border-t border-gray-100">
                <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 mb-3">Ukuran Badan</p>
                <div class="grid grid-cols-3 gap-2 text-sm">
                    @if($order->lingkar_dada)<div><span class="text-gray-400">Lingkar Dada:</span> <span class="font-medium">{{ $order->lingkar_dada }} cm</span></div>@endif
                    @if($order->lingkar_pinggang)<div><span class="text-gray-400">Lingkar Pinggang:</span> <span class="font-medium">{{ $order->lingkar_pinggang }} cm</span></div>@endif
                    @if($order->lingkar_pinggul)<div><span class="text-gray-400">Lingkar Pinggul:</span> <span class="font-medium">{{ $order->lingkar_pinggul }} cm</span></div>@endif
                    @if($order->lebar_bahu)<div><span class="text-gray-400">Lebar Bahu:</span> <span class="font-medium">{{ $order->lebar_bahu }} cm</span></div>@endif
                    @if($order->panjang_lengan)<div><span class="text-gray-400">Panjang Lengan:</span> <span class="font-medium">{{ $order->panjang_lengan }} cm</span></div>@endif
                    @if($order->panjang_baju)<div><span class="text-gray-400">Panjang Baju:</span> <span class="font-medium">{{ $order->panjang_baju }} cm</span></div>@endif
                    @if($order->sumber_bahan)<div><span class="text-gray-400">Sumber Bahan:</span> <span class="font-medium">{{ $order->sumber_bahan === 'pelanggan' ? 'Dari Pelanggan' : 'Dari Penjahit' }}</span></div>@endif
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Payment Verification --}}
    @if($order->payment_proof)
    <div class="card mb-6">
        <div class="card-body">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Verifikasi Pembayaran</h2>
            <div class="mb-4">
                <p class="text-xs uppercase tracking-wider font-semibold text-gray-500 mb-2">Bukti Pembayaran</p>
                <img src="{{ Storage::url($order->payment_proof) }}" class="w-48 h-48 object-cover rounded-xl border">
            </div>
            @if($order->payment_status === \App\Models\Order::PAYMENT_MENUNGGU)
            <div class="flex gap-3">
                <form method="POST" action="{{ route('admin.orders.verify-payment', $order) }}">
                    @csrf
                    <input type="hidden" name="action" value="approve">
                    <button type="submit" class="btn-success">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Setujui Pembayaran
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.orders.verify-payment', $order) }}">
                    @csrf
                    <input type="hidden" name="action" value="reject">
                    <button type="submit" class="btn-danger">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Tolak Pembayaran
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Update Status --}}
    <div class="card">
        <div class="card-body">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Update Status Pesanan</h2>
            <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                @csrf @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="form-label">Status</label>
                        <select name="status" class="form-input">
                            @foreach(\App\Models\Order::allStatuses() as $s)
                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                                    {{ \App\Models\Order::statusLabel($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Estimasi Harga (Rp)</label>
                        <input type="number" name="estimated_price"
                               value="{{ old('estimated_price', $order->estimated_price) }}"
                               min="0" step="1000" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Catatan Admin</label>
                        <textarea name="admin_notes" rows="2" class="form-input">{{ old('admin_notes', $order->admin_notes) }}</textarea>
                    </div>
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182"/></svg>
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
