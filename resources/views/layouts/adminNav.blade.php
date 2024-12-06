<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
        </nav>

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fas fa-layer-group"></i>
                </a>
                <div class="dropdown-menu quick-actions animated fadeIn">
                    <div class="quick-actions-header">
                        <span class="title mb-1">Quick Actions</span>
                        <span class="subtitle op-7">Shortcuts</span>
                    </div>
                    <div class="quick-actions-scroll scrollbar-outer">
                        <div class="quick-actions-items">
                            <div class="row m-0">
                                <a class="col-6 col-md-4 p-0" href="#">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-success rounded-circle">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <span class="text">Emails</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="#">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-primary rounded-circle">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </div>
                                        <span class="text">Invoice</span>
                                    </div>
                                </a>
                                <a class="col-6 col-md-4 p-0" href="#">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-secondary rounded-circle">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <span class="text">Payments</span>
                                    </div>
                                </a>
                                <!-- New Order Status Item -->
                                <a class="col-6 col-md-4 p-0" href="{{ route('order_status.index') }}">
                                    <div class="quick-actions-item">
                                        <div class="avatar-item bg-warning rounded-circle">
                                            <i class="fas fa-truck"></i>
                                        </div>
                                        <span class="text">Order Status</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        @if (Auth::user()->profile_image)
                            <img src="{{ asset('storage/images/' . Auth::user()->profile_image) }}" alt="image profile"
                                class="avatar-img rounded" />
                        @else
                            <!-- Jika tidak, gunakan gambar default -->
                            <img src="/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
                        @endif
                    </div>
                    <span class="profile-username">
                        <span class="op-7">Hi,</span>
                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <!-- Cek apakah pengguna memiliki gambar profil -->
                                    @if (Auth::user()->profile_image)
                                        <img src="{{ asset('storage/images/' . Auth::user()->profile_image) }}"
                                            alt="image profile" class="avatar-img rounded" />
                                    @else
                                        <!-- Jika tidak, gunakan gambar default -->
                                        <img src="/assets/img/profile.jpg" alt="image profile"
                                            class="avatar-img rounded" />
                                    @endif
                                </div>
                                <div class="u-text">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <a href="{{ route('users.show', Auth::user()->id) }}"
                                        class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">My
                                Profile</a>
                        </li>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">Logout</a>
                        </form>
            </li>
    </div>
    </ul>
    </li>
    </ul>
    </div>
</nav>
<!-- End Navbar -->
