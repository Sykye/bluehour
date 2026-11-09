@extends('layouts.app')
@section('title', 'Kelola Layanan')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Kelola Layanan</h1>
        <p class="text-sm text-gray-500 mt-1">Atur layanan jahit yang tersedia untuk pelanggan.</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
        Tambah Layanan
    </a>
</div>

<div class="card">
    <div class="overflow-x-auto">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Layanan</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            @if($service->image)
                                <img src="{{ Storage::url($service->image) }}" class="w-10 h-10 rounded-lg object-cover">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-navy-100 flex items-center justify-center text-navy-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/></svg>
                                </div>
                            @endif
                            <span class="font-semibold text-gray-900">{{ $service->name }}</span>
                        </div>
                    </td>
                    <td class="font-medium">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $service->is_active ? 'badge-green' : 'badge-gray' }}">
                            {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.services.edit', $service) }}" class="text-sm font-medium text-navy-600 hover:text-navy-800">Edit</a>
                            <span class="text-gray-300">|</span>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                  onsubmit="return confirm('Hapus layanan ini?')">
                                @csrf @method('DELETE')
                                <button class="text-sm font-medium text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-10 text-gray-400">Belum ada layanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($services, 'links'))
    <div class="px-5 py-4 border-t border-gray-50">{{ $services->links() }}</div>
    @endif
</div>
@endsection
