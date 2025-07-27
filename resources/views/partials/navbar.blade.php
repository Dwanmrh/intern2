<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container-fluid px-4">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('assets/images/LOGO_SECAPA.png') }}" alt="Logo" width="50" height="45" class="me-2" />
      <span class="fw-bold text-white">SETUKPA LEMDIKLAT POLRI</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ $active == 'home' ? 'active' : '' }}" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $active == 'profil' ? 'active' : '' }}" href="/profil">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $active == 'berita' ? 'active' : '' }}" href="/berita">Berita</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $active == 'informasi' ? 'active' : '' }}" href="/informasi">Informasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $active == 'galeri' ? 'active' : '' }}" href="/galeri">Galeri</a>
        </li>

        {{-- Dropdown Media Sosial --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Media Sosial
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="https://www.instagram.com/lemdiklatpolri.id/" target="_blank">Instagram Lemdiklat</a>
            </li>
            <li>
              <a class="dropdown-item" href="https://www.instagram.com/humas_setukpa/" target="_blank">Instagram Setukpa</a>
            </li>
          </ul>
        </li>

        {{-- Dropdown Kontak --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Kontak
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="https://www.instagram.com/humas_setukpa/">Instagram Setukpa</a>
            </li>
          </ul>
        </li>

        {{-- Dropdown Link --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Link
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="https://lemdiklat.polri.go.id/" target="_blank">Big Data Lemdiklat Polri</a>
            </li>
            <li>
              <a class="dropdown-item" href="https://lemdiklat.polri.go.id/web/" target="_blank">Web Lemdiklat Polri</a>
            </li>
            <li>
              <a class="dropdown-item" href="#" target="_blank">Web SIPLS</a>
            </li>
            <li>
              <a class="dropdown-item" href="#" target="_blank">E-Library Lemdiklat Polri</a>
            </li>
            <li>
              <a class="dropdown-item" href="#" target="_blank">Smart Class</a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ $active == 'login' ? 'active' : '' }}" href="/login">Login</a>
        </li>

        {{-- <li class="nav-item">
          <a class="nav-link {{ $active == 'sipls' ? 'active' : '' }}" href="/sipls">SIPLS</a>
        </li> --}}
      </ul>
    </div>
  </div>
</nav>
