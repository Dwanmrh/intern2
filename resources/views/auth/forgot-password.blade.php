<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-300 rounded-lg shadow-md px-8 py-10 w-full max-w-md text-gray-900">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/images/logo_setukpa.png') }}" alt="Logo" class="h-20">
            </div>

            <!-- Title -->
            <h2 class="text-center text-xl font-bold mb-4">Lupa Kata Sandi</h2>

            <!-- Info Text -->
            <p class="text-sm text-gray-700 mb-6 text-center">
                Lupa kata sandi? Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                        class="w-full border border-gray-300 rounded py-2 px-4 focus:ring focus:ring-blue-200"
                        value="{{ old('email') }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:underline">
                        Kembali ke Login
                    </a>

                    <button type="submit" class="px-6 py-2 bg-[#1E2D3D] text-white rounded hover:bg-blue-900 transition">
                        Kirim Tautan Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
