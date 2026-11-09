<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-red-600">Hapus Akun</h2>
        <p class="text-sm text-gray-500 mt-1">
            Setelah akun dihapus, seluruh data akan dihapus permanen. Harap unduh data yang ingin Anda simpan sebelum menghapus akun.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Hapus Akun</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-gray-900">Yakin ingin menghapus akun?</h2>
            <p class="mt-2 text-sm text-gray-500">
                Setelah akun dihapus, seluruh data akan dihapus permanen. Masukkan password untuk konfirmasi.
            </p>

            <div class="mt-6">
                <label class="form-label">Password</label>
                <input type="password" name="password" placeholder="Masukkan password"
                       class="form-input @error('password', 'userDeletion') border-red-500 @enderror">
                @error('password', 'userDeletion') <p class="form-error">{{ $message }}</p> @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                <x-danger-button>Hapus Akun</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>