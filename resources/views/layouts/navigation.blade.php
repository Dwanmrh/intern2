<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/images/LOGO_SECAPA.png') }}" class="block h-9 w-auto" alt="Logo" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profil')" :active="request()->routeIs('profil')">
                        {{ __('Profil') }}
                    </x-nav-link>
                    <x-nav-link :href="route('berita')" :active="request()->routeIs('berita')">
                        {{ __('Berita') }}
                    </x-nav-link>
                    <x-nav-link :href="route('informasi')" :active="request()->routeIs('informasi')">
                        {{ __('Informasi') }}
                    </x-nav-link>
                    <x-nav-link :href="route('galeri')" :active="request()->routeIs('galeri')">
                        {{ __('Galeri') }}
                    </x-nav-link>

                    <!-- Link Dropdown -->
                    <x-dropdown align="left">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center h-16 px-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out">
                                {{ __('Link') }}
                                <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="'https://lemdiklat.polri.go.id/'" target="_blank">
                                {{ __('Big Data Lemdiklat Polri') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="'https://lemdiklat.polri.go.id/web/'" target="_blank">
                                {{ __('Web Lemdiklat Polri') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="'#'" target="_blank">
                                {{ __('Web SIPLS') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="relative">
    <input type="text" id="searchInput" placeholder="Cari Berita/Informasi..." class="border rounded px-2 py-1 text-sm" oninput="searchContent()">
    <div id="searchResults" class="absolute bg-white border mt-1 w-64 max-h-60 overflow-y-auto hidden z-50"></div>
</div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-700">Login</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profil')" :active="request()->routeIs('profil')">
                {{ __('Profil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('informasi')" :active="request()->routeIs('informasi')">
                {{ __('Informasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('berita')" :active="request()->routeIs('berita')">
                {{ __('Berita') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('galeri')" :active="request()->routeIs('galeri')">
                {{ __('Galeri') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 px-4 space-y-2">
                <a href="{{ route('login') }}" class="block text-sm text-gray-700 underline">Log in</a>
            </div>
        @endauth
    </div>
</nav>

<script>
    const beritaData = [
        { title: "Penerimaan Siswa Baru", url: "/berita#berita1" },
        { title: "Upacara Hari Bhayangkara", url: "/berita#berita2" },
        { title: "Kegiatan Donor Darah", url: "/berita#berita3" }
    ];

    const informasiData = [
        { title: "Jadwal Ujian Akhir", url: "/informasi#info1" },
        { title: "Pengumuman Kelulusan", url: "/informasi#info2" },
        { title: "Pendaftaran Pelatihan", url: "/informasi#info3" }
    ];

    function searchContent() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const resultsDiv = document.getElementById('searchResults');
        resultsDiv.innerHTML = '';
        if (input.length === 0) {
            resultsDiv.classList.add('hidden');
            return;
        }

        const allData = [...beritaData, ...informasiData];
        const filtered = allData.filter(item => item.title.toLowerCase().includes(input));

        if (filtered.length > 0) {
            filtered.forEach(item => {
                const link = document.createElement('a');
                link.href = item.url;
                link.textContent = item.title;
                link.className = 'block px-3 py-2 hover:bg-gray-100 text-sm text-gray-700';
                resultsDiv.appendChild(link);
            });
            resultsDiv.classList.remove('hidden');
        } else {
            resultsDiv.innerHTML = '<div class="px-3 py-2 text-sm text-gray-500">Tidak ditemukan</div>';
            resultsDiv.classList.remove('hidden');
        }
    }

    // Optional: hide when clicking outside
    document.addEventListener('click', function(e) {
        const search = document.getElementById('searchInput');
        const results = document.getElementById('searchResults');
        if (!search.contains(e.target) && !results.contains(e.target)) {
            results.classList.add('hidden');
        }
    });
</script>
