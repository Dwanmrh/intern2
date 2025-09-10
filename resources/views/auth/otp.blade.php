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

            <!-- Success Message -->
            @if (session('status'))
                <div id="status-message" class="mb-4 text-green-600 font-semibold text-center">
                    {{ session('status') }}
                </div>
            @else
                <div id="status-message" class="mb-4 text-green-600 font-semibold text-center hidden"></div>
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

            <!-- Resend OTP -->
            <div class="mt-4 text-center">
                <button type="button" id="resend-btn"
                    class="w-full bg-gray-500 text-white py-2 rounded-lg font-semibold transition disabled:opacity-50 disabled:cursor-not-allowed"
                    @if($cooldown > 0) disabled @endif>
                    Kirim Ulang OTP <span id="countdown">
                        @if($cooldown > 0) ({{ str_pad($cooldown, 2, '0', STR_PAD_LEFT) }}) @endif
                    </span>
                </button>
            </div>

            <!-- Footer -->
            <p class="mt-6 text-xs text-gray-600 text-center">
                &copy; {{ date('Y') }} Setukpa Lemdiklat Polri
            </p>
        </div>
    </div>

    <script>
    let cooldown = {{ $cooldown }};
    let countdownEl = document.getElementById('countdown');
    let resendBtn = document.getElementById('resend-btn');

    // fungsi mulai ulang countdown
    function startCooldown(seconds) {
        cooldown = seconds;
        resendBtn.disabled = true;
        resendBtn.classList.remove("bg-[#1E2D3D]", "hover:bg-blue-900");
        resendBtn.classList.add("bg-gray-500");

        let interval = setInterval(() => {
            cooldown--;
            if (cooldown > 0) {
                countdownEl.textContent = "(" + String(cooldown).padStart(2, '0') + ")";
            } else {
                countdownEl.textContent = "";
                resendBtn.disabled = false;
                resendBtn.classList.remove("bg-gray-500");
                resendBtn.classList.add("bg-[#1E2D3D]", "hover:bg-blue-900");
                clearInterval(interval);
            }
        }, 1000);
    }

    // kalau ada cooldown dari server
    if (cooldown > 0) {
        startCooldown(cooldown);
    }

    // event click tombol resend
    resendBtn.addEventListener("click", function () {
        fetch("{{ route('auth.otp.resend') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json",
            },
        })
        .then(res => res.json())
        .then(data => {
            let statusMessage = document.getElementById("status-message");

            if (data.success) {
                statusMessage.textContent = data.message;
                statusMessage.classList.remove("hidden");
                statusMessage.classList.add("text-green-600");
                startCooldown(60);
            } else {
                statusMessage.textContent = data.message || "Gagal mengirim OTP.";
                statusMessage.classList.remove("hidden");
                statusMessage.classList.remove("text-green-600");
                statusMessage.classList.add("text-red-600");
            }
        })
        .catch(() => {
            let statusMessage = document.getElementById("status-message");
            statusMessage.textContent = "Terjadi kesalahan. Coba lagi.";
            statusMessage.classList.remove("hidden");
            statusMessage.classList.remove("text-green-600");
            statusMessage.classList.add("text-red-600");
        });
    });
</script>
</x-guest-layout>
