<footer class="bg-stone-800 pt-32 px-10 lg:px-32 text-white">

    <div class="w-full lg:w-1/2 mx-auto flex flex-col lg:flex-row gap-12 justify-center items-center">

        <!-- logo mz et christie's -->
        <div class="w-fit flex flex-col">
            <!-- logo mz -->
            <a class="mx-auto" href="{{ route('home') }}">
                <img data-aos="fade-down"
                     data-aos-offset="-500"
                     data-aos-delay="50"
                     data-aos-duration="1000"
                     data-aos-easing="ease-in-out"
                     data-aos-mirror="true"
                     data-aos-once="false"
                     data-aos-anchor-placement="top-center"
                     class="w-48 " src="{{ asset('images/logo-vineyards-rouge.svg') }}" alt="logo Vineyards" />
            </a>
            <!-- logo christie's -->
            <img data-aos="fade-up"
                 data-aos-offset="-500"
                 data-aos-delay="50"
                 data-aos-duration="500"
                 data-aos-easing="ease-in-out"
                 data-aos-mirror="true"
                 data-aos-once="false"
                 data-aos-anchor-placement="top-center"
                 class="mx-auto w-48 z-50 bottom-4 pt-10" src="{{ asset('images/cire_logo.svg') }}" alt="logo christie's international real estate">
        </div>
        <!-- end logo mz et christie's -->

        <!-- lien listes regions viticole -->
        <div class="w-full lg:w-1/3">
            <h2 class="text-sm lg:text-base font-bold uppercase">{{ __('home.footer_region') }}</h2>
            <ul class="flex flex-wrap list-inside py-4 gap-4">
            @foreach($allListesSeo as $listeseo)
                <li>
                    <a href="{{ route('properties.region', ['listeseo' => $listeseo, 'slug' => $listeseo->slug]) }}" title="{{ $listeseo->translate->header_h1 }}">{{ $listeseo->name }}</a>
                </li>
                @if(! $loop->last)<li> - </li>@endif
            @endforeach
            </ul>
        </div>
    </div>

    <!-- social networks -->
    <div class="grid grid-cols-4 justify-items-center gap-16 lg:w-1/4 justify-between mx-auto py-8">

        <a href="{{ config('socials.linkedin') }}" target="_blank" rel="noreferrer noopener" class="text-xl">
            <x-fab-linkedin class="h-12 hover:scale-110"/>
        </a>

        <a href="{{ config('socials.instagram') }}" target="_blank" rel="noreferrer noopener" class="text-xl">
            <x-fab-instagram class="h-12 hover:scale-110"/>
        </a>

        <a href="{{ config('socials.youtube') }}" target="_blank" rel="noreferrer noopener" class="text-xl">
            <x-fab-youtube  class="h-12 hover:scale-110"/>
        </a>

        <a href="{{ config('socials.facebook') }}" target="_blank" rel="noreferrer noopener" class="text-xl">
            <x-fab-facebook class="h-12 hover:scale-110"/>
        </a>

    </div>

    <!-- brand -->
    <div class="mx-auto w-fit text-sm p-3 uppercase">

        <div class="flex flex-col lg:flex-row text-center text-xs">
            <span>Michaël Zingraf Vineyards</span>
            <span class="hidden lg:block">&nbsp;-&nbsp;</span>
            <span>{{ __('home.footer_brand') }} ©{{ date('Y') }}</span>
        </div>

    </div>

</footer>
