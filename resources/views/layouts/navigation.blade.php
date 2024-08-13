<x-top-nav />

<nav x-data="{ open: false }" class="bg-white py-5">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('image/main-logo.jpg') }}" class="h-16 rounded-full" alt="petso Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">PetSo</span>
        </a>
        <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
            <div class="flex gap-4 pr-5 items-center">
                <a href="/pages/shops/shop" class="text-lg font-medium">
                    Shop
                </a>
                <a href="/pages/favoritePage">
                    <i class="fa-solid fa-heart text-lg hover:text-[#115542]"></i>
                </a>
                <a href="/cart">
                    <i class="fa-solid fa-cart-plus text-lg hover:text-[#115542]"></i>
                    <sup class="text-lg text-red-900 font-bold">+1</sup>
                </a>
            </div>
            @if (Route::has('login'))
                @auth
                    <button type="button" data-dropdown-toggle="language-dropdown-menu"
                        class="flex flex-col items-center font-medium justify-center px-4 py-2 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer dark:hover:bg-gray-700 dark:hover:text-white">
                        <i class="fa-regular fa-user text-lg"></i>
                        <div>{{ Auth::user()->name }}</div>
                    </button>
                    <!-- Dropdown -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700" id="language-dropdown-menu">
                        @if(Auth::check())
                            @if(Auth::user()->hasRole('Admin'))
                                <ul class="py-2 font-medium" role="none">
                                    <li>
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                    </li>
                                    <li>
                                        <x-dropdown-link :href="route('overview')">
                                            {{ __('Dashborad') }}
                                        </x-dropdown-link>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <ul class="py-2 font-medium" role="none">
                                    <li>
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                
                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </li>
                                </ul>
                            @endif
                        @endif
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Register
                        </a>
                    @endif
                @endauth
            @endif

            <button data-collapse-toggle="navbar-language" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-language" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
       {{-- search --}}
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-language">
            <div class="w-[500px]">
                <form action="{{ route('products.search') }}" method="GET">   
                    <label for="search" class="mb-2 text-ml font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" name="query" id="search" class="block w-full py-2 ps-10 text-ml text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Find anything here..." required />
                        <button type="submit" class="text-white absolute end-0 bottom-0 top-0 bg-[#115542] hover:bg-[#32836c] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-r-full text-ml px-4">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>
