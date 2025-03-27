<x-front-layout :seoData="$seoData">

    <!-- header video -->
    <header class="h-[calc(100vh-64px)] w-full overflow-hidden">

        <!--logo & baseline -->
        <div class="absolute z-40 w-full lg:w-1/2 h-fit m-auto left-0 right-0 top-0 bottom-0 text-white drop-shadow text-center">
            <div class="flex flex-col gap-4">
                <h1 data-aos="fade-down"
                    data-aos-offset="0"
                    data-aos-delay="1000"
                    data-aos-duration="1000"
                    data-aos-easing="ease-in-out"
                    data-aos-mirror="true"
                    data-aos-once="false"
                    class="font-eurostile text-shadow uppercase text-4xl font-bold z-50">{{ __('home.baseline') }}</h1>
                <h2 data-aos="fade-up"
                    data-aos-offset="0"
                    data-aos-delay="2000"
                    data-aos-duration="1000"
                    data-aos-easing="ease-in-out"
                    data-aos-mirror="true"
                    data-aos-once="false"
                    class="font-retro lowercase text-7xl text-shadow animate-fade-down animate-once animate-delay-[3000ms] animate-ease-in-out">{{ __('home.secondline') }}</h2>
            </div>
        </div>

        <!-- video de la home page-->
        <video poster="{{ asset('images/bg-video.webp') }}" autoplay loop muted class="w-auto h-screen max-w-none">
            <source src="{{ asset('images/vineyards.mp4') }}" type="video/mp4">
        </video>

        <!-- logo christie's -->
        <img data-aos="zoom-in"
             data-aos-offset="0"
             data-aos-delay="2500"
             data-aos-duration="1000"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-once="false"
             class="absolute z-40 w-48 h-fit m-auto left-0 right-0 bottom-4 animate-fade-up animate-once animate-delay-[3500ms] animate-ease-in-out"
             src="{{ asset('images/cire_logo.svg') }}" alt="logo christie's international real estate">

    </header>

    <!-- bloc MZ et Intro -->
    <section class="flex flex-col lg:flex-row">

        <!-- MZ & HZ photo -->
        <div class="w-full lg:w-1/2 h-fit lg:h-auto"
             data-aos="fade-right"
             data-aos-offset="-200"
             data-aos-delay="50"
             data-aos-duration="1000"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-anchor-placement="top-center">
            <img class="w-full lg:h-full object-cover" src="{{ asset('images/michael-heathcliff-zingraf.webp') }}" alt="michaël et heatghcliff zingraf">
        </div>
        <!-- end MZ & HZ photo -->

        <!-- intro -->
        <div class="w-full lg:w-1/2 p-8 lg:p-28 text-justify">
            <h2 class="uppercase font-black text-3xl text-black py-4 text-center">{{ __('home.metier_passion') }}</h2>
            <h3 class="font-crimson font-bold">
                {{ __('home.intro_mz') }}
            </h3>
            <div class="text-gray-500 font-crimson pt-12">
                <p class="py-2">{{ __('home.p1_mz') }}</p>

                <p class="py-2">{{ __('home.p2_mz') }}</p>

                <p class="py-2">{{ __('home.p3_mz') }}</p>

                <p data-aos="fade-up"
                   data-aos-offset="0"
                   data-aos-delay="50"
                   data-aos-duration="1000"
                   data-aos-easing="ease-in-out"
                   data-aos-mirror="true"
                   data-aos-anchor-placement="top-bottom"
                   class="font-retro text-red-600 text-5xl text-center pt-12">Michaël & Heathcliff Zingraf</p>
            </div>
        </div>

    </section>

    <!-- philosophie & img bg -->
    <section class="flex flex-col lg:flex-row w-full">

        <!-- intro -->
        <div class="w-full lg:w-1/2 order-2 lg:order-1 p-8 lg:p-28 text-justify">

            <h2 class="uppercase font-black text-3xl text-black py-4 text-center">{{ __('home.philosophy_title') }}</h2>

            <h3 class="font-crimson font-bold">{{ __('home.philosophy_intro') }}</h3>

            <div class="text-gray-500 font-crimson pt-14">

                <p class="py-2">{{ __('home.philosophy_p1') }}</p>

                <p class="py-2">{{ __('home.philosophy_p2') }}</p>

                <div class="text-center rounded-sm pt-12">
                    <a href="{{ route('contact') }}" class="bg-red-800 hover:bg-red-700 p-3 text-white">{{ __('contact.contact_us') }}</a>
                </div>

            </div>
        </div>

        <!-- BG-wine -->
        <div class="w-full lg:w-1/2 order-1 lg:order-2 h-96 lg:h-auto bg-wine">
            <img data-aos="fade-right"
                 data-aos-offset="-200"
                 data-aos-delay="50"
                 data-aos-duration="1000"
                 data-aos-easing="ease-in-out"
                 data-aos-mirror="true"
                 data-aos-anchor-placement="top-center"
                 class="h-full object-cover" src="{{ asset('/images/bg-vin.webp') }}" alt="">
        </div>

    </section>

    <!-- PROPERTIES -->
    <section class="flex flex-wrap">

        <!-- produits -->
        <div class="basis-full lg:basis-1/2 grid grid-cols-1 lg:grid-cols-2 auto-rows-max gap-2">

            @foreach($featuredProperties as $property)
                <x-home-property :property="$property" :index="$loop->index"/>
            @endforeach

        </div>

        <!-- texte présentation -->
        <div class="basis-full lg:basis-1/2 p-8 lg:p-28 text-justify">

            <h2 class="uppercase font-black text-3xl text-black py-4 text-center">{{ __('home.properties_title') }}</h2>

            <h3 class="font-crimson font-bold">{{ __('home.properties_intro') }}</h3>

            <p class="text-gray-500 font-crimson pt-14">{{ __('home.properties_p1') }}</p>

            <p class="text-gray-500 font-crimson pt-14">{!! __('home.properties_p2') !!}</p>

            <div class="text-center rounded-sm pt-12">
                <a href="{{ route('properties.index') }}" class="bg-red-800 hover:bg-red-700 p-3 text-white">{{ __('home.discover_properties') }}</a>
            </div>
        </div>
    </section>

    <!-- STAFF & FORM -->
    <section class="w-full flex flex-col lg:flex-row">

        <!-- colonne staff -->
        <div class="w-full lg:w-1/2 p-8 lg:pt-24 lg:px-24 text-justify">
            <h2 class="uppercase font-black text-3xl text-black py-4 text-center">{{ __('home.brand') }}</h2>
            <h3 class="font-crimson font-bold text-center">{{ __('home.staff') }}</h3>

            <div class="flex flex-wrap gap-y-6 p-6 font-crimson">

                <!-- staff -->
                @foreach($partners as $partner)
                    <x-partner-home :partner="$partner"/>
                @endforeach

            </div>
        </div>

        <!-- main form -->
        <div class="w-full lg:w-1/2 h-fit lg:h-auto flex items-center justify-center" style="background: center/cover url('{{ asset('/images/bg-form.webp') }}')">

            <div class="my-10 lg:my-28 mx-12 lg:mx-44 w-full lg:w-2/3 bg-white rounded-md drop-shadow-2xl"
                 data-aos="flip-left"
                 data-aos-offset="0"
                 data-aos-delay="50"
                 data-aos-duration="1000"
                 data-aos-easing="ease-in-out"
                 data-aos-mirror="false"
                 data-aos-once="true"
                 data-aos-anchor-placement="top-center">

                <form action="{{ route('contact.form.submit') }}" method="post" class="p-6 lg:p-14" method="POST">
                    <input type="hidden" name="ip_address" value="{{ request()->getClientIp() }}">
                    <input type="hidden" name="sources" value="form_home_page">
                    @method('post')
                    @csrf
                    @if(! session()->has('form_contact_success'))
                        <div class="flex flex-col gap-6 pb-6">

                            <img class="mx-auto w-20" src="{{ asset('images/logo-vineyards-rouge.svg') }}" alt="logo Michaël Zingraf Vineyards">

                            <h4 class="uppercase text-center font-black text-xl">{{ __('form.contact-us') }}</h4>

                            <p class="text-base text-justify text-gray-500 hidden lg:block font-crimson">{!! __('home.contact_intro') !!}</p>
                        </div>
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('form.name')" class="text-gray-700"/>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('form.phone')" class="text-gray-700"/>
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('email')" required/>
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

                        <div class="text-center rounded-sm pt-12">
                            <button type="submit" class="rounded-sm bg-red-700 hover:bg-red-600 p-3 text-white ">{{ __('form.send') }}</button>
                        </div>
                    @else
                        <div x-init="$el.closest('form').scrollIntoView()">
                            <p>{{ __('form.thanks') }}</p>
                        </div>
                    @endif
                </form>

            </div>

        </div>

    </section>

    <!-- réassurance -->
    <section class="flex flex-col lg:flex-row w-full p-10 lg:p-20 justify-center items-start text-gray-500 font-crimson">

        <!-- expertise -->
        <div data-aos="fade-down"
             data-aos-delay="100"
             data-aos-duration="500"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-anchor-placement="center-bottom"
             class="w-full lg:w-1/3 flex flex-col justify-center">

            <x-iconsax-lin-award class="h-10 text-black"/>

            <h3 class="uppercase font-black text-md text-black py-4 text-center">{{ __('home.expertise_intro') }}</h3>

            <p class="px-0 lg:px-8 text-center lg:text-justify text-md">{{ __('home.expertise_text') }}</p>

        </div>
        <!-- end expertise -->

        <!-- network -->
        <div data-aos="fade-up"
             data-aos-delay="200"
             data-aos-duration="500"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-anchor-placement="center-bottom"
             class="w-full lg:w-1/3 flex flex-col justify-center">

            <x-iconsax-lin-award class="h-10 text-black"/>

            <h3 class="uppercase font-black text-md text-black py-4 text-center">{{ __('home.network_intro') }}</h3>

            <p class="px-0 lg:px-8 text-center lg:text-justify text-md">{{ __('home.network_text') }}</p>

        </div>
        <!-- end network -->

        <!-- support -->
        <div data-aos="fade-down"
             data-aos-delay="300"
             data-aos-duration="500"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-anchor-placement="center-bottom"
             class="w-full lg:w-1/3 flex flex-col justify-center">

            <x-iconsax-lin-award class="h-10 text-black"/>

            <h3 class="uppercase font-black text-md text-black py-4 text-center">{{ __('home.support_intro') }}</h3>

            <p class="px-0 lg:px-8 text-center lg:text-justify text-md">{{ __('home.support_text') }}</p>
        </div>
        <!-- end support -->
    </section>

    <!-- adresses -->
    <section class="flex justify-center items-center" style="background: center/cover url('{{ asset('/images/bg-address-vineyards.webp') }}')">

        <div class="my-10 lg:my-28 mx-12 lg:mx-44 w-full lg:w-2/3 bg-white rounded-md text-center p-6 lg:p-14"
             data-aos="zoom-in"
             data-aos-offset="0"
             data-aos-delay="50"
             data-aos-duration="1000"
             data-aos-easing="ease-in-out"
             data-aos-mirror="false"
             data-aos-once="true"
             data-aos-anchor-placement="top-center">

            <h3 class="uppercase text-center font-black text-xl">Michaël Zingraf Vineyards</h3>

            <p class="font-crimson text-sm text-center p-6">{{ __('home.contact_text') }}</p>

            <div class="w-full flex p-6">
                <x-fas-map-marker-alt class="mx-auto h-12 text-red-600"/>
            </div>
            <div class="flex flex-col gap-4 font-crimson italic">
                <div>
                    <p class="text-black">Adresse</p>
                    <p class="text-gray-500">2 rue du Quadrille - Résidence Les Lices</p>
                    <p class="text-gray-500">83990 SAINT-TROPEZ</p>
                </div>

                <div>
                    <p class="text-black">{{ __('form.phone') }}</p>
                    <a href="tel:+33(0)4.22.400.300" class="text-gray-500">+33(0)4.22.400.300</a>
                </div>

                <div>
                    <p class="text-black">{{ __('form.email') }}</p>
                    <a href="mailto:vineyards@michaelzingraf.com" class="text-gray-500">vineyards@michaelzingraf.com</a>
                </div>
            </div>
        </div>
    </section>

</x-front-layout>
