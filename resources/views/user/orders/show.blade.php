@extends('layouts.app')
@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('user.orders.index') }}" class="text-sm text-gray-500 hover:text-navy-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Detail Pesanan #{{ $order->id }}</h1>
    </div>

    {{-- Info Pesanan --}}
    <div class="card mb-6">
        <div class="card-body">
            <dl class="grid grid-cols-2 gap-6 text-sm">
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Layanan</dt>
                    <dd class="font-semibold text-gray-900 mt-1">{{ $order->service->name }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Total Harga</dt>
                    <dd class="font-bold text-navy-700 mt-1">Rp {{ number_format($order->total_price, 0, ',', '.') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Status Pesanan</dt>
                    <dd class="mt-1"><span class="badge {{ $order->status_color }}">{{ $order->status_label }}</span></dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Status Pembayaran</dt>
                    <dd class="mt-1"><span class="badge {{ $order->payment_status_color }}">{{ $order->payment_status_label }}</span></dd>
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
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Tanggal Pesan</dt>
                    <dd class="font-medium text-gray-700 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Catatan</dt>
                    <dd class="font-medium text-gray-700 mt-1">{{ $order->notes ?? '-' }}</dd>
                </div>
                @if($order->admin_notes)
                <div class="col-span-2">
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Catatan Admin</dt>
                    <dd class="font-medium text-gray-700 mt-1">{{ $order->admin_notes }}</dd>
                </div>
                @endif
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
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 text-sm">
                    @if($order->lingkar_dada)<div><span class="text-gray-400">Lingkar Dada:</span> <span class="font-medium">{{ $order->lingkar_dada }} cm</span></div>@endif
                    @if($order->lingkar_pinggang)<div><span class="text-gray-400">Lingkar Pinggang:</span> <span class="font-medium">{{ $order->lingkar_pinggang }} cm</span></div>@endif
                    @if($order->lingkar_pinggul)<div><span class="text-gray-400">Lingkar Pinggul:</span> <span class="font-medium">{{ $order->lingkar_pinggul }} cm</span></div>@endif
                    @if($order->lebar_bahu)<div><span class="text-gray-400">Lebar Bahu:</span> <span class="font-medium">{{ $order->lebar_bahu }} cm</span></div>@endif
                    @if($order->panjang_lengan)<div><span class="text-gray-400">Panjang Lengan:</span> <span class="font-medium">{{ $order->panjang_lengan }} cm</span></div>@endif
                    @if($order->panjang_baju)<div><span class="text-gray-400">Panjang Baju:</span> <span class="font-medium">{{ $order->panjang_baju }} cm</span></div>@endif
                    @if($order->sumber_bahan)<div class="col-span-full"><span class="text-gray-400">Sumber Bahan:</span> <span class="font-medium">{{ $order->sumber_bahan === 'pelanggan' ? 'Dari Pelanggan' : 'Dari Penjahit' }}</span></div>@endif
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Upload Bukti Pembayaran --}}
    @if($order->canUploadPayment())
    <div class="card mb-6">
        <div class="card-body">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Upload Bukti Pembayaran</h2>
            <form method="POST" action="{{ route('user.orders.upload-payment', $order) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <input type="file" name="payment_proof" accept="image/*" id="pay-img" class="absolute inset-0 opacity-0 cursor-pointer" onchange="document.getElementById('pay-label').textContent=this.files[0]?.name||'Pilih file'" required>
                            <button type="button" class="btn-secondary text-sm" onclick="document.getElementById('pay-img').click()">Pilih File</button>
                        </div>
                        <span id="pay-label" class="text-sm text-gray-400">Belum ada file dipilih</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Maks 3MB.</p>
                    @error('payment_proof')<p class="form-error-msg">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-success">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                    Upload Bukti Pembayaran
                </button>
            </form>
        </div>
    </div>
    @endif

    {{-- Bukti yang sudah diupload --}}
    @if($order->payment_proof)
    <div class="card mb-6">
        <div class="card-body">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Bukti Pembayaran</h2>
            <img src="{{ Storage::url($order->payment_proof) }}" class="w-48 h-48 object-cover rounded-xl border">
        </div>
    </div>
    @endif

    {{-- Batalkan Pesanan --}}
    @if($order->canBeCancelled())
    <div class="card border border-red-100">
        <div class="card-body">
            <h2 class="text-lg font-bold text-red-600 mb-2">Batalkan Pesanan</h2>
            <p class="text-sm text-gray-500 mb-4">Pembatalan hanya dapat dilakukan sebelum pesanan diproses.</p>
            <form method="POST" action="{{ route('user.orders.destroy', $order) }}" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Batalkan Pesanan
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
