<nav x-data="{ open: false }" class="fixed top-0 w-full z-50 bg-[#1E293B] text-white border-b border-gray-700 py-1.5 shadow-lg">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <!-- GRID: Left - Center - Right -->
        <div class="flex justify-between items-center w-full">
            <!-- LEFT: Logo + Nav -->
            <div class="flex items-center space-x-16">
                <!-- Logo -->
                <a href="{{ route('dashboard.index') }}" class="flex items-center space-x-3 shrink-0">
                    <img src="{{ asset('assets/images/logo_setukpa.png') }}" class="h-12 w-auto" alt="Logo" />
                    <div class="flex flex-col leading-4 text-white font-semibold text-xs sm:text-sm">
                        <span>SETUKPA</span>
                        <span>LEMDIKLAT</span>
                        <span class="text-yellow-400">POLRI</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center flex-1 justify-center space-x-8 text-sm font-medium">
                    @php
                        $navItems = [
                            ['name' => 'HOME', 'routes' => ['dashboard.index','dashboard.create','dashboard.edit','dashboard.link.create','dashboard.link.edit']],
                            ['name' => 'PROFIL', 'routes' => ['profil.index','profil.create','profil.edit']],
                            ['name' => 'BERITA', 'routes' => ['berita.index','berita.show','berita.create','berita.edit']],
                            ['name' => 'INFORMASI', 'routes' => ['informasi.index','informasi.create','informasi.edit']],
                            ['name' => 'FASDIK', 'routes' => ['fasilitas.index','fasilitas.create','fasilitas.edit']],
                        ];

                        // Tambah modul hanya jika login dan role siswa/personel/admin
                        if(auth()->check() && in_array(auth()->user()->role, ['siswa','personel','admin'])){
                            $navItems[] = ['name' => 'MODUL', 'routes' => ['modul.index','modul.sip','modul.pag','modul.create','modul.edit']];
                        }
                    @endphp

                    @foreach ($navItems as $item)
                        <x-nav-link
                            :href="route($item['routes'][0])"
                            :active="collect($item['routes'])->contains(fn($route) => request()->routeIs($route))"
                            class="{{ collect($item['routes'])->contains(fn($route) => request()->routeIs($route))
                                ? 'bg-gray-100 text-blue-500 px-2 py-1 rounded-md font-semibold text-sm'
                                : 'text-white hover:bg-gray-500 hover:text-white px-2 py-1 rounded-md transition font-medium text-sm' }}"
                        >
                            {{ __($item['name']) }}
                        </x-nav-link>
                    @endforeach
                </div>

                <!-- CENTER: Search -->
                <div class="hidden lg:flex items-center mx-8">
                    <div class="relative w-64 search-container">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="absolute left-2 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"
                            />
                        </svg>
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Search..."
                            class="w-full bg-gray-700 text-white rounded-lg pl-9 pr-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                        >
                        <div
                            id="searchResults"
                            class="absolute mt-1 w-full bg-gray-800 border border-gray-600 rounded-md shadow-lg z-50 max-h-72 overflow-y-auto hidden"
                        >
                        </div>
                    </div>
                </div>

                <!-- Hamburger (Mobile) -->
                <div class="flex lg:hidden">
                    <button
                        @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-600 focus:outline-none transition"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{ 'hidden': open, 'inline-flex': !open }"
                                class="inline-flex"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{ 'hidden': !open, 'inline-flex': open }"
                                class="hidden"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- RIGHT: Auth -->
            <div class="flex items-center space-x-4 ml-3">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-1.5 rounded-lg transition font-semibold whitespace-nowrap
                                {{ request()->routeIs('profile.edit')
                                    ? 'bg-gray-100 text-[#1E293B]'
                                    : 'bg-gray-300 text-black hover:bg-gray-500 hover:text-blue-700' }}"
                            >
                                <span class="truncate">{{ Auth::user()->name }}</span>
                                <svg class="ml-2 w-4 h-4 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link
                                :href="route('profile.edit')"
                                class="hover:bg-gray-800 hover:text-white transition"
                            >
                                Profile
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="hover:bg-gray-800 hover:text-white transition"
                                >
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="ml-4 px-3 py-1.5 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition"
                    >
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- MOBILE MENU OVERLAY -->
    <div
        x-show="open"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
        @click="open = false"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
    </div>

    <!-- MOBILE DRAWER -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 w-3/4 max-w-sm h-full bg-[#1E293B] text-white z-50 shadow-xl overflow-y-auto lg:hidden"
    >
        <!-- Drawer Header -->
        <div class="flex items-center justify-between px-3 py-4 border-b border-gray-700">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('assets/images/logo_setukpa.png') }}" alt="Logo" class="h-8 w-8">
                <span>SETUKPA LEMDIKLAT <span class="text-yellow-400">POLRI</span></span>
            </div>
            <button @click="open = false" class="text-gray-300 hover:text-white focus:outline-none">✕</button>
        </div>

        <!-- Search (Mobile) -->
        <div class="px-3 py-4 relative search-container">
            <div class="relative w-full">
                <!-- Icon search -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z"
                    />
                </svg>

                <!-- Input -->
                <input
                    type="text"
                    id="searchInputMobile"
                    placeholder="Search..."
                    class="w-full bg-gray-700 text-white rounded-lg pl-10 pr-3 py-1.5 text-sm
                        focus:outline-none focus:ring-2 focus:ring-blue-400"
                />
            </div>

            <!-- Hasil Search -->
            <div
                id="searchResultsMobile"
                class="absolute left-0 right-0 mt-2 bg-gray-800 border border-gray-600 rounded-md shadow-lg
                    z-50 max-h-72 overflow-y-auto hidden"
            >
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="px-3 py-6 space-y-3">
            <x-responsive-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard')">
                HOME
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profil.index')" :active="request()->routeIs('profil')">
                PROFIL
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('berita.index')" :active="request()->routeIs('berita')">
                BERITA
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('informasi.index')" :active="request()->routeIs('informasi')">
                INFORMASI
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('fasilitas.index')" :active="request()->routeIs('fasilitas')">
                FASDIK
            </x-responsive-nav-link>

            @auth
                @if(in_array(Auth::user()->role, ['siswa','personel','admin']))
                    <x-responsive-nav-link :href="route('modul.index')" :active="request()->routeIs('modul')">
                        MODUL
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Auth Section -->
        @auth
            <div class="px-3 py-4 border-t border-gray-700">
                <div class="mb-3">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                </div>
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        @else
            <div class="px-3 py-4 border-t border-gray-700">
                <a
                    href="{{ route('login') }}"
                    class="block text-sm text-white underline hover:text-blue-300"
                >
                    Log in
                </a>
            </div>
        @endauth
    </div>
</nav>

{{-- Search Script (Desktop & Mobile Reusable) --}}
<script>
    function initSearch(inputId, resultsId) {
        const input = document.getElementById(inputId);
        const resultsDiv = document.getElementById(resultsId);

        if (!input || !resultsDiv) return;

        let typingTimer;
        const debounceTime = 300;

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

                const uniqueData = Array.from(new Map(data.map(item => [item.url, item])).values());

                if (final && uniqueData.length === 1) {
                    window.location.href = uniqueData[0].url;
                    return;
                }

                if (uniqueData.length === 0) {
                    resultsDiv.innerHTML = '<div class="px-3 py-1.5 text-sm text-gray-300">Tidak ditemukan</div>';
                    resultsDiv.classList.remove('hidden');
                    return;
                }

                uniqueData.forEach(item => {
                    const resultItem = document.createElement('a');
                    resultItem.href = item.url;
                    resultItem.className = 'search-item flex items-start gap-3 px-3 py-3 text-sm text-white border-b border-gray-700 rounded-md transition';

                    // Pilih ikon sesuai kategori
                    let icon = '🔎';
                    if (item.category.toLowerCase().includes('fasilitas')) icon = '🏛️';
                    if (item.category.toLowerCase().includes('berita')) icon = '📰';
                    if (item.category.toLowerCase().includes('informasi')) icon = '📚';
                    if (item.category.toLowerCase().includes('profil')) icon = '👤';

                    resultItem.innerHTML = `
                        <span class="text-lg">${icon}</span>
                        <div class="flex flex-col leading-tight">
                            <span class="text-blue-400 font-semibold">${item.category}</span>
                            <span class="text-gray-200">${item.title}</span>
                        </div>
                    `;
                    resultsDiv.appendChild(resultItem);
                });

                resultsDiv.classList.remove('hidden');

            } catch (error) {
                console.error('Search error:', error);
            }
        }

        input.addEventListener('input', () => {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => searchContent(false), debounceTime);
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                clearTimeout(typingTimer);
                searchContent(true);
            }
        });

        document.addEventListener('click', (e) => {
            if (!input.contains(e.target) && !resultsDiv.contains(e.target)) {
                resultsDiv.classList.add('hidden');
            }
        });
    }

    // Inisialisasi untuk Desktop & Mobile
    document.addEventListener("DOMContentLoaded", () => {
        initSearch('searchInput', 'searchResults');         // Desktop
        initSearch('searchInputMobile', 'searchResultsMobile'); // Mobile
    });
</script>
