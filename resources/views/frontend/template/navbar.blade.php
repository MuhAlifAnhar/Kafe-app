<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid nav-bar">
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-lg py-4">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <h1 class="text-primary fw-bold mb-0">Payakum<span class="text-dark">buah</span> </h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                        <a href="{{ route('frontend.about') }}" class="nav-item nav-link {{ request()->routeIs('frontend.about') ? 'active' : '' }}">Tentang Kami</a>
                        <a href="{{ route('frontend.service') }}" class="nav-item nav-link {{ request()->routeIs('frontend.service') ? 'active' : '' }}">Layanan</a>
                        <a href="{{ route('frontend.event') }}" class="nav-item nav-link {{ request()->routeIs('frontend.event') ? 'active' : '' }}">Acara</a>
                        <a href="{{ route('frontend.menu') }}" class="nav-item nav-link {{ request()->routeIs('frontend.menu') ? 'active' : '' }}">Menu</a>
                        <a href="{{ route('frontend.blog') }}" class="nav-item nav-link {{ request()->routeIs('frontend.blog') ? 'active' : '' }}">Blog</a>
                        <a href="{{ route('frontend.contact') }}" class="nav-item nav-link {{ request()->routeIs('frontend.contact') ? 'active' : '' }}">Hubungi</a>
                    </div>
                    <button class="btn-search btn btn-primary btn-md-square me-4 rounded-circle d-none d-lg-inline-flex"
                        data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button>
                    <a href="" class="btn btn-primary py-2 px-4 d-none d-xl-inline-block rounded-pill">Pesan Sekarang</a>
                </div>
            </nav>
        </div>
    </div>
</header>
