<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-gray-900">Ubah Password</h2>
        <p class="text-sm text-gray-500 mt-1">Pastikan akun Anda menggunakan password yang kuat dan acak.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label class="form-label">Password Saat Ini</label>
            <input type="password" name="current_password" required autocomplete="current-password"
                   class="form-input @error('current_password', 'updatePassword') border-red-500 @enderror"
                   placeholder="Masukkan password saat ini">
            @error('current_password', 'updatePassword') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="form-label">Password Baru</label>
            <input type="password" name="password" required autocomplete="new-password"
                   class="form-input @error('password', 'updatePassword') border-red-500 @enderror"
                   placeholder="Min. 8 karakter">
            @error('password', 'updatePassword') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" required autocomplete="new-password"
                   class="form-input" placeholder="Ulangi password baru">
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="btn-primary">Simpan</button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-emerald-600 font-medium">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>