<x-app-layout>
    @section('title', 'TAMBAH USER | SETUKPA LEMDIKLAT POLRI')

    <div class="py-10 px-4">
        <div class="max-w-md mx-auto bg-gradient-to-br from-[#2c3e50] to-[#3b4a5a] p-6 rounded-xl shadow-2xl border border-white/10 transition-all duration-300">

            {{-- Header --}}
            <h2 class="text-xl text-white font-bold text-center mb-4">Tambah User</h2>

            {{-- Error --}}
            @if($errors->any())
                <div class="bg-red-500 text-white px-3 py-1.5 rounded shadow mb-4 text-sm">
                    <strong>Terjadi kesalahan:</strong> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="block text-white font-semibold mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                           required placeholder="Masukkan nama user">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-white font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                           required placeholder="Masukkan email">
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-white font-semibold mb-1">Password</label>
                    <div class="relative">
                        <input id="passwordCreate" type="password" name="password"
                               class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 pr-10
                                      focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                               required placeholder="Masukkan password">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-600 cursor-pointer"
                              onclick="togglePasswordVisibility('passwordCreate', 'eyeOpenCreate', 'eyeOffCreate')">
                            <!-- Eye Open -->
                            <svg id="eyeOpenCreate" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye Off -->
                            <svg id="eyeOffCreate" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.972 9.972 0 013.193-4.568m2.195-1.548A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.976 9.976 0 01-4.043 5.306M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3l18 18" />
                            </svg>
                        </span>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-white font-semibold mb-1">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="passwordConfirmCreate" type="password" name="password_confirmation"
                               class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5 pr-10
                                      focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition"
                               required placeholder="Ulangi password">
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-600 cursor-pointer"
                              onclick="togglePasswordVisibility('passwordConfirmCreate', 'eyeOpenConfirm', 'eyeOffConfirm')">
                            <!-- Eye Open -->
                            <svg id="eyeOpenConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye Off -->
                            <svg id="eyeOffConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.972 9.972 0 013.193-4.568m2.195-1.548A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.976 9.976 0 01-4.043 5.306M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3l18 18" />
                            </svg>
                        </span>
                    </div>
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-white font-semibold mb-1">Role</label>
                    <select name="role"
                            class="w-full bg-white text-black border border-gray-500 rounded-md px-3 py-1.5
                                   focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-inner transition">
                        <option value="siswa">Siswa</option>
                        <option value="personel">Personel</option>
                        <option value="admin">Admin</option>
                        <option value="super_admin">Super Admin</option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="flex justify-end space-x-3">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md
                                   shadow-md hover:shadow-lg transition">
                        Simpan
                    </button>

                    <a href="{{ route('users.index') }}"
                       class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md
                              shadow-md hover:shadow-lg transition">
                        Batal
                    </a>
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
</x-app-layout>
