<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <div class="navbar-brand m-0">
            <div class="d-flex align-items-center">
                <i class="material-icons text-white me-2">local_cafe</i>
                <span class="font-weight-bold text-white">Coffee Panel</span>
            </div>
        </div>
    </div>

    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {{-- Dashboard --}}
            @if(auth()->user()->hasAnyRole(['admin', 'pegawai', 'owner','pelanggan']))
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.dashboard.*') ? 'active bg-gradient-primary' : '' }}"
                        href="{{ route('panel.dashboard.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endif
            {{-- Master Data --}}
            @if(auth()->user()->hasAnyRole(['admin', 'owner']))
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Master Data</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.category.*') ? 'active bg-gradient-primary' : '' }}"
                        href="{{ route('panel.category.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">category</i>
                        </div>
                        <span class="nav-link-text ms-1">Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.product.*') ? 'active bg-gradient-primary' : '' }}"
                        href="{{ route('panel.product.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">restaurant_menu</i>
                        </div>
                        <span class="nav-link-text ms-1">Products (Menu)</span>
                    </a>
                </li>
            @endif

            @if(auth()->user()->hasAnyRole(['admin', 'pegawai', 'owner']))
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Inventory</h6>
                </li>
                @if(auth()->user()->hasRole('pegawai') || auth()->user()->hasRole('owner'))
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('panel.raw-material.*') ? 'active bg-gradient-primary' : '' }}"
                            href="{{ route('panel.raw-material.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">inventory</i>
                            </div>
                            <span class="nav-link-text ms-1">Raw Materials</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner'))
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('panel.chef.*') ? 'active bg-gradient-primary' : '' }}"
                            href="{{ route('panel.chef.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <span class="nav-link-text ms-1">Chefs</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('panel.event.*') ? 'active bg-gradient-primary' : '' }}"
                            href="{{ route('panel.event.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">event</i>
                            </div>
                            <span class="nav-link-text ms-1">Events</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('panel.tax.*') ? 'active bg-gradient-primary' : '' }}"
                            href="{{ route('panel.tax.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">receipt</i>
                            </div>
                            <span class="nav-link-text ms-1">Taxes</span>
                        </a>
                    </li>
                @endif
            @endif

            {{-- Transaction Management --}}
            @if(auth()->user()->hasAnyRole(['admin', 'owner']))
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Transactions</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.order.*') ? 'active bg-gradient-primary' : '' }}"
                        href="{{ route('panel.order.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">shopping_cart</i>
                        </div>
                        <span class="nav-link-text ms-1">Orders</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.selling.*') ? 'active bg-gradient-primary' : '' }}"
                        href="{{ route('panel.selling.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">point_of_sale</i>
                        </div>
                        <span class="nav-link-text ms-1">Sales History</span>
                    </a>
                </li>
            @endif
            {{-- Inventory Management --}}
            @if(auth()->user()->hasAnyRole(['pegawai', 'owner']))
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Inventory</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.raw-material-stock.*') ? 'active bg-gradient-primary' : '' }}"
                        href="{{ route('panel.raw-material-stock.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">inventory_2</i>
                        </div>
                        <span class="nav-link-text ms-1">Stock Management</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.raw-material-usage.*') ? 'active bg-gradient-primary' : '' }}"
                        href="{{ route('panel.raw-material-usage.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">assignment</i>
                        </div>
                        <span class="nav-link-text ms-1">Usage Tracking</span>
                    </a>
                </li>
            @endif

            {{-- Forecasting --}}
            @if(auth()->user()->hasAnyRole(['pegawai', 'owner']))
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Forecasting</h6>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.forecasting.*') ? 'active bg-gradient-primary' : '' }}"
                        href="{{ route('panel.forecasting.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">analytics</i>
                        </div>
                        <span class="nav-link-text ms-1">Material Forecasting</span>
                    </a>
                </li>
            @endif
            {{-- Reports Section in Sidebar --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Reports</h6>
            </li>

            {{-- Sales Reports --}}
            @if(auth()->user()->hasAnyRole(['admin', 'owner']))
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.report.sales.*') ? 'active bg-gradient-primary' : '' }}"
                        data-bs-toggle="collapse" href="#salesReportCollapse" role="button"
                        aria-expanded="{{ request()->routeIs('panel.report.sales.*') ? 'true' : 'false' }}"
                        aria-controls="salesReportCollapse">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">summarize</i>
                        </div>
                        <span class="nav-link-text ms-1">Sales Report</span>
                    </a>
                    <div class="collapse {{ request()->routeIs('panel.report.sales.*') ? 'show' : '' }}" id="salesReportCollapse">
                        <ul class="nav ms-4">
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('panel.report.sales.index') ? 'active' : '' }}"
                                    href="{{ route('panel.report.sales.index') }}">
                                    <span class="nav-link-text ms-1">Summary</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('panel.report.sales.daily') ? 'active' : '' }}"
                                    href="{{ route('panel.report.sales.daily') }}">
                                    <span class="nav-link-text ms-1">Daily</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('panel.report.sales.monthly') ? 'active' : '' }}"
                                    href="{{ route('panel.report.sales.monthly') }}">
                                    <span class="nav-link-text ms-1">Monthly</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('panel.report.sales.yearly') ? 'active' : '' }}"
                                    href="{{ route('panel.report.sales.yearly') }}">
                                    <span class="nav-link-text ms-1">Yearly</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            {{-- Inventory Reports --}}
            @if(auth()->user()->hasAnyRole(['pegawai', 'owner']))
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.report.inventory.*') ? 'active bg-gradient-primary' : '' }}"
                        data-bs-toggle="collapse" href="#inventoryReportCollapse" role="button"
                        aria-expanded="{{ request()->routeIs('panel.report.inventory.*') ? 'true' : 'false' }}"
                        aria-controls="inventoryReportCollapse">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">inventory</i>
                        </div>
                        <span class="nav-link-text ms-1">Inventory Report</span>
                    </a>
                    <div class="collapse {{ request()->routeIs('panel.report.inventory.*') ? 'show' : '' }}" id="inventoryReportCollapse">
                        <ul class="nav ms-4">
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('panel.report.inventory.index') ? 'active' : '' }}"
                                    href="{{ route('panel.report.inventory.index') }}">
                                    <span class="nav-link-text ms-1">Summary</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('panel.report.inventory.stock') ? 'active' : '' }}"
                                    href="{{ route('panel.report.inventory.stock') }}">
                                    <span class="nav-link-text ms-1">Stock Movement</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('panel.report.inventory.usage') ? 'active' : '' }}"
                                    href="{{ route('panel.report.inventory.usage') }}">
                                    <span class="nav-link-text ms-1">Material Usage</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            {{-- Customer Reports --}}
            @if(auth()->user()->hasAnyRole(['pegawai', 'owner','admin']))
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('panel.report.customers.*') ? 'active bg-gradient-primary' : '' }}"
                        data-bs-toggle="collapse" href="#customersReportCollapse" role="button"
                        aria-expanded="{{ request()->routeIs('panel.report.customers.*') ? 'true' : 'false' }}"
                        aria-controls="customersReportCollapse">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">people</i>
                        </div>
                        <span class="nav-link-text ms-1">Customer Report</span>
                    </a>
                    <div class="collapse {{ request()->routeIs('panel.report.customers.*') ? 'show' : '' }}" id="customersReportCollapse">
                        <ul class="nav ms-4">
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('panel.report.customers.index') ? 'active' : '' }}"
                                    href="{{ route('panel.report.customers.index') }}">
                                    <span class="nav-link-text ms-1">Summary</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('panel.report.customers.orders') ? 'active' : '' }}"
                                    href="{{ route('panel.report.customers.orders') }}">
                                    <span class="nav-link-text ms-1">Order History</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ request()->routeIs('panel.report.customers.behavior') ? 'active' : '' }}"
                                    href="{{ route('panel.report.customers.behavior') }}">
                                    <span class="nav-link-text ms-1">Customer Behavior</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            {{-- Settings --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Settings</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('panel.user.*') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('panel.user.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <span class="nav-link-text ms-1">User Management</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn bg-gradient-primary mt-2 w-100" href="/" type="button">
                <i class="material-icons me-2">home</i>Beranda
            </a>
            <a class="btn bg-gradient-primary mt-2 w-100" href="{{ route('logout') }}" type="button"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="material-icons me-2">logout</i>Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</aside>
