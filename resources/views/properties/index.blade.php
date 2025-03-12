<x-front-layout>

    <!-- header de la page -->
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
    <!-- end header de la page -->

    <!-- moteur de recherche -->
    <section class="bg-gray-100 p-4 lg:px-8 lg:py-4">
        @include('partials._search')
    </section>
    <!-- end moteur de recherche -->

    <!-- breadcrumb -->
    <div class="container mx-auto px-40 py-4">
        <ul class="flex gap-1 text-gray-400">
            <li>
                <a href="{{ route('home', ) }}">{{ __('menu.home') }}</a>
            </li>
            <li> > </li>
            <li>
                {{ __('menu.properties') }}
            </li>
        </ul>
    </div>
    <!-- breadcrumb -->

    <!-- filtre affichage tri -->
    <div class="flex items-center justify-between container mx-auto px-40 py-4">

        <form action="{{ route('properties.index') }}" class="text-gray-400 w-1/2">
            <select class="border-gray-200" name="order_by" id="order_by" onchange="this.form.submit()">
                <option value="price_desc" @selected(request()->get('order_by') === 'price_desc')>{{ __('form.price_desc') }}</option>
                <option value="price_asc" @selected(request()->get('order_by') === 'price_asc')>{{ __('form.price_asc') }}</option>
                <option value="latest" @selected(request()->get('order_by') === 'latest')>{{ __('form.new') }}</option>
            </select>
        </form>

        <div class="w-1/3">
            {{ $properties->links() }}
        </div>

    </div>
    <!-- end filtre affichage tri -->

    <!-- listing des produits -->
    <section class="container mx-auto grid grid-cols-1 gap-4 p-4 lg:py-4 lg:px-40">

        @foreach($properties as $property)
            <x-product-list :property="$property" />
        @endforeach

        <div>
            {{ $properties->links() }}
        </div>
    </section>
    <!-- end listing des produits -->

</x-front-layout>
