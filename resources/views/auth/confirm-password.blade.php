<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-300 rounded-lg shadow-md px-8 py-10 w-full max-w-md text-gray-900">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-20">
            </div>

            <!-- Title -->
            <h2 class="text-center text-xl font-bold mb-4">Konfirmasi Kata Sandi</h2>

            <!-- Info -->
            <p class="text-sm text-gray-700 mb-6 text-center">
                Ini adalah area aman dari aplikasi. Silakan masukkan kata sandi Anda untuk melanjutkan.
            </p>

            <!-- Form -->
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <input id="password" name="password" type="password" required
                        class="w-full border border-gray-300 rounded py-2 px-4 focus:ring focus:ring-blue-200"
                        autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-[#1E2D3D] text-white rounded hover:bg-blue-900 transition">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
