<x-front-layout :seoData="$seoData">

    @section('dedicated_css')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
              integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
              crossorigin=""/>
    @endsection

    <!-- header -->
    <header class="m-1">

        <!-- link list -->
        @include('partials._property_link_list', ['property' => $property])
        <!-- end link list -->

        <!-- swiper and form -->
        <div class="flex flex-col lg:flex-row gap-1 my-1">

            <!-- swiper images -->
            <div class="w-full lg:w-3/4">

                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach($property->pictures as $picture)
                            <div class="swiper-slide">
                                <figure>
                                    <img class="w-full object-contain" src="{{ asset('storage/properties/'.$property->reference.'/'.$picture->name) }}" alt="slide property">
                                </figure>
                            </div>
                        @endforeach
                    </div>

                    <!-- pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                </div>

            </div>
            <!-- end swiper images -->

            <!-- nego & form -->
            <div class="flex flex-col justify-between w-full lg:w-1/4">

                <!-- nego -->
                <div class="flex gap-2 bg-gray-200">

                    <!-- picture -->
                    <img class="w-1/3" src="{{ asset('storage/user/'.$property->user->avatar) }}" alt="{{ $property->user->username }}">

                    <!-- info nego -->
                    <div class="flex flex-col justify-between p-4">

                        <div>
                            <p class="font-bold">{{ $property->user->firstname }} {{ $property->user->lastname }}</p>
                            <p class="italic">{{ $property->user->job_title }}</p>
                        </div>

                        <ul class="italic text-xs">
                            <li>
                                <a id="mailtobroker" href="mailto:{{$property->user->email}}">{{ $property->user->email }}</a>
                            </li>
                            <li>
                                <a id="phonetobroker" href="tel:{{$property->user->phone}}">{{ $property->user->phone }}</a>
                            </li>
                            <li>
                                <a id="mobiletobroker" href="tel:{{$property->user->mobile}}">{{ $property->user->mobile }}</a>
                            </li>
                        </ul>

                    </div>
                    <!-- end info nego -->
                </div>
                <!-- end nego -->

                <!-- form -->
                <form id="form_request_product" action="{{ route('contact.form.submit') }}" method="post" class="flex flex-col gap-2 py-2">
                    @method('post')
                    @csrf
                    <input type="hidden" name="ip_address" value="{{ request()->getClientIp() }}">
                    <input type="hidden" name="sources" value="form_product">
                    <input type="hidden" name="reference" value="{{ $property->reference }}">
                    <p class="font-bold">Send Request</p>

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

                    <p class="text-gray-400 text-xs">{{ __('form.rgpd') }}</p>

                </form>
                <!-- end form -->

                <!-- infos produit -->
                <div class="grid grid-cols-3 gap-1 text-xs">

                    <div class="flex items-center bg-gray-200 gap-1 col-span-3 text-xl p-2">
                        <x-heroicon-o-currency-euro class="h-6" /> <span>{{ \Illuminate\Support\Number::currency($property->price->value, in:'Euro', locale: app()->getLocale(), precision: 0) }}</span>
                        <span class="italic text-xs">{{ __('property.fees') }}</span>
                    </div>

                    <!-- region -->
                    <ul class="bg-gray-200 flex flex-col gap-1 justify-center text-center py-6">
                        <li>{{ __('property.region') }}</li>
                        <li class="flex justify-center"><x-lucide-map-pinned class="h-6"/></li>
                        <li class="font-bold lowercase">{{ $property->region->name }}</li>
                    </ul>
                    <!-- end region -->

                    <!-- city -->
                    <ul class="bg-gray-200 flex flex-col gap-1 text-center py-6">
                        <li>{{ __('property.city') }}</li>
                        <li class="flex justify-center"><x-lucide-map-pin class="h-6"/></li>
                        <li class="font-bold lowercase">{{ $property->city->name }}</li>
                    </ul>
                    <!-- end city -->

                    <!-- subtype -->
                    <ul class="bg-gray-200 flex flex-col gap-0 text-center py-6">
                        <li>{{ __('property.type') }}</li>
                        <li class="flex justify-center"><x-hugeicons-house-02 class="h-8"/></li>
                        <li class="font-bold lowercase">{{ $property->subtype->name }}</li>
                    </ul>
                    <!-- end subtype -->

                    <!-- surface -->
                    <ul class="bg-gray-200 flex flex-col gap-1 justify-center text-center py-6">
                        <li class="lowercase">{{ __('property.area') }}</li>
                        <li class="flex justify-center"><x-carbon-area class="h-6"/></li>
                        <li class="font-bold lowercase">{{ $property->area_value }} {!! __('property.sqm') !!}</li>
                    </ul>
                    <!-- end surface -->

                    <!-- terrain -->
                    <ul class="bg-gray-200 flex flex-col gap-1 text-center py-6">
                        <li class="lowercase">{{ __('property.land') }}</li>
                        <li class="flex justify-center"><x-elemplus-grape class="h-6" /></li>
                        <li class="font-bold lowercase">{{ $property->surfTerrain() / 10000 }} .Ha</li>
                    </ul>
                    <!-- end terrain -->

                    <!-- rooms -->
                    <ul class="bg-gray-200 flex flex-col gap-0 text-center py-6">
                        <li class="lowercase">{{ __('property.rooms') }}</li>
                        <li class="flex justify-center"><x-iconoir-house-rooms class="h-8"/></li>
                        <li class="font-bold lowercase">{{ $property->rooms }}</li>
                    </ul>
                    <!-- end rooms -->

                </div>
                <!-- end infos produit -->

            </div>
            <!-- end nego & form -->
        </div>
        <!-- swiper and form -->

    </header>
    <!-- end header -->

    <!-- breadcrumb -->
    <div class="m-1 p-4 bg-gray-50 text-xs">
        <ul class="flex gap-1">
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

    <!-- produit -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-1 m-1">

        <!-- 1ere col: detail produit -->
        <div class="w-full">
            <!-- info -->
            <h1 class="italic text-gray-400">{{ $property->subtype->name }} - {{ $property->region->name }} - {{ $property->city->name }}</h1>
            <!-- titre -->
            <h2 class="text-xl font-bold text-red-800">{!! $property->comment->title !!}</h2>

            <!-- texte produit -->
            <div class="py-4">
                {!! $property->comment->comment !!}
            </div>

        </div>
        <!-- end 1ere col: detail produit -->

        <!-- plan -->
        <div id="map"></div>
        <!-- end plan -->

    </section>
    <!-- end produit -->

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
