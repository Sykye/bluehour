@extends('layouts.app')
@section('title', 'Buat Pesanan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('user.orders.index') }}" class="text-sm text-gray-500 hover:text-navy-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Buat Pesanan Baru</h1>
        <p class="text-sm text-gray-500 mt-1">Lengkapi detail pesanan jahit Anda.</p>
    </div>

    <form method="POST" action="{{ route('user.orders.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            {{-- Pilih Layanan --}}
            <div class="card">
                <div class="card-body">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">1. Pilih Layanan</h2>
                    <div>
                        <label class="form-label">Layanan <span class="text-red-500">*</span></label>
                        <select name="service_id" class="form-input @error('service_id') form-error @enderror">
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }} — Rp {{ number_format($service->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Detail & Gambar --}}
            <div class="card">
                <div class="card-body">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">2. Detail Pesanan</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="form-label">Catatan / Keterangan</label>
                            <textarea name="notes" rows="3" class="form-input @error('notes') form-error @enderror" placeholder="Contoh: ukuran baju, warna yang diinginkan, dll.">{{ old('notes') }}</textarea>
                            @error('notes')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="form-label">Gambar Referensi (opsional)</label>
                            <div class="mt-1 flex items-center gap-3">
                                <div class="relative">
                                    <input type="file" name="reference_image" accept="image/*" id="ref-img" class="absolute inset-0 opacity-0 cursor-pointer" onchange="document.getElementById('ref-label').textContent=this.files[0]?.name||'Pilih file'">
                                    <button type="button" class="btn-secondary text-sm" onclick="document.getElementById('ref-img').click()">Pilih File</button>
                                </div>
                                <span id="ref-label" class="text-sm text-gray-400">Belum ada file dipilih</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                            @error('reference_image')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="form-label">Gambar Desain (opsional)</label>
                            <div class="mt-1 flex items-center gap-3">
                                <div class="relative">
                                    <input type="file" name="design_image" accept="image/*" id="des-img" class="absolute inset-0 opacity-0 cursor-pointer" onchange="document.getElementById('des-label').textContent=this.files[0]?.name||'Pilih file'">
                                    <button type="button" class="btn-secondary text-sm" onclick="document.getElementById('des-img').click()">Pilih File</button>
                                </div>
                                <span id="des-label" class="text-sm text-gray-400">Belum ada file dipilih</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Upload desain custom. Format: JPG, PNG, WEBP. Maks 5MB.</p>
                            @error('design_image')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sumber Bahan --}}
            <div class="card">
                <div class="card-body">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">3. Sumber Bahan</h2>
                    <div>
                        <label class="form-label">Sumber Bahan <span class="text-red-500">*</span></label>
                        <select name="sumber_bahan" class="form-input @error('sumber_bahan') form-error @enderror">
                            <option value="">-- Pilih Sumber Bahan --</option>
                            <option value="pelanggan" {{ old('sumber_bahan') === 'pelanggan' ? 'selected' : '' }}>Bahan dari Pelanggan</option>
                            <option value="penjahit" {{ old('sumber_bahan') === 'penjahit' ? 'selected' : '' }}>Bahan dari Penjahit</option>
                        </select>
                        @error('sumber_bahan')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Ukuran Badan --}}
            <div class="card">
                <div class="card-body">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">4. Ukuran Badan (opsional)</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="form-label">Lingkar Dada (cm)</label>
                            <input type="number" name="lingkar_dada" value="{{ old('lingkar_dada') }}" min="30" max="200" step="0.1" class="form-input @error('lingkar_dada') form-error @enderror">
                            @error('lingkar_dada')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="form-label">Lingkar Pinggang (cm)</label>
                            <input type="number" name="lingkar_pinggang" value="{{ old('lingkar_pinggang') }}" min="30" max="200" step="0.1" class="form-input @error('lingkar_pinggang') form-error @enderror">
                            @error('lingkar_pinggang')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="form-label">Lingkar Pinggul (cm)</label>
                            <input type="number" name="lingkar_pinggul" value="{{ old('lingkar_pinggul') }}" min="30" max="200" step="0.1" class="form-input @error('lingkar_pinggul') form-error @enderror">
                            @error('lingkar_pinggul')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="form-label">Lebar Bahu (cm)</label>
                            <input type="number" name="lebar_bahu" value="{{ old('lebar_bahu') }}" min="20" max="80" step="0.1" class="form-input @error('lebar_bahu') form-error @enderror">
                            @error('lebar_bahu')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="form-label">Panjang Lengan (cm)</label>
                            <input type="number" name="panjang_lengan" value="{{ old('panjang_lengan') }}" min="20" max="100" step="0.1" class="form-input @error('panjang_lengan') form-error @enderror">
                            @error('panjang_lengan')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="form-label">Panjang Baju (cm)</label>
                            <input type="number" name="panjang_baju" value="{{ old('panjang_baju') }}" min="30" max="200" step="0.1" class="form-input @error('panjang_baju') form-error @enderror">
                            @error('panjang_baju')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Kirim Pesanan
                </button>
                <a href="{{ route('user.orders.index') }}" class="btn-secondary">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection
