<x-front-layout :seoData="$seoData">

    <header class="relative flex items-center justify-center h-24 lg:h-96 w-full" style="background: center/cover fixed url('{{ asset('images/bg-listing.webp') }}');">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 drop-shadow">
            <span class="font-retro text-7xl text-white text-shadow">
                {{ __('menu.handbook') }}
            </span>
        </div>
    </header>

    <!-- liste articles -->
    <section class="container mx-auto p-6 lg:p-12 lg:px-48 flex flex-col lg:flex-row gap-6">

        <!-- colonnes des articles -->
        <div class="w-full lg:w-3/4">
            @foreach($blogs as $article)
                <x-blogpost :blog="$article"/>
            @endforeach
        </div>
        <!-- end colonnes des articles -->

        <!-- colonnes des infos -->
        @include('blogs._aside')

    </section>

</x-front-layout>
