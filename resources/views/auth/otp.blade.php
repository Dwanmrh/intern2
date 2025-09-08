<x-guest-layout>
    @section('title', 'Masukkan Kode OTP')

    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Verifikasi OTP</h2>

            @if (session('error'))
                <div class="mb-4 text-red-600 font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('auth.otp.verify') }}">
                @csrf
                <div class="mb-4">
                    <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">Kode OTP</label>
                    <input id="otp" type="text" name="otp" required
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-400 focus:outline-none">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Verifikasi
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
