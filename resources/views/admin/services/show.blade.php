@extends('layouts.app')
@section('title', 'Detail Layanan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.services.index') }}" class="text-sm text-gray-500 hover:text-navy-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Detail Layanan</h1>
    </div>

    <div class="card">
        <div class="card-body">
            @if($service->image)
                <img src="{{ Storage::url($service->image) }}" class="w-full h-56 object-cover rounded-xl mb-6">
            @endif

            <dl class="grid grid-cols-2 gap-6 text-sm">
                <div class="col-span-2">
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Nama Layanan</dt>
                    <dd class="font-bold text-xl text-gray-900 mt-1">{{ $service->name }}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Deskripsi</dt>
                    <dd class="text-gray-700 mt-1">{{ $service->description ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Harga</dt>
                    <dd class="text-xl font-bold text-navy-700 mt-1">Rp {{ number_format($service->price, 0, ',', '.') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Status</dt>
                    <dd class="mt-1">
                        <span class="badge {{ $service->is_active ? 'badge-green' : 'badge-gray' }}">
                            {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Dibuat</dt>
                    <dd class="font-medium text-gray-700 mt-1">{{ $service->created_at->format('d M Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wider font-semibold">Diupdate</dt>
                    <dd class="font-medium text-gray-700 mt-1">{{ $service->updated_at->format('d M Y H:i') }}</dd>
                </div>
            </dl>

            <div class="flex gap-3 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.services.edit', $service) }}" class="btn-primary">Edit Layanan</a>
                <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                      onsubmit="return confirm('Hapus layanan ini?')">
                    @csrf @method('DELETE')
                    <button class="btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
