<x-front-layout :seoData="$seoData">

@section('dedicated_css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
@endsection

    <header class="relative flex items-center justify-center h-24 lg:h-96 w-full" style="background: center/cover fixed url('{{ asset('images/bg-listing.webp') }}');">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 drop-shadow">
            <span class="font-retro text-7xl text-white text-shadow">
                {{ __('menu.contact') }}
            </span>
        </div>
    </header>

    <!-- section form -->
    <section class="container mx-auto w-full lg:w-3/4 px-6 pt-4 lg:pt-16 font-eurostile">

        <div class="flex flex-col lg:flex-row gap-2">

            <!-- form -->
            <form action="{{ route('contact.form.submit') }}" method="post" class="w-full lg:w-8/12">
                @csrf
                @method('post')
                <input type="hidden" name="ip_address" value="{{ request()->getClientIp() }}">
                <input type="hidden" name="sources" value="form_contact">

                <h1 class="text-center text-red-800 text-3xl uppercase">{{ __('contact.getintouch') }}</h1>

                @if(! session()->has('form_contact_success'))
                    <p class="text-justify text-gray-500 py-12">{{ __('contact.content') }}</p>
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('form.name')" class="text-gray-700"/>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    <!-- phone -->
                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('form.phone')" class="text-gray-700"/>
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required/>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('form.email')" class="text-gray-700"/>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <!-- Message -->
                    <div class="mt-4">
                        <x-input-label for="message" :value="__('form.message')" class="text-gray-700"/>
                        <x-text-area id="message" class="block mt-1 w-full" name="message" :value="old('message')" required/>
                        <x-input-error :messages="$errors->get('message')" class="mt-2"/>
                    </div>

                    <p class="mt-4 text-gray-400 text-sm text-justify">
                        {!! __('contact.rgpd') !!}
                    </p>

                    <div class="text-center rounded-sm pt-12">
                        <button type="submit" class="rounded-sm bg-red-700 hover:bg-red-600 p-2 text-white">{{ __('form.send') }}</button>
                    </div>
                @else
                    <div x-init="$el.closest('form').scrollIntoView()">
                        <p>{{ __('form.thanks') }}</p>
                    </div>
                @endif
        </form>

            <div class="w-full lg:w-4/12">

                <h2 class="text-center text-red-800 text-3xl uppercase">{{ __('contact.call_expert') }}</h2>

                <!-- auto pub -->
                <div class="group my-4 md:my-12 relative cursor-pointer overflow-hidden">

                    <!-- titre -->
                    <div class="text-center z-20 w-full absolute text-white top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-6">
                        <h2 class="text-2xl font-bold italic text-shadow-black">{{ __('contact.sale_your_vineyards') }}</h2>
                        <span class="font-bold text-shadow-black">{{ __('contact.with_mzre') }}</span>
                    </div>

                    <!-- bg-opaque -->
                    <div class="absolute top-0 w-full h-full bg-black/20 z-10"></div>

                    <!-- img sell vignoble -->
                    <img class="w-full transition ease-in-out delay-200 group-hover:scale-110 rounded-sm" loading="lazy" src="{{ asset('images/vignoble-a-vendre.webp') }}" alt="">

                </div>

                <!-- pub -->
                <div class="group my-4 md:my-12 relative cursor-pointer overflow-hidden">

                    <!-- titre -->
                    <div class="text-center z-20 w-full absolute text-white top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-6">
                        <a href="{{ route('blog.index') }}">
                            <h2 class="text-2xl font-bold italic text-shadow-black">{{ __('contact.guide_vineyards') }}</h2>
                            <span class="font-bold text-shadow-black">{{ __('contact.by_mzre') }}</span>
                        </a>
                    </div>

                    <!-- bg-opaque -->
                    <div class="absolute top-0 w-full h-full bg-black/20 z-10"></div>

                    <!-- img guide vignoble -->
                    <img class="w-full transition ease-in-out delay-200 group-hover:scale-110 rounded-sm" loading="lazy" src="{{ asset('images/guide-vignoble.webp') }}" alt="">

                </div>
            </div>

        </div>

    </section>

    <!-- repique addresse -->
    <div class="flex flex-col lg:flex-row items-center gap-2 lg:gap-12 p-8 lg:p-16 bg-gray-100">

        <!-- photo agence -->
        <div class="w-full lg:w-1/2">
            <img class="w-full lg:w-1/2 float-right drop-shadow-lg rounded-md" src="{{ asset('images/photo_agence.webp') }}" alt="photo agence Michaël Zingraf Real Estate">
        </div>

        <!-- addresse -->
        <div class="w-full lg:w-1/2 flex flex-col gap-6">
            <div class="flex flex-col text-black font-crimson italic">
                <span class="text-lg font-bold">{{ __('contact.address') }}</span>
                <span>{{ $agency->address }}<br>{{ $agency->city->zipcode }} {{ $agency->city->name }}</span>
            </div>
            <!-- téléphone -->
            <div class="flex flex-col text-black font-crimson italic">
                <span class="text-lg font-bold">{{ __('contact.phone') }}</span>
                <span><a class="hover:text-red-800" href="tel:{{ $agency->phone }}">{{ $agency->phone }}</a></span>
            </div>
            <!-- email -->
            <div class="flex flex-col text-black font-crimson italic">
                <span class="text-lg font-bold">{{ __('contact.email') }}</span>
                <span><a class="hover:text-red-800" href="mailto:vineyards@michaelzingraf.com">vineyards@michaelzingraf.com</a></span>
            </div>
        </div>

    </div>

    <!-- carte/map -->
    <section class="relative">

        <div id="map" class="h-[600px]"></div>

        <div class="absolute hidden lg:flex flex-col w-fit h-fit gap-6 top-0 bottom-0 left-0 right-0 translate-y-1/3 translate-x-1/4 bg-white drop-shadow-2xl z-[999] p-16 border-l-8 border-red-700">
            <!-- addresse -->
            <div class="flex flex-col text-black font-crimson italic">
                <span class="text-lg font-bold">{{ __('contact.address') }}</span>
                <span>{{ $agency->address }}<br>{{ $agency->city->zipcode }} {{ $agency->city->name }}</span>
            </div>
            <!-- téléphone -->
            <div class="flex flex-col text-black font-crimson italic">
                <span class="text-lg font-bold">{{ __('contact.phone') }}</span>
                <span><a class="hover:text-red-800" href="tel:{{ $agency->phone }}">{{ $agency->phone }}</a></span>
            </div>
            <!-- email -->
            <div class="flex flex-col text-black font-crimson italic">
                <span class="text-lg font-bold">{{ __('contact.email') }}</span>
                <span><a class="hover:text-red-800" href="mailto:vineyards@michaelzingraf.com">vineyards@michaelzingraf.com</a></span>
            </div>
        </div>
    </section>

@section("dedicated_js")
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <script>
        let map = L.map('map', {scrollWheelZoom:false}).setView([43.26855, 6.63949], 16);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        let redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        let marker = L.marker([43.26855, 6.63949], {icon: redIcon}).addTo(map);
    </script>
@endsection
</x-front-layout>
