<x-front-layout :seoData="$seoData">

    <header class="relative flex items-center justify-center h-24 lg:h-96 w-full" style="background: top/contain fixed url('{{ asset('images/bg-about.webp') }}') no-repeat;">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 drop-shadow">
            <span class="font-retro text-7xl text-white text-shadow">
                {{ __('menu.about') }}
            </span>
        </div>
    </header>

    <!-- intro -->
    <section>

        <div class="flex flex-col lg:flex-row gap-4 lg:gap-12 items-center">

            <div class="px-6 lg:px-40 text-right">
                <h1 class="uppercase font-black text-2xl text-black py-4 text-center w-full px-12">{{ __('about.intro_h1') }}</h1>

                <p class="text-justify font-crimson">{!! __('about.intro_p1')  !!}</p>

                <p class="text-justify font-crimson py-2">{{ __('about.intro_p2') }}</p>
            </div>

            <img data-aos="fade-right"
                 data-aos-offset="0"
                 data-aos-delay="1000"
                 data-aos-duration="1000"
                 data-aos-easing="ease-in-out"
                 data-aos-mirror="false"
                 data-aos-once="true"
                 data-aos-anchor-placement="center-bottom"
                 loading="lazy" class="w-full lg:w-1/2 rounded-sm" src="{{ asset('images/michael-heathcliff-zingraf.webp') }}" alt="groupe Michaël Zingraf Real Estate">
        </div>

    </section>
    <!-- end intro -->

    <!-- stratégique -->
    <section>

        <div class="flex flex-col lg:flex-row gap-12 items-center">

            <img data-aos="fade-left"
                 data-aos-offset="0"
                 data-aos-delay="1000"
                 data-aos-duration="1000"
                 data-aos-easing="ease-in-out"
                 data-aos-mirror="false"
                 data-aos-once="true"
                 data-aos-anchor-placement="center-bottom"
                 class="w-full lg:w-1/2 rounded-sm" src="{{ asset('images/investissement-strategique.webp') }}" alt="groupe Michaël Zingraf Real Estate">

            <div class="px-6 lg:px-40">
                <h2 class="uppercase font-black text-2xl text-black py-4 text-center w-full px-12">{{ __('about.strat_h2') }}</h2>

                <p class="text-justify font-crimson">{{ __('about.strat_p1') }}</p>

                <p class="text-justify font-crimson py-2">{{ __('about.strat_p2') }}</p>

                <p class="text-justify font-crimson py-2">{{ __('about.strat_p3') }}</p>

            </div>
        </div>

    </section>
    <!-- end strategique -->


    <!-- patrimoine -->
    <section>

        <div class="flex flex-col lg:flex-row gap-4 lg:gap-12 items-center">

            <div class="px-6 lg:px-40 text-justify">
                <h3 class="uppercase font-black text-2xl text-black py-4 text-center w-full px-12">{{ __('about.patri_h2') }}</h3>

                <p class="font-crimson">{{ __('about.patri_p1') }}</p>

                <p class="font-crimson">{{ __('about.patri_p2') }}</p>

                <p class="font-crimson">{{ __('about.patri_p3') }}</p>

            </div>

            <img data-aos="fade-right"
                 data-aos-offset="0"
                 data-aos-delay="1000"
                 data-aos-duration="1000"
                 data-aos-easing="ease-in-out"
                 data-aos-mirror="false"
                 data-aos-once="true"
                 data-aos-anchor-placement="center-bottom"
                loading="lazy" class="w-full lg:w-1/2 rounded-sm" src="{{ asset('images/patrimoine-img.webp') }}" alt="patrimoine">
        </div>

    </section>
    <!-- end patrimoine -->


    <!-- mzre -->
    <section>

        <div class="flex flex-col lg:flex-row gap-4 lg:gap-12 items-center">

            <img data-aos="fade-left"
                 data-aos-offset="0"
                 data-aos-delay="1000"
                 data-aos-duration="1000"
                 data-aos-easing="ease-in-out"
                 data-aos-mirror="false"
                 data-aos-once="true"
                 loading="lazy" class="w-full lg:w-1/2 rounded-sm" src="{{ asset('images/mzre-about.webp') }}" alt="groupe Michaël Zingraf Real Estate">

            <div>

                <h3 class="uppercase font-black text-2xl text-black py-4 text-center w-full px-6 lg:px-40">{{ __('about.mzre_h2') }}</h3>

                <div class="px-6 lg:px-40">
                    <p class="text-justify font-crimson">{{ __('about.mzre_p1') }}</p>

                    <p class="text-justify font-crimson py-2">{{ __('about.mzre_p2') }}</p>
                </div>
            </div>

        </div>

    </section>
    <!-- end mzre -->

    <!-- demande estimation -->
    <section>

        <div class="flex flex-col lg:flex-row items-center gap-2">

            <!-- content -->
            <div class="w-full lg:w-1/2 px-6 lg:px-40">

                <h4 class="uppercase font-black text-2xl text-black py-4 text-center w-full">{{ __('about.estim_h2') }}</h4>

                <h5 class="uppercase font-black text-lg text-black py-4 text-center w-full">{{ __('about.estim_h3') }}</h5>

                <div class="px6 lg:px-40">
                    <p class="font-crimson text-justify">{{ __('about.estim_p1') }}</p>
                    <p class="font-crimson text-justify py-2">{{ __('about.estim_p2') }}</p>
                    <p class="font-crimson text-justify py-2">{{ __('about.estim_p3') }}</p>
                    <p class="font-crimson text-justify py-2">{{ __('about.estim_p4') }}</p>
                </div>
            </div>
            <!-- content -->

            <!-- form -->
            <div class="w-full lg:w-1/2 h-fit lg:h-auto hover:cursor-pointer flex items-center justify-center" style="background: center/cover url('{{ asset('/images/bg-form-estimation.webp') }}')">

                <div class="my-10 lg:my-28 mx-12 lg:mx-44 w-full lg:w-2/3 bg-white rounded-md drop-shadow-2xl"
                     data-aos="fade-left"
                     data-aos-offset="0"
                     data-aos-delay="1000"
                     data-aos-duration="1000"
                     data-aos-easing="ease-in-out"
                     data-aos-mirror="false"
                     data-aos-once="true">

                    <form action="{{ route('contact.form.submit') }}" method="post" class="p-6 lg:p-14" method="POST">
                        <input type="hidden" name="ip_address" value="{{ request()->getClientIp() }}">
                        <input type="hidden" name="sources" value="form_home_page">
                        @method('post')
                        @csrf
                        @if(! session()->has('form_contact_success'))
                            <div class="flex flex-col gap-6 pb-6">

                                <img class="mx-auto w-20" src="{{ asset('images/logo-vineyards-rouge.svg') }}" alt="logo Michaël Zingraf Vineyards">

                                <h4 class="uppercase text-center font-black text-xl">{{ __('about.form_titre') }}</h4>

                                <p class="text-sm text-center text-gray-500 hidden lg:block">{!! __('about.form_text') !!}</p>
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
        </div>
    </section>

</x-front-layout>
