<nav class="sticky top-0 bg-white w-full z-50 font-eurostile text-gray-500 drop-shadow">

    <!-- menu responsive -->
    <div x-data="{ open: false }" class="sticky top-0 md:hidden flex justify-between p-4">

        <!-- logo -->
        <a href="{{ route('home') }}">
            <img class="h-12" src="{{ asset('images/logo_main_nav_mzvineyards.png') }}" alt="logo vineyards">
        </a>

        <!-- container du menu -->
        <div :class="{'block': open, 'hidden': !open}">

            <!-- menu principale -->
            <ul class="absolute top-[80px] right-0 w-full bg-white md:hidden">
                <li>
                    <a href="{{ route('home') }}"
                       class="block px-4 py-2 text-gray-800 hover:bg-red-800 hover:text-white">{{ __('menu.home') }}</a>
                </li>
                <li>
                    <a href="{{ route('properties.index') }}"
                       class="block px-4 py-2 text-gray-800 hover:bg-red-800 hover:text-white">{{ __('menu.properties') }}</a>
                </li>
                <li>
                    <a href="{{ route('blog.index') }}"
                       class="block px-4 py-2 text-gray-800 hover:bg-red-800 hover:text-white">{{ __('menu.blog') }}</a>
                </li>
                <li>
                    <a href="#"
                       class="block px-4 py-2 text-gray-800 hover:bg-red-800 hover:text-white">{{ __('menu.partners') }}</a>
                </li>
                <li>
                    <a href="#"
                       class="block px-4 py-2 text-gray-800 hover:bg-red-800 hover:text-white">À propos</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                       class="block px-4 py-2 text-gray-800 hover:bg-red-800 hover:text-white">{{ __('menu.contact') }}</a>
                </li>
                <li><div class="border border-red-800"></div></li>
                <li>
                    <!-- menu user -->
                    <ul class="flex gap-3 w-full">
                            @if(auth()->check())
                                <li class="w-full">
                                    <a href="#"
                                       class="text-center block px-4 py-2 text-gray-800 hover:bg-red-800 hover:text-white">Admin</a>
                                </li>
                            @else
                                <li class="w-full">
                                    <a href="{{ route('login') }}"
                                       class="text-center block px-4 py-2 text-gray-800 hover:bg-red-800 hover:text-white">{{ __('menu.login') }}</a>
                                </li>
                                <li class="w-full">
                                    <a href="{{ route('register') }}"
                                       class="text-center block px-4 py-2 text-gray-800 hover:bg-red-800 hover:text-white">{{ __('menu.register') }}</a>
                                </li>
                            @endif
                        </ul>
                    <!-- end menu user -->
                </li>
                <li><div class="border border-red-800"></div></li>
                <li>
                    <!-- menu lang -->
                    <ul class="flex gap-2 w-full">
                        <!-- menu lang -->
                        @include('partials._langage', ['seoData' => $seoData])
                        <!-- menu lang -->
                    </ul>
                    <!-- end menu user -->
                </li>
            </ul>

        </div>

        <button @click="open = !open" class="md:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="gray" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    <!-- menu md | lg | xl -->
    <div class="hidden md:flex mx-auto items-center p-0 md:px-6 md:py-2">

        <!-- logo -->
        <a href="{{ route('home') }}">
            <img class="h-12" src="{{ asset('images/logo_main_nav_mzvineyards.png') }}" alt="logo vineyards">
        </a>

        <!-- menu -->
        <ul class="mx-auto flex gap-12 text-2xl">
            <li>
                <x-main-nav-link :href="route('properties.index')" :active="request()->routeIs('properties.index')">
                    {{ __('menu.properties') }}
                </x-main-nav-link>
            </li>
            <li>
                <x-main-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.index')">
                    {{ __('menu.blog') }}
                </x-main-nav-link>
            </li>
            <li>
                <x-main-nav-link :href="route('blog.index')" :active="request()->routeIs('blog.index')">
                    {{ __('menu.about') }}
                </x-main-nav-link>
            </li>
            <li>
                <x-main-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                    {{ __('menu.contact') }}
                </x-main-nav-link>
            </li>
        </ul>
        <!-- end menu -->

        <!-- menu user -->
        <div class="flex gap-6">
            <ul class="flex items-center gap-3">
                @if(auth()->check())
                    <li><a href="{{ route('back.home') }}">Dashboard</a></li>
                @else
                    <li><a class="hover:text-red-800" href="{{ route('login') }}">{{ __('menu.login') }}</a></li>
                    <li><a class="hover:text-red-800" href="{{ route('register') }}">{{ __('menu.register') }}</a></li>
                    <li class="w-6">
                        <!-- menu lang -->
                        @include('partials._langage', ['seoData' => $seoData])
                        <!-- menu lang -->
                    </li>
                @endif
            </ul>
            <!-- end menu user -->


        </div>
        <!-- end menu user -->
    </div>
</nav>
