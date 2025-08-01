<div class="pt-1 pb-6 px-4 w-full flex justify-center">
    <section class="bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-4 rounded-xl shadow-2xl border border-white/10 transition-all duration-300 w-full max-w-[28rem] mx-auto">
        <header class="mb-5 text-center">
            <h2 class="text-lg text-white font-bold">Update Password</h2>
            <p class="mt-3 text-sm text-gray-300">Pastikan kata sandi aman & mudah diingat.</p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="space-y-4 text-sm">
            @csrf
            @method('put')

            {{-- Current Password --}}
            <div class="space-y-1">
                <label for="current_password" class="block text-white font-medium">Kata Sandi Saat Ini</label>
                <x-text-input
                    id="current_password"
                    name="current_password"
                    type="password"
                    placeholder="Sandi lama"
                    class="w-full bg-white text-black placeholder-gray-600 border border-gray-400 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400 shadow-sm"
                    autocomplete="current-password"
                />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-xs text-red-400" />
            </div>

            {{-- New Password --}}
            <div class="space-y-1">
                <label for="password" class="block text-white font-medium">Kata Sandi Baru</label>
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Sandi baru"
                    class="w-full bg-white text-black placeholder-gray-600 border border-gray-400 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400 shadow-sm"
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="text-xs text-red-400" />
            </div>

            {{-- Confirm Password --}}
            <div class="space-y-1">
                <label for="password_confirmation" class="block text-white font-medium">Konfirmasi Sandi</label>
                <x-text-input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Ulangi sandi"
                    class="w-full bg-white text-black placeholder-gray-600 border border-gray-400 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-400 shadow-sm"
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-xs text-red-400" />
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end items-center gap-3 pt-2">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded shadow-md transition">
                    Simpan
                </button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition
                       x-init="setTimeout(() => show = false, 2000)"
                       class="text-xs text-green-400">Berhasil disimpan.</p>
                @endif
            </div>
        </form>
    </section>
</div>
