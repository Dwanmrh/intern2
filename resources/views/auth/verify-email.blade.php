<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-300 rounded-lg shadow-md px-8 py-10 w-full max-w-md text-gray-900">
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-20">
            </div>

            <!-- Title -->
            <h2 class="text-center text-xl font-bold mb-4">Verifikasi Email</h2>

            <!-- Info Text -->
            <p class="text-sm text-gray-700 text-center mb-6">
                Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang telah kami kirimkan. Jika Anda belum menerima email tersebut, kami akan mengirimkannya kembali.
            </p>

            <!-- Status -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-700 text-center">
                    Tautan verifikasi baru telah dikirim ke alamat email Anda.
                </div>
            @endif

            <!-- Resend & Logout -->
            <div class="flex justify-between items-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-[#1E2D3D] text-white rounded hover:bg-blue-900 transition">
                        Kirim Ulang Email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-700 hover:underline">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
