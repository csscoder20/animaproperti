<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <img class="rounded"
                src="{{ $settings['logo'] ? asset('storage/' . $settings['logo']) : asset('themes/frontend/assets/img/android-chrome-512x512.png') }}"
                alt="Logo">
            <h1 class="sitename">{{ $settings['site_name'] ?? 'ANIMA PROPERTI' }}</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ url('/tentang-kami') }}"
                        class="{{ Request::is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
                <li><a href="{{ url('/properti') }}" class="{{ Request::is('properti*') ? 'active' : '' }}">Properti</a>
                </li>

                <li
                    class="dropdown 
                    {{ Request::is('kontak-agen') ||
                    Request::is('formulir-registrasi-agen') ||
                    Request::is('agen') ||
                    Request::is('agen/*')
                        ? 'active'
                        : '' }}">
                    <a href="#"><span>Agen</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li>
                            <a href="{{ url('/kontak-agen') }}"
                                class="{{ Request::is('kontak-agen') || Request::is('agen') || Request::is('agen/*') ? 'active' : '' }}">
                                Kontak Agen
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/formulir-registrasi-agen') }}"
                                class="{{ Request::is('formulir-registrasi-agen') ? 'active' : '' }}">
                                Registrasi Agen
                            </a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ url('/kontak-kami') }}"
                        class="{{ Request::is('kontak-kami') ? 'active' : '' }}">Kontak</a>
                </li>
                <li>
                    <a href="{{ url('/berita') }}"
                        class="{{ Request::is('berita') || Request::is('berita/*') ? 'active' : '' }}">
                        Berita
                    </a>
                </li>
                <!-- Tombol WA untuk layar >= 1200px (xl ke atas) -->
                <li class="d-none d-xl-block">
                    <a class="waMe btn btn-success px-3 py-2 rounded-pill"
                        href="https://wa.me/{{ $settings['no_hp'] ?? '' }}" target="_blank" rel="noopener">
                        <i class="bi bi-whatsapp mx-2"></i> Titip Jual Properti
                    </a>
                </li>

                <!-- Teks biasa untuk layar < 1200px -->
                <li class="d-block d-xl-none">
                    <a href="https://wa.me/{{ $settings['no_hp'] ?? '' }}" target="_blank" rel="noopener">
                        Titip Jual Properti
                    </a>
                </li>

            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


    </div>
</header>
