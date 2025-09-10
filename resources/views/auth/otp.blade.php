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
                <div id="status-message" class="mb-4 text-red-600 font-semibold text-center">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Success Message -->
            @if (session('status'))
                <div id="status-message" class="mb-4 text-green-600 font-semibold text-center">
                    {{ session('status') }}
                </div>
            @else
                <div id="status-message" class="mb-4 font-semibold text-center hidden"></div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('auth.otp.verify') }}" class="space-y-4">
                @csrf

                <!-- OTP Input -->
                <div class="text-center">
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
            <div class="mt-12 text-center">
                <button type="button" id="resend-btn"
                    class="inline-flex items-center gap-2 px-4 py-1.5 text-sm bg-blue-600 text-white rounded-md font-medium transition hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed"
                    @if($cooldown > 0) disabled @endif>
                    
                    <!-- Spinner -->
                    <svg id="spinner" class="hidden w-4 h-4 animate-spin text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                        </path>
                    </svg>

                    <span id="resend-text">Kirim Ulang OTP 
                        <span id="countdown">
                            @if($cooldown > 0) ({{ str_pad($cooldown, 2, '0', STR_PAD_LEFT) }}) @endif
                        </span>
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
        let statusMessage = document.getElementById("status-message");
        let spinner = document.getElementById("spinner");
        let resendText = document.getElementById("resend-text");

        function startCooldown(seconds) {
            cooldown = seconds;
            resendBtn.disabled = true;
            spinner.classList.add("hidden");
            resendText.textContent = "Kirim Ulang OTP (" + String(cooldown).padStart(2, '0') + ")";
            resendBtn.classList.remove("bg-blue-600", "hover:bg-blue-700");
            resendBtn.classList.add("bg-gray-500");

            let interval = setInterval(() => {
                cooldown--;
                if (cooldown > 0) {
                    resendText.textContent = "Kirim Ulang OTP (" + String(cooldown).padStart(2, '0') + ")";
                } else {
                    resendText.textContent = "Kirim Ulang OTP";
                    resendBtn.disabled = false;
                    resendBtn.classList.remove("bg-gray-500");
                    resendBtn.classList.add("bg-blue-600", "hover:bg-blue-700");
                    clearInterval(interval);
                }
            }, 1000);
        }

        function hideStatusAfterDelay() {
            if (!statusMessage.classList.contains("hidden")) {
                setTimeout(() => {
                    statusMessage.classList.add("hidden");
                }, 8000); // auto hide setelah 3 detik
            }
        }
        hideStatusAfterDelay();

        if (cooldown > 0) {
            startCooldown(cooldown);
        }

        resendBtn.addEventListener("click", function () {
            resendBtn.disabled = true;
            spinner.classList.remove("hidden"); // tampilkan spinner
            resendText.textContent = "Mengirim...";

            fetch("{{ route('auth.otp.resend') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json",
                },
            })
            .then(res => res.json())
            .then(data => {
                statusMessage.textContent = data.message || "Gagal mengirim OTP.";
                statusMessage.classList.remove("hidden");
                statusMessage.classList.toggle("text-green-600", data.success);
                statusMessage.classList.toggle("text-red-600", !data.success);
                hideStatusAfterDelay();

                spinner.classList.add("hidden"); // sembunyikan spinner

                if (data.success) {
                    startCooldown(60);
                } else {
                    resendBtn.disabled = false;
                    resendText.textContent = "Kirim Ulang OTP";
                }
            })
            .catch(() => {
                statusMessage.textContent = "Terjadi kesalahan. Coba lagi.";
                statusMessage.classList.remove("hidden");
                statusMessage.classList.remove("text-green-600");
                statusMessage.classList.add("text-red-600");
                hideStatusAfterDelay();

                spinner.classList.add("hidden"); // sembunyikan spinner
                resendBtn.disabled = false;
                resendText.textContent = "Kirim Ulang OTP";
            });
        });
    </script>
</x-guest-layout>
