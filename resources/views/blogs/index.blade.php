<x-front-layout>

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

    <!-- liste articles -->
    <section class="container mx-auto p-12 px-48 flex gap-6">

        <!-- colonnes des articles -->
        <div class="w-3/4">
            @foreach($blogs as $article)
                <x-blogpost :blog="$article"/>
            @endforeach
        </div>
        <!-- end colonnes des articles -->

        <!-- colonnes des infos -->
        @include('blogs._aside')

    </section>

</x-front-layout>
