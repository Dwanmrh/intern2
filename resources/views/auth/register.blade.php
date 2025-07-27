<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-300 rounded-lg shadow-md px-8 py-10 w-full max-w-md text-gray-900">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-20">
            </div>

            <!-- Title -->
            <h2 class="text-center text-xl font-bold mb-6">Register</h2>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input id="name" name="name" type="text" required autofocus
                        class="w-full border border-gray-300 rounded py-2 px-4 focus:ring focus:ring-blue-200"
                        value="{{ old('name') }}">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" required
                        class="w-full border border-gray-300 rounded py-2 px-4 focus:ring focus:ring-blue-200"
                        value="{{ old('email') }}">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <input id="password" name="password" type="password" required
                        class="w-full border border-gray-300 rounded py-2 px-4 focus:ring focus:ring-blue-200"
                        autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="w-full border border-gray-300 rounded py-2 px-4 focus:ring focus:ring-blue-200"
                        autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Submit + Login Link -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:underline">
                        Sudah Punya Akun?
                    </a>

                    <button type="submit" class="px-6 py-2 bg-[#1E2D3D] text-white rounded hover:bg-blue-900 transition">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
