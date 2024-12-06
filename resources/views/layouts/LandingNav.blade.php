<nav class="bg-white dark:bg-gray-800 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
        <div class="flex items-center justify-between">

            <div class="flex items-center space-x-8">
                <div class="shrink-0">
                    <a href="#" title="" class="">
                        <img class="block w-auto h-8" src="images/logo.png" alt="">
                    </a>
                </div>

                <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
                    <li>
                        <a href="/" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Home
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="/shop" title=""
                            class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Shop
                        </a>
                    </li>
                    <li class="shrink-0">
                        <a href="/category" title=""
                            class="text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Category
                        </a>
                    </li>
                    <li id="page" data-dropdown-toggle="pages" class="items-center inline-flex justify-center">
                        <a href="#" title=""
                            class="text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            Pages
                        </a>
                        <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1 cursor-pointer" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>
                    </li>
                </ul>
                <div id="pages"
                    class="hidden z-50 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
                    <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                        <li><a href="/about" title=""
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                About</a></li>
                        <li><a href="/contact" title=""
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                Contact </a></li>
                        <li><a href="/privacy-policy" title=""
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                Privacy Policy </a></li>
                        <li><a href="/terms-and-conditions" title=""
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                Terms and Conditions </a></li>
                    </ul>
                </div>
            </div>

            <div class="flex items-center lg:space-x-2">
                <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button"
                    class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                    <span class="sr-only">
                        Cart
                    </span>
                    <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                    </svg>
                    <span class="hidden sm:flex">
                        <a href="/shopping-cart">My Cart</a>
                    </span>
                    <span id="cartItemCount"
                        class="hidden bg-red-600 text-white rounded-full text-xs font-bold w-5 h-5 flex items-center justify-center ms-2">0</span>
                </button>



                <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button"
                    class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                    <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    @if (Auth::user())
                        {{ Auth::user()->name }}
                    @endif
                    <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <div id="userDropdown1"
                    class="hidden z-50 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">

                    @guest
                        <!-- Jika pengguna belum login -->
                        <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                            <li>
                                <a href="{{ route('login') }}"
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Login
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}"
                                        class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                        Register
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @else
                        <!-- Jika pengguna sudah login -->
                        <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                            <li>
                                <a href="{{ route('panel.dashboard.index') }}"
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                {{-- <a href="{{ route('transactions') }}"
                                    class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Transaksi
                                </a> --}}
                            </li>
                        </ul>

                        <div class="p-2 text-sm font-medium text-gray-900 dark:text-white">
                            <a href="{{ route('logout') }}"
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"
                                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </div>



                <button type="button" data-collapse-toggle="ecommerce-navbar-menu-1"
                    aria-controls="ecommerce-navbar-menu-1" aria-expanded="false"
                    class="inline-flex lg:hidden items-center justify-center hover:bg-gray-100 rounded-md dark:hover:bg-gray-700 p-2 text-gray-900 dark:text-white">
                    <span class="sr-only">
                        Open Menu
                    </span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="ecommerce-navbar-menu-1"
            class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 border border-gray-200 rounded-lg py-3 hidden px-4 mt-4">
            <ul class="text-gray-900 dark:text-white text-sm font-medium dark:text-white space-y-3">
                <li>
                    <a href="/" class="hover:text-primary-700 dark:hover:text-primary-500">Home</a>
                </li>
                <li>
                    <a href="/shop" class="hover:text-primary-700 dark:hover:text-primary-500">Shop</a>
                </li>
                <li>
                    <a href="/about" class="hover:text-primary-700 dark:hover:text-primary-500">About</a>
                </li>
                <li>
                    <a href="/contact" class="hover:text-primary-700 dark:hover:text-primary-500">Contact</a>
                </li>
                <li>
                    <a href="/privacy-policy" class="hover:text-primary-700 dark:hover:text-primary-500">Privacy
                        Policy</a>
                </li>
                <li>
                    <a href="/terms-and-conditions" class="hover:text-primary-700 dark:hover:text-primary-500">Terms &
                        Conditions</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
