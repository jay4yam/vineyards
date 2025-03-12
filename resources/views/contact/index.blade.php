<x-front-layout>

@section('dedicated_css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
@endsection

    <header class="relative flex items-center justify-center h-96 w-full" style="background: center/cover fixed url('{{ asset('images/bg-listing.webp') }}');">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 drop-shadow">
            <a href="{{ route('home') }}">
                <img data-aos="fade-down"
                     data-aos-offset="0"
                     data-aos-delay="500"
                     data-aos-duration="1000"
                     data-aos-easing="ease-in-out"
                     data-aos-mirror="true"
                     data-aos-once="false"
                     data-aos-anchor-placement="top-center"
                     class="h-64 p-12"
                     height="200" src="{{ asset('images/logo-vineyards.svg') }}"
                     alt="logo Michaël Zingraf Real Estate"/>
            </a>
        </div>
    </header>

    <!-- section form -->
    <section class="pt-16">

        <h2 class="text-center text-red-700 text-3xl font-eurostile uppercase">{{ __('contact.getintouch') }}</h2>

        <!-- form -->
        <form class="mx-auto w-full lg:w-2/3 p-6">

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
                Les informations collectées à partir de ce formulaire permettent aux équipes de Michaël Zingraf Vineyards de traiter votre demande.
                Elle sont conservées uniquement à cette seule fin et ne sont pas transmises à des tiers.
            </p>

            <div class="text-center rounded-sm pt-12">
                <button type="submit" class="rounded-sm bg-red-700 hover:bg-red-600 p-2 text-white">{{ __('form.send') }}</button>
            </div>
        </form>

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

    </section>

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
