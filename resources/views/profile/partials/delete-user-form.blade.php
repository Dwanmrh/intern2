<div class="p-4 sm:p-8 bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] shadow sm:rounded-lg w-full">
    <section class="space-y-6 text-center text-white">
        <header>
            <h2 class="text-lg font-medium text-white">
                Hapus Akun
            </h2>

            <p class="mt-1 text-sm text-gray-300">
                Setelah akun Anda dihapus, semua data dan sumber daya akan dihapus secara permanen.
                Sebelum menghapus akun Anda, harap unduh semua data atau informasi yang ingin Anda simpan.
            </p>
        </header>

        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'konfirmasi-hapus-akun')"
            class="bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded shadow transition"
        >
            Hapus Akun
        </button>

        <x-modal name="konfirmasi-hapus-akun" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] rounded-xl shadow-xl border border-white/10 space-y-4 text-left">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-white">
                    Apakah Anda yakin ingin menghapus akun?
                </h2>

                <p class="mt-1 text-sm text-gray-300">
                    Setelah akun Anda dihapus, semua data dan sumber daya akan dihapus secara permanen.
                    Masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun secara permanen.
                </p>

                <div class="mt-4">
                    <x-input-label for="password" value="Kata Sandi" class="sr-only" />

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-full bg-white text-black placeholder-gray-600 border border-gray-400 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400 shadow-sm"
                        placeholder="Kata Sandi"
                    />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs text-red-400" />
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="button"
                        x-on:click="$dispatch('close')"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded shadow transition">
                        Batal
                    </button>

                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow ms-3 transition">
                        Hapus Akun
                    </button>
                </div>
            </form>
        </x-modal>
    </section>
</div>
