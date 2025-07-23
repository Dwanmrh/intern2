@php
  $currentRoute = Route::currentRouteName();

  $siplSubmenus = ['sipls', 'data-siswa', 'naa', 'mapel', 'gladi', 'kartul', 'latnis', 'nmk', 'nimat', 'niman', 'nisos'];
  $naaSubmenus = ['naa', 'mapel', 'gladi', 'kartul', 'latnis'];
  $nmkSubmenus = ['nmk', 'nimat', 'niman', 'nisos'];

  $siplActive = in_array($currentRoute, $siplSubmenus) ? 'active' : '';
  $naaExpanded = in_array($currentRoute, $naaSubmenus);
  $nmkExpanded = in_array($currentRoute, $nmkSubmenus);
@endphp

<div class="sidebar {{ $siplActive }}">
  {{-- DATA SISWA --}}
  <a href="{{ url('/data-siswa') }}" class="{{ request()->is('data-siswa') ? 'active' : '' }}">
    <i class="fas fa-users me-2"></i> Data Siswa
  </a>

{{-- NAP --}}
  <a href="{{ url('/nap') }}" class="{{ $currentRoute === 'nap' ? 'active' : '' }}">
    <i class="fas fa-clipboard me-2"></i> Nilai Akhir Pendidikan & Nilai Ranking (NAP & NR)
  </a>

  {{-- NILAI RANKING --}}
  <a href="{{ url('/ranking') }}" class="{{ request()->is('ranking') ? 'active' : '' }}">
    <i class="fas fa-trophy me-2"></i> Nilai Ranking (NR)
  </a>

  {{-- NILAI AKADEMIK SUBMENU --}}
  <div class="submenu-toggle {{ $naaExpanded ? 'active' : '' }}">
    <a href="#" class="has-submenu">
      <i class="fas fa-chart-line me-2"></i> Nilai Akademik (NAA)
    </a>
    <div class="submenu" style="display: {{ $naaExpanded ? 'block' : 'none' }};">
      <a href="{{ url('/naa') }}" class="{{ $currentRoute === 'naa' ? 'active' : '' }}">NILAI AKADEMIK</a>
      <a href="{{ url('/mapel') }}" class="{{ $currentRoute === 'mapel' ? 'active' : '' }}">NILAI MAPEL</a>
      <a href="{{ url('/gladi') }}" class="{{ $currentRoute === 'gladi' ? 'active' : '' }}">NILAI GLADI</a>
      <a href="{{ url('/kartul') }}" class="{{ $currentRoute === 'kartul' ? 'active' : '' }}">NILAI KARTUL</a>
      <a href="{{ url('/latnis') }}" class="{{ $currentRoute === 'latnis' ? 'active' : '' }}">NILAI LATNIS</a>
    </div>
  </div>

  {{-- NILAI MENTAL SUBMENU --}}
  <div class="submenu-toggle {{ $nmkExpanded ? 'active' : '' }}">
    <a href="#" class="has-submenu">
      <i class="fas fa-brain me-2"></i> Nilai Mental (NAMK)
    </a>
    <div class="submenu" style="display: {{ $nmkExpanded ? 'block' : 'none' }};">
      <a href="{{ url('/nmk') }}" class="{{ $currentRoute === 'nmk' ? 'active' : '' }}">NILAI MENTAL</a>
      <a href="{{ url('/nimat') }}" class="{{ $currentRoute === 'nimat' ? 'active' : '' }}">NIMAT</a>
      <a href="{{ url('/niman') }}" class="{{ $currentRoute === 'niman' ? 'active' : '' }}">NIMAN</a>
      <a href="{{ url('/nisos') }}" class="{{ $currentRoute === 'nisos' ? 'active' : '' }}">NISOS</a>
    </div>
  </div>

  {{-- NAKKJ --}}
  <a href="{{ url('/nkkj') }}" class="{{ $currentRoute === 'nkkj' ? 'active' : '' }}">
    <i class="fas fa-dumbbell me-2"></i> Nilai Kesjas (NAKKJ)
  </a>

  {{-- DATA GADIK --}}
  <a href="{{ url('/data-gadik') }}" class="{{ $currentRoute === 'data-gadik' ? 'active' : '' }}">
    <i class="fas fa-chalkboard-teacher me-2"></i> Data Gadik
  </a>

  {{-- DATA PENGASUH --}}
  <a href="{{ url('/data-pengasuh') }}" class="{{ $currentRoute === 'data-pengasuh' ? 'active' : '' }}">
    <i class="fas fa-user-shield me-2"></i> Data Pengasuh
  </a>
</div>

{{-- Submenu Toggle Script --}}
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const submenuToggles = document.querySelectorAll(".submenu-toggle > a.has-submenu");

    submenuToggles.forEach(toggle => {
      toggle.addEventListener("click", e => {
        e.preventDefault();
        const parent = toggle.parentElement;
        parent.classList.toggle("active");

        const submenu = parent.querySelector(".submenu");
        if (submenu) {
          submenu.style.display = submenu.style.display === "block" ? "none" : "block";
        }
      });
    });
  });
</script>
