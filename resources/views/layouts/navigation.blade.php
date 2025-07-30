<nav x-data="{ open: false }"
    class="fixed top-0 w-full z-50 bg-[#1E293B] text-white border-b border-gray-700"
    style="box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between w-full gap-2">

            <!-- KIRI: Logo dan Navigasi -->
            <div class="flex items-center space-x-10">
                <!-- Logo (Ukuran diperbesar) -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard.index') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" class="block h-14 w-auto" alt="Logo" />
                    </a>
                </div>

                <!-- Hamburger button (Hanya muncul di layar kecil) -->
                <div class="flex sm:hidden">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-600 focus:outline-none focus:bg-gray-600 transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center space-x-6 text-base font-medium">
                    @php
                        $navItems = [
                            ['name' => 'Home', 'route' => 'dashboard.index'],
                            ['name' => 'Profil', 'route' => 'profil.index'],
                            ['name' => 'Berita', 'route' => 'berita.index'],
                            ['name' => 'Informasi', 'route' => 'informasi.index'],
                            ['name' => 'Fasilitas', 'route' => 'fasilitas.index'],
                            ['name' => 'Galeri', 'route' => 'galeri.index'],
                        ];
                        $linkRoutes = [
                            'https://lemdiklat.polri.go.id/',
                            'https://lemdiklat.polri.go.id/web/',
                            'https://sipl.lemdiklat.polri.go.id/',
                            'https://elibrary.lemdiklat.polri.go.id/',
                            'http://103.180.58.114:11582/',

                            // PUSDIKMIN
                            'https://www.instagram.com/pusdikmin?igsh=NG9qNHpvODFsZ2E5',
                            'https://youtube.com/@pidpusdikmin?si=yMAPF2lfXHRtbC5C',
                            'https://www.tiktok.com/@pusdikadministrasi?_t=ZS-8yOjezU9ZP0&_r=1',

                            // PUSDIK LANTAS
                            'https://www.instagram.com/pusdik_lantas?igsh=MTFrM28zdXlucnB0MQ==',
                            'https://youtube.com/@pusdiklantas?si=0b7kFlagbQOc9fz8',

                            // PUSDIK SABHARA
                            'https://www.instagram.com/pusdiksabhara.official?igsh=MWcybXY5M290c2U2aQ==',
                            'https://www.tiktok.com/@pusdiksabhara.ofc?_t=ZS-8yP5EBnYOjX&_r=1',
                            'https://youtube.com/@pusdiksabhara?si=a5YL3DDUBEsqOm3e',

                            // DIKLAT RESERSE
                            'https://www.tiktok.com/@diklat_reserse?_t=ZS-8yP5QgUb0ZL&_r=1',
                            'https://www.instagram.com/humas_diklatreserse?igsh=ajJub3g4am54a2d4',

                            // PUSDIK BINMAS
                            'https://www.instagram.com/pusdikbinmas?igsh=NHc2Nzk1OW1icDB1',
                            'https://www.tiktok.com/@pusdikbinmas?_t=ZS-8yP5cd6K9vr&_r=1',
                            'https://youtube.com/@pusdikbinmaslemdiklatpolri?si=j22fbhfx5zoqZj6e',

                            // PUSDIK BRIMOD
                            'https://www.tiktok.com/@pusdikbrimobwatukosek_?_t=ZS-8yP5kinlQyA&_r=1',
                            'https://youtube.com/@pusdikbrimob2782?si=h3JVf7_O8nuQbBN0',
                            'https://www.instagram.com/humaspusdikbrimob?igsh=azhkM2hhbnp4em1x',

                        ];
                    @endphp
                    @foreach ($navItems as $item)
                        <x-nav-link
                            :href="route($item['route'])"
                            :active="request()->routeIs($item['route'])"
                            class="{{ request()->routeIs($item['route'])
                                ? 'bg-gray-100 text-blue-500 px-3 py-1 rounded-lg font-semibold'
                                : 'text-white hover:bg-gray-500 hover:text-white px-3 py-1 rounded-lg transition font-medium' }}">
                            {{ __($item['name']) }}
                        </x-nav-link>
                    @endforeach

                    <!-- Dropdown LINK -->
                    <x-dropdown align="left">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 rounded-lg transition font-medium
                                    {{ Str::contains(url()->current(), $linkRoutes)
                                        ? 'bg-gray-100 text-blue-500'
                                        : 'text-white hover:bg-gray-500 hover:text-white' }}">
                                {{ __('Link') }}
                                <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="dropdown-scroll">
                                <x-dropdown-link :href="'https://lemdiklat.polri.go.id/'" target="_blank">
                                    Big Data Lemdiklat Polri
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://lemdiklat.polri.go.id/web/'" target="_blank">
                                    Web Lemdiklat Polri
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://sipl.lemdiklat.polri.go.id/'" target="_blank">
                                    Web SIPL
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://elibrary.lemdiklat.polri.go.id/'" target="_blank">
                                    E-Library Lemdiklat Polri
                                </x-dropdown-link>
                                <x-dropdown-link :href="'http://103.180.58.114:11582/'" target="_blank">
                                    Smart Class
                                </x-dropdown-link>

                                {{-- PUSDIKMIN --}}
                                <x-dropdown-link :href="'https://www.instagram.com/pusdikmin?igsh=NG9qNHpvODFsZ2E5'" target="_blank">
                                    IG PUSDIKMIN
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://youtube.com/@pidpusdikmin?si=yMAPF2lfXHRtbC5C'" target="_blank">
                                    YT PUSDIKMIN
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://www.tiktok.com/@pusdikadministrasi?_t=ZS-8yOjezU9ZP0&_r=1'" target="_blank">
                                    TIKTOK PUSDIKMIN
                                </x-dropdown-link>

                                {{-- PUSDIK LANTAS  --}}
                                <x-dropdown-link :href="'https://www.instagram.com/pusdik_lantas?igsh=MTFrM28zdXlucnB0MQ=='" target="_blank">
                                    IG PUSDIK LANTAS
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://www.tiktok.com/@pusdikadministrasi?_t=ZS-8yOjezU9ZP0&_r=1'" target="_blank">
                                    YT PUSDIK LANTAS
                                </x-dropdown-link>

                                {{-- PUSDIK SABHARA --}}
                                <x-dropdown-link :href="'https://www.instagram.com/pusdiksabhara.official?igsh=MWcybXY5M290c2U2aQ=='" target="_blank">
                                    IG PUSDIK SABHARA
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://www.tiktok.com/@pusdiksabhara.ofc?_t=ZS-8yP5EBnYOjX&_r=1'" target="_blank">
                                    TIKTOK PUSDIK SABHARA
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://youtube.com/@pusdiksabhara?si=a5YL3DDUBEsqOm3e'" target="_blank">
                                    YT PUSDIK SABHARA
                                </x-dropdown-link>

                                {{-- DIKLAT RESERSE --}}
                                <x-dropdown-link :href="'https://www.tiktok.com/@diklat_reserse?_t=ZS-8yP5QgUb0ZL&_r=1'" target="_blank">
                                    TIKTOK DIKLAT RESERSE
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://www.instagram.com/humas_diklatreserse?igsh=ajJub3g4am54a2d4'" target="_blank">
                                    IG DIKLAT RESERSE
                                </x-dropdown-link>

                                {{-- PUSDIK BINMAS --}}
                                <x-dropdown-link :href="'https://www.instagram.com/pusdikbinmas?igsh=NHc2Nzk1OW1icDB1'" target="_blank">
                                    IG PUSDIK BINMAS
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://www.tiktok.com/@pusdikbinmas?_t=ZS-8yP5cd6K9vr&_r=1'" target="_blank">
                                    TIKTOK PUSDIK BINMAS
                                </x-dropdown-link>

                                {{-- PUSDIK BRIMOB --}}
                                <x-dropdown-link :href="'https://www.tiktok.com/@pusdikbrimobwatukosek_?_t=ZS-8yP5kinlQyA&_r=1'" target="_blank">
                                    TIKTOK PUSDIK BINMAS
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://youtube.com/@pusdikbrimob2782?si=h3JVf7_O8nuQbBN0'" target="_blank">
                                    YT PUSDIK BINMAS
                                </x-dropdown-link>
                                <x-dropdown-link :href="'https://www.instagram.com/humaspusdikbrimob?igsh=azhkM2hhbnp4em1x'" target="_blank">
                                    IG PUSDIK BINMAS
                                </x-dropdown-link>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            <!-- TENGAH: Search bar digeser ke kanan -->
            <div class="flex flex-1 justify-end pr-4 min-w-0">
                <div class="relative w-full max-w-xs">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.386a1 1 0 01-1.414 1.415l-4.387-4.387zM8 14a6 6 0 100-12 6 6 0 000 12z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <input type="text" id="searchInput"
                        placeholder="Cari..."
                        class="w-full pl-10 pr-3 py-2 bg-gray-700 text-white placeholder-gray-400 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-500"
                        oninput="searchContent()">
                    <div id="searchResults"
                        class="absolute mt-1 w-full bg-gray-800 border border-gray-600 rounded-md shadow-lg z-50 max-h-72 overflow-y-auto hidden">
                    </div>
                </div>
            </div>
            <!-- KANAN: Profile atau Login -->
            <div class="shrink-0 flex items-center ms-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 rounded-lg transition duration-200 font-semibold
                            {{ request()->routeIs('profile.edit')
                                ? 'bg-gray-100 text-[#1E293B]'
                                : 'bg-gray-700 text-white hover:bg-gray-500 hover:text-blue-700' }}">
                            
                            <div class="text-inherit">{{ Auth::user()->name }}</div>
                            
                            <svg class="ms-2 w-4 h-4 text-inherit" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        </x-slot>
                        <x-slot name="content">

                            <x-dropdown-link
                                :href="route('profile.edit')"
                                class="hover:bg-gray-800 hover:text-white transition">
                                Profile
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="hover:bg-gray-800 hover:text-white transition">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="ml-4 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">
                        Login
                    </a>
                @endauth
            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-[#1E293B] text-white z-70 relative">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profil.index')" :active="request()->routeIs('profil')">
                {{ __('Profil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('informasi.index')" :active="request()->routeIs('informasi')">
                {{ __('Informasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('fasilitas.index')" :active="request()->routeIs('fasilitas')">
                {{ __('Fasilitas') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('berita.index')" :active="request()->routeIs('berita')">
                {{ __('Berita') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('galeri.index')" :active="request()->routeIs('galeri')">
                {{ __('Galeri') }}
            </x-responsive-nav-link>
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-700">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
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
            <div class="pt-4 pb-1 border-t border-gray-700 px-4 space-y-2">
                <a href="{{ route('login') }}"
                    class="block text-sm text-white underline hover:text-blue-300">
                    Log in
                </a>
            </div>
        @endauth
    </div>
</nav>

<script>
    const input = document.getElementById('searchInput');
    const resultsDiv = document.getElementById('searchResults');

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

    input.addEventListener('input', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            searchContent(false);
        }, debounceTime);
    });

    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(typingTimer);
            searchContent(true);
        }
    });

    document.addEventListener('click', function (e) {
        if (!input.contains(e.target) && !resultsDiv.contains(e.target)) {
            resultsDiv.classList.add('hidden');
        }
    });
</script>
