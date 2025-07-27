<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-300 rounded-lg shadow-md px-8 py-10 w-full max-w-md text-gray-900">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-20">
            </div>

            <!-- Title -->
            <h2 class="text-center text-xl font-bold mb-6">Login</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 4h16v16H4z" />
                            </svg>
                        </span>
                        <input id="email" name="email" type="email" required autofocus
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded w-full focus:ring focus:ring-blue-200"
                               placeholder="Masukan Email Anda"
                               value="{{ old('email') }}">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 11c.5 0 1-.5 1-1s-.5-1-1-1-1 .5-1 1 .5 1 1 1zM5 12h14v7H5zM12 3a9 9 0 00-9 9h18a9 9 0 00-9-9z" />
                            </svg>
                        </span>
                        <input id="password" name="password" type="password" required
                               class="pl-10 pr-10 py-2 border border-gray-300 rounded w-full focus:ring focus:ring-blue-200"
                               placeholder="********">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 cursor-pointer">
                            <!-- Tambahkan icon toggle jika ingin -->
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center text-sm">
                        <input type="checkbox" name="remember" class="form-checkbox text-blue-600">
                        <span class="ml-2 text-gray-700">Ingatkan saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:underline">
                            Lupa Kata Sandi?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="mb-4">
                    <button type="submit" class="w-full py-2 bg-[#1E2D3D] text-white font-semibold rounded hover:bg-blue-900 transition">
                        Login
                    </button>
                </div>

                <!-- Register Link -->
                <div class="text-center text-sm">
                    <a href="{{ route('register') }}" class="text-gray-700 hover:underline">
                        Belum Punya Akun?
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
