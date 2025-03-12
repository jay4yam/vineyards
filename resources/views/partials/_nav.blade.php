<nav class="absolute top-0 bg-white md:bg-transparent w-full z-50 drop-shadow-2xl text-white text-shadow font-eurostile">

    <!-- menu responsive -->
    <div x-data="{ open: false }" class="sticky top-0 md:hidden flex justify-between p-4">

        <!-- logo -->
        <img class="h-12" src="{{ asset('images/logo-vineyards-rouge.svg') }}" alt="logo vineyards">

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
                        @foreach( config('app.available_locales') as $lang)
                            <li class="w-full">
                                <a  href="{{ route('change.locale', ['lang' => $lang]) }}"
                                    class="flex justify-center items-center gap-2 text-center px-4 py-2 text-gray-800 hover:bg-red-800 hover:text-white">
                                    <img class="h-4" src="{{ asset('images/flag_'.$lang.'.webp') }}" alt=""><span>{{ $lang }}</span>
                                </a>
                            </li>
                        @endforeach
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
    <div class="hidden md:flex mx-auto p-0 md:p-4">
        <!-- menu -->
        <ul class="mx-auto flex gap-12 font-black text-2xl">
            <li><a href="{{ route('properties.index') }}">{{ __('menu.properties') }}</a></li>
            <li><a href="{{ route('blog.index') }}">{{ __('menu.blog') }}</a></li>
            <li><a href="">{{ __('menu.partners') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('menu.contact') }}</a></li>
        </ul>
        <!-- end menu -->

        <!-- menu user -->
        <div class="absolute right-4 flex gap-6">
            <ul class="flex gap-3">
                @if(auth()->check())
                    <li><a href="#">Admin</a></li>
                @else
                    <li><a href="{{ route('login') }}">{{ __('menu.login') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ __('menu.register') }}</a></li>
                @endif
            </ul>
            <!-- end menu user -->

            <!-- menu lang -->
            <ul class="flex gap-2">
                <li class="group relative">
                    <a href="#">{{ app()->getLocale() }}</a>
                    <ul class="hidden group-hover:block absolute">
                        @foreach( config('app.available_locales') as $lang)
                            @if($lang != app()->getLocale())
                                <li><a href="{{ route('change.locale', ['lang' => $lang]) }}">{{ $lang }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
            <!-- end menu user -->
        </div>
        <!-- end menu user -->
    </div>

</nav>
