<div class="p-4 w-full flex justify-center">
    <section class="bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] rounded-xl shadow-2xl p-4 border border-white/10 transition-all duration-300 w-full max-w-[28rem] mx-auto">
        <header class="mb-3 text-center">
            <h2 class="text-lg font-bold text-white">Update Informasi Akun</h2>
            <p class="mt-1 text-sm text-gray-300">Perbarui detail akun dan alamat email Anda.</p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-3 text-sm">
            @csrf
            @method('patch')

            {{-- Nama --}}
            <div class="space-y-1">
                <label for="name" class="block text-white font-medium">Nama</label>
                <input id="name" name="name" type="text"
                       class="w-full bg-white text-black placeholder-gray-500 border border-gray-500 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-400 shadow-sm transition text-sm"
                       value="{{ old('name', $user->name) }}" required placeholder="Masukkan nama Anda">
                <x-input-error class="text-xs text-red-400" :messages="$errors->get('name')" />
            </div>

            {{-- Email --}}
            <div class="space-y-1">
                <label for="email" class="block text-white font-medium">Email</label>
                <input id="email" name="email" type="email"
                       class="w-full bg-white text-black placeholder-gray-500 border border-gray-500 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-400 shadow-sm transition text-sm"
                       value="{{ old('email', $user->email) }}" required placeholder="Masukkan email Anda">
                <x-input-error class="text-xs text-red-400" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-1 text-xs text-gray-300 space-y-1">
                        <p>
                            Email Anda belum diverifikasi.
                            <button form="send-verification"
                                    class="underline text-blue-300 hover:text-blue-400 focus:outline-none">
                                Kirim ulang email verifikasi.
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="font-medium text-green-400">
                                Tautan verifikasi baru telah dikirim.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded shadow-md transition text-sm">
                    Simpan
                </button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition
                       x-init="setTimeout(() => show = false, 2000)"
                       class="text-xs text-green-400 pt-1">Berhasil disimpan.</p>
                @endif
            </div>
        </form>
    </section>
</div>
