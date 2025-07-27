<nav x-data="{ open: false }" class="fixed top-0 w-full z-50 bg-gray-800 text-white border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 w-full">

            <!-- KIRI: Logo dan Navigasi -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard.index') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" class="block h-9 w-auto" alt="Logo" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-6">
                    <x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard')" class="text-white hover:text-blue-300 hover:border-blue-300">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profil')" :active="request()->routeIs('profil')" class="text-white hover:text-blue-300 hover:border-blue-300">
                        {{ __('Profil') }}
                    </x-nav-link>
                    <x-nav-link :href="route('berita')" :active="request()->routeIs('berita')" class="text-white hover:text-blue-300 hover:border-blue-300">
                        {{ __('Berita') }}
                    </x-nav-link>
                    <x-nav-link :href="route('informasi.index')" :active="request()->routeIs('informasi')" class="text-white hover:text-blue-300 hover:border-blue-300">
                        {{ __('Informasi') }}
                    </x-nav-link>
                    <x-nav-link :href="route('galeri.index')" :active="request()->routeIs('galeri')" class="text-white hover:text-blue-300 hover:border-blue-300">
                        {{ __('Galeri') }}
                    </x-nav-link>

                    <!-- Dropdown Link -->
                    <x-dropdown align="left">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center h-16 px-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:text-blue-300 hover:border-blue-300 focus:outline-none transition duration-150 ease-in-out">
                                {{ __('Link') }}
                                <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="'https://lemdiklat.polri.go.id/'" target="_blank">Big Data Lemdiklat Polri</x-dropdown-link>
                            <x-dropdown-link :href="'https://lemdiklat.polri.go.id/web/'" target="_blank">Web Lemdiklat Polri</x-dropdown-link>
                            <x-dropdown-link :href="'#'" target="_blank">Web SIPLS</x-dropdown-link>
                            <x-dropdown-link :href="'#'" target="_blank">E-Library Lemdiklat Polri</x-dropdown-link>
                            <x-dropdown-link :href="'#'" target="_blank">Smart Class</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- TENGAH: Search -->
            <div class="flex-1 flex justify-center">
                <div class="relative w-72">
                    <input type="text" id="searchInput"
                        placeholder="🔍 Cari konten di situs..."
                        class="w-full rounded-lg px-3 py-2 bg-gray-700 text-white placeholder-gray-400 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500"
                        oninput="searchContent()">
                    <div id="searchResults"
                        class="absolute mt-1 w-full bg-gray-800 border border-gray-600 rounded-md shadow-lg z-50 max-h-72 overflow-y-auto hidden">
                    </div>
                </div>
            </div>

            <!-- KANAN: Profile -->
            <div class="flex items-center ms-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gray-800 hover:text-blue-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-white hover:text-blue-300">Login</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-800 text-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard')" class="text-white hover:text-blue-300">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profil')" :active="request()->routeIs('profil')" class="text-white hover:text-blue-300">
                {{ __('Profil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('informasi.index')" :active="request()->routeIs('informasi')" class="text-white hover:text-blue-300">
                {{ __('Informasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('berita')" :active="request()->routeIs('berita')" class="text-white hover:text-blue-300">
                {{ __('Berita') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('galeri.index')" :active="request()->routeIs('galeri')" class="text-white hover:text-blue-300">
                {{ __('Galeri') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-700">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-blue-300">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-white hover:text-blue-300">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-700 px-4 space-y-2">
                <a href="{{ route('login') }}" class="block text-sm text-white underline hover:text-blue-300">Log in</a>
            </div>
        @endauth
    </div>
</nav>

<script>
    const input = document.getElementById('searchInput');
    const resultsDiv = document.getElementById('searchResults');

    let typingTimer;
    const debounceTime = 300; // ms

    async function searchContent(final = false) {
        const query = input.value.trim().toLowerCase();
        resultsDiv.innerHTML = '';

        if (query.length < 2) {
            resultsDiv.classList.add('hidden');
            return;
        }

        try {
            const response = await fetch(`/search?query=${encodeURIComponent(query)}`);
            const data = await response.json();

            // Filter hasil jika `final` (dari tombol Enter), tampilkan langsung redirect jika cuma satu
            const uniqueData = Array.from(new Map(data.map(item => [item.url, item])).values());

            if (final && uniqueData.length === 1) {
                // Kalau cuma satu hasil, langsung redirect
                window.location.href = uniqueData[0].url;
                return;
            }

            if (uniqueData.length === 0) {
                resultsDiv.innerHTML = '<div class="px-4 py-2 text-sm text-gray-300">Tidak ditemukan</div>';
                resultsDiv.classList.remove('hidden');
                return;
            }

            uniqueData.forEach(item => {
                const resultItem = document.createElement('a');
                resultItem.href = item.url;
                resultItem.className = 'block px-4 py-2 text-sm text-white hover:bg-blue-700 border-b border-gray-700';
                resultItem.innerHTML = `<span class="text-blue-400 font-semibold">${item.category}</span>: ${item.title}`;
                resultsDiv.appendChild(resultItem);
            });

            resultsDiv.classList.remove('hidden');

        } catch (error) {
            console.error('Search error:', error);
        }
    }

    // Saat ketik: debounce
    input.addEventListener('input', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            searchContent(false);
        }, debounceTime);
    });

    // Saat tekan Enter: jalankan pencarian final
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(typingTimer); // batalin debounce
            searchContent(true); // pencarian final
        }
    });

    // Tutup hasil saat klik di luar
    document.addEventListener('click', function (e) {
        if (!input.contains(e.target) && !resultsDiv.contains(e.target)) {
            resultsDiv.classList.add('hidden');
        }
    });
</script>
