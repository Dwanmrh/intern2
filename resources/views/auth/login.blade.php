<x-guest-layout>
    @section('title', 'LOGIN | SETUKPA LEMDIKLAT POLRI')
    <div class="min-h-screen flex items-center justify-center bg-[#1E2D3D]">
        <div class="bg-gray-300 rounded-lg shadow-md px-6 py-6 w-full max-w-sm text-gray-900">

            <!-- Logo -->
            <div class="flex justify-center mb-3">
                <img src="{{ asset('assets/images/logo_setukpa.png') }}" alt="Logo" class="h-20">
            </div>

            <!-- Title -->
            <h2 class="text-center text-xl font-bold mb-6">Login</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 0a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                            </svg>
                        </span>
                        <input id="email" name="email" type="email" required autofocus
                            class="pl-10 pr-4 py-1.5 border border-gray-300 rounded w-full focus:ring focus:ring-blue-200"
                            placeholder="Masukkan Email Anda" value="{{ old('email') }}">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c.828 0 1.5.672 1.5 1.5S12.828 14 12 14s-1.5-.672-1.5-1.5S11.172 11 12 11zm-6 1.5v5A1.5 1.5 0 007.5 19h9a1.5 1.5 0 001.5-1.5v-5a1.5 1.5 0 00-1.5-1.5h-.75V9a3.75 3.75 0 00-7.5 0v2H6z" />
                            </svg>
                        </span>
                        <input id="password" name="password" type="password" required
                            class="pl-10 pr-10 py-1.5 border border-gray-300 rounded w-full focus:ring focus:ring-blue-200"
                            placeholder="Masukan Kata Sandi Anda">

                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 cursor-pointer"
                            onclick="togglePasswordVisibility('password', 'eyeOpenLogin', 'eyeOffLogin')">
                            <!-- Eye Open -->
                            <svg id="eyeOpenLogin" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye Off -->
                            <svg id="eyeOffLogin" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.972 9.972 0 013.193-4.568m2.195-1.548A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.976 9.976 0 01-4.043 5.306M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3l18 18" />
                            </svg>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Login Sebagai</label>
                    <select id="role" name="role" required
                        class="px-3 py-1.5 border border-gray-300 rounded w-full focus:ring focus:ring-blue-200">
                        <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="personel" {{ old('role') == 'personel' ? 'selected' : '' }}>Personel</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <!-- reCAPTCHA -->
                <div class="mb-2 flex justify-start">
                    <div class="block">
                        <div class="g-recaptcha scale-90 origin-top-left" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                        <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-1 text-xs text-red-600" />
                    </div>
                </div>

                <!-- Load Script -->
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-3 text-sm">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="form-checkbox text-blue-600">
                        <span class="ml-2 text-gray-700">Ingatkan saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-gray-600 hover:underline">
                            Lupa Kata Sandi?
                        </a>
                    @endif
                </div>

                <!-- Submit & Register Link -->
                <div class="flex items-center justify-between text-sm">
                    <a href="{{ route('register') }}" class="text-gray-700 hover:underline">
                    Belum punya akun?</a>
                    <button type="submit" class="px-6 py-1.5 bg-[#1E2D3D] text-white rounded hover:bg-blue-900 transition">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, eyeOpenId, eyeOffId) {
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(eyeOpenId);
            const eyeOff = document.getElementById(eyeOffId);

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            }
        }
    </script>
</x-guest-layout>
