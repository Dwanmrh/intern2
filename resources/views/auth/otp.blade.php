<x-guest-layout>
    @section('title', 'KODE OTP | SETUKPA LEMDIKLAT POLRI')

    <div class="flex justify-center items-center min-h-screen bg-[#1E2D3D]">
        <div class="bg-gray-300 rounded-lg shadow-md px-8 py-10 w-full max-w-sm text-gray-900">

            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/images/logo_setukpa.png') }}" alt="Logo" class="h-20">
            </div>

            <!-- Title -->
            <h2 class="text-center text-xl font-bold mb-6 text-gray-800">Verifikasi OTP</h2>

            <!-- Error Message -->
            @if (session('error'))
                <div class="mb-4 text-red-600 font-semibold text-center">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('auth.otp.verify') }}">
                @csrf

                <!-- OTP Input -->
                <div class="mb-6 text-center">
                    <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">Masukkan Kode OTP</label>
                    <input id="otp" type="text" name="otp" required maxlength="6"
                        class="tracking-widest text-center text-2xl font-bold w-full px-4 py-3 border border-gray-400 rounded-lg shadow-sm focus:ring focus:ring-blue-400 focus:outline-none"
                        placeholder="••••••">
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-[#1E2D3D] text-white py-2 rounded-lg font-semibold hover:bg-blue-900 transition">
                    Verifikasi
                </button>
            </form>

            <!-- Footer -->
            <p class="mt-6 text-xs text-gray-600 text-center">
                &copy; {{ date('Y') }} Setukpa Lemdiklat Polri
            </p>
        </div>
    </div>
</x-guest-layout>
