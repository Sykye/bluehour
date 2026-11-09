@extends('layouts.app')
@section('title', 'Tambah Layanan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.services.index') }}" class="text-sm text-gray-500 hover:text-navy-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Tambah Layanan Baru</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="form-label">Nama Layanan <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="form-input @error('name') border-red-500 @enderror">
                        @error('name') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" rows="3" class="form-input">{{ old('description') }}</textarea>
                        @error('description') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">Harga (Rp) <span class="text-red-500">*</span></label>
                        <input type="number" name="price" value="{{ old('price') }}" min="0" step="1000"
                               class="form-input @error('price') border-red-500 @enderror">
                        @error('price') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">Gambar Layanan</label>
                        <input type="file" name="image" accept="image/*" class="form-input">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG, WEBP. Maks 2MB.</p>
                        @error('image') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', true) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-300 text-navy-600 focus:ring-navy-500">
                            <span class="text-sm text-gray-700">Layanan aktif (tampil ke pelanggan)</span>
                        </label>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="btn-primary">Simpan Layanan</button>
                        <a href="{{ route('admin.services.index') }}" class="btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
