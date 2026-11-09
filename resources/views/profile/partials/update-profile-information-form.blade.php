<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-gray-900">Informasi Profil</h2>
        <p class="text-sm text-gray-500 mt-1">Perbarui informasi nama dan email akun Anda.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus
                   class="form-input @error('name') border-red-500 @enderror"
                   placeholder="Nama lengkap Anda">
            @error('name') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                   class="form-input @error('email') border-red-500 @enderror"
                   placeholder="nama@email.com">
            @error('email') <p class="form-error">{{ $message }}</p> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 px-4 py-3 rounded-xl bg-amber-50 border border-amber-200">
                    <p class="text-sm text-amber-800">
                        Email Anda belum diverifikasi.
                        <button form="send-verification" class="underline font-semibold hover:text-amber-600">
                            Klik untuk kirim ulang email verifikasi.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-sm font-medium text-emerald-600">
                            Tautan verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="btn-primary">Simpan</button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-emerald-600 font-medium">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>