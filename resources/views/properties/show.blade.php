<x-front-layout>

    @section('dedicated_css')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
              integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
              crossorigin=""/>
    @endsection

    <!-- header de la page -->
    <header class="relative flex items-center justify-center h-screen w-full">
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach($property->pictures as $picture)
                <div class="swiper-slide">
                    <figure>
                        <img class="w-full" src="{{ asset('storage/properties/'.$picture->name) }}" alt="slide property">
                    </figure>
                </div>
                @endforeach
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </header>
    <!-- end header de la page -->

    <!-- breadcrumb -->
    <div class="container mx-auto px-40 py-4">
        <ul class="flex gap-1 text-gray-400">
            <li>
                <a href="{{ route('home') }}">{{ __('menu.home') }}</a>
            </li>
            <li> > </li>
            <li>
                <a href="{{ route('properties.index') }}">{{ __('menu.properties') }}</a>
            </li>
            <li> > </li>
            <li>
                {{ \Illuminate\Support\Str::lower($property->comment->title) }}
            </li>
        </ul>
    </div>
    <!-- breadcrumb -->

    <!-- listing des produits -->
    <section class="container mx-auto flex flex-col lg:flex-row gap-4 p-4 lg:py-4 lg:px-40">

        <!-- 1ere col: detail produit -->
        <div class="basis-2/3">
            <!-- info -->
            <h1 class="italic text-gray-400">{{ $property->subtype->name }} - {{ $property->region->name }} - {{ $property->city->name }}</h1>
            <!-- titre -->
            <h2 class="text-xl font-bold text-red-800">{!! $property->comment->title !!}</h2>

            <!-- surfaces -->
            <ul class="flex gap-2 py-4 text-md text-gray-400">
                <li class="flex items-center gap-2">
                    <x-carbon-area class="h-6"/> <span>{{ $property->area_value }} {{ __('property.sqm') }}</span>
                </li>
                <li>|</li>
                <li class="flex items-center gap-2">
                    <x-mdi-fruit-grapes class="h-6"/> <span>{{ \Illuminate\Support\Number::format($property->surfTerrain(), 0, 0, app()->getLocale()) }} {{ __('property.sqm') }}</span>
                </li>
                <li>|</li>
                <li class="flex items-center gap-2">
                    <x-heroicon-o-currency-euro class="h-6" /> <span>{{ \Illuminate\Support\Number::currency($property->price, in:'Euro', locale: app()->getLocale(), precision: 0) }}</span>
                </li>
            </ul>
            <!-- end surfaces -->

            <!-- texte produit -->
            <div class="py-4">
                {!! $property->comment->comment !!}
            </div>

        </div>
        <!-- end 1ere col: detail produit -->

        <!-- 2eme col: info nego -->
        <div class="basis-1/3 bg-gray-50 p-4">

            <!-- info nego -->
            <div class="flex gap-2 pb-4">
                <img class="w-1/3" src="{{ asset('storage/user/'.$property->user->avatar) }}" alt="{{ $property->user->username }}">
                <div class="flex flex-col justify-between">
                    <div>
                        <p class="text-red-800 font-bold">{{ $property->user->firstname }} {{ $property->user->lastname }}</p>
                        <p class="italic text-gray-400">{{ $property->user->job_title }}</p>
                    </div>
                    <div class="text-xs">
                        <ul>
                            <li>
                                <a class="italic text-gray-400" href="mailto:{{$property->user->email}}">{{ $property->user->email }}</a>
                            </li>
                            <li>
                                <a class="italic text-gray-400" href="tel:{{$property->user->phone}}">{{ $property->user->phone }}</a>
                            </li>
                            <li>
                                <a class="italic text-gray-400" href="tel:{{$property->user->mobile}}">{{ $property->user->mobile }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end info nego -->

            <!-- form produit -->
            <div class="py-2">
                <form action="{{ route('contact.form.submit') }}" method="post" class="flex flex-col gap-2 py-2">
                    @method('post')
                    @csrf
                    <input type="hidden" name="ip_address" value="{{ request()->getClientIp() }}">
                    <input type="hidden" name="sources" value="form_product">
                    <input type="hidden" name="reference" value="{{ $property->reference }}">
                    <p class="text-red-800 font-bold">Send Request</p>

                    @if(! session()->has('form_contact_success'))
                        <div>
                            <input class="border-gray-200 w-full" type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('form.your_name') }} *" required>
                            @error('name')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <input class="border-gray-200 w-full" type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('form.your_email') }} *" required>
                            @error('email')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <input class="border-gray-200 w-full" type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ __('form.your_phone') }} *" required>
                            @error('phone')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <textarea class="border-gray-200 w-full text-gray-500" type="text" name="message">{{ __('form.your_message', ['ref' => $property->reference]) }}</textarea>
                            @error('phone')<p class="text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" class="rounded-sm bg-red-800 hover:bg-white hover:text-red-800 hover:ring-1 hover:ring-red-800 p-2 text-white">{{ __('form.send_request') }}</button>
                    @else
                        <div x-init="$el.closest('form').scrollIntoView()">
                            <p>{{ __('form.thanks') }}</p>
                        </div>
                    @endif
                </form>

                <p x-init="$el.closest('form').scrollIntoView()" class="text-gray-400 text-xs">{{ __('form.rgpd') }}</p>
            </div>
            <!-- end form produit -->

            <!-- plan propriete -->
            <div id="map"></div>
            <!-- end plan propriete -->
        </div>
        <!-- 2eme col: info nego -->

    </section>
    <!-- end listing des produits -->

@section("dedicated_js")
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<script>
    let lat = @js($property->latitude);
    let long = @js($property->longitude);

    let map = L.map('map', {scrollWheelZoom:false}).setView([lat, long], 13);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    let circle = L.circle([lat, long], {
        color: '#7f1d1d',
        fillColor: '#7f1d1d',
        fillOpacity: 0.5,
        radius: 1000
    }).addTo(map);
</script>

<script type="module">
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
    });
</script>

@endsection
</x-front-layout>
