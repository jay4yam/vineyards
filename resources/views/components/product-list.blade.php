<article data-aos="fade-up"
         data-aos-offset="-300"
         data-aos-delay="500"
         data-aos-duration="1000"
         data-aos-easing="ease-in-out"
         data-aos-mirror="false"
         data-aos-once="true"
         data-aos-anchor-placement="top-center"
         class="flex flex-col lg:flex-row gap-1 group hover:cursor-pointer ease-in-out delay-150 transition-all pb-8">

        <!-- main image -->
        <figure class="relative basis-2/3 overflow-hidden">
            <a href="{{ route('properties.show', ['slug' => $property->comment->slug, 'property' => $property ]) }}">
                <img class="w-full h-full object-cover group-hover:scale-105 ease-in-out delay-150 transition-all" loading="lazy" src="{{ asset('storage/properties/'.$property->reference.'/'.$property->picture->name) }}" alt="{{ $property->name }}">
            </a>
            <div class="absolute bottom-0 flex gap-2 p-6">
            @foreach( $property->pictures as $picture )
                <img loading="lazy" class="border-4 border-white h-20" src="{{ asset('storage/properties/'.$property->reference.'/'.$picture->name) }}" alt="">
                @if($loop->index >= 4)
                    @break
                @endif
            @endforeach
        </div>
        </figure>

        <!-- product info -->
        <div class="basis-1/3 flex flex-col gap-4 justify-between bg-gray-50 pr-1">

            <!-- text et prix -->
            <div class="text-center p-6 lg:p-12">
                <h2 class="font-bold">{{ $property->comment->title }}</h2>
                <p class="text-justify italic pt-8 lowercase">{!! \Illuminate\Support\Str::limit($property->comment->comment, 200, '...', true) !!}</p>
            </div>

            <!-- infos produit -->
            <div class="grid grid-cols-3 gap-1 text-xs">

                <div class="flex gap-1 items-center col-span-3 p-2 bg-gray-200 text-xl">
                    <p class="font-bold italic">{{ \Illuminate\Support\Number::currency($property->price->value, in:'EUR', locale: app()->getLocale(), precision: 0) }}</p>
                    <p class="italic text-xs">{{ __('property.fees') }}</p>
                </div>

                <!-- region -->
                <div data-aos="flip-up"
                    data-aos-offset="-600"
                    data-aos-delay="900"
                    data-aos-duration="1000"
                    data-aos-easing="ease-in-out"
                    data-aos-mirror="false"
                    data-aos-once="true"
                    data-aos-anchor-placement="top-center"
                    class="bg-gray-100 py-4 flex items-center justify-center">
                    <ul class="flex flex-col gap-1 justify-center text-center">
                        <li>{{ __('property.region') }}</li>
                        <li class="flex justify-center"><x-lucide-map-pinned class="h-6"/></li>
                        <li class="font-bold lowercase">{{ $property->region->name }}</li>
                    </ul>
                </div>
                <!-- end region -->

                <!-- city -->
                <div data-aos="flip-up"
                     data-aos-offset="-600"
                     data-aos-delay="1200"
                     data-aos-duration="1000"
                     data-aos-easing="ease-in-out"
                     data-aos-mirror="false"
                     data-aos-once="true"
                     data-aos-anchor-placement="top-center"
                     class="bg-gray-100 py-4 flex items-center justify-center">
                        <ul class="flex flex-col gap-1 text-center">
                            <li>{{ __('property.city') }}</li>
                            <li class="flex justify-center"><x-lucide-map-pin class="h-6"/></li>
                            <li class="font-bold lowercase">{{ $property->city->name }}</li>
                        </ul>
                </div>
                <!-- end city -->

                <!-- subtype -->
                <div data-aos="flip-up"
                    data-aos-offset="-600"
                    data-aos-delay="1500"
                    data-aos-duration="1000"
                    data-aos-easing="ease-in-out"
                    data-aos-mirror="false"
                    data-aos-once="true"
                    data-aos-anchor-placement="top-center"
                    class="bg-gray-100 py-4 flex items-center justify-center">
                    <ul class="flex flex-col gap-0 text-center">
                        <li>{{ __('property.type') }}</li>
                        <li class="flex justify-center"><x-hugeicons-house-02 class="h-8"/></li>
                        <li class="font-bold lowercase">{{ $property->subtype->name }}</li>
                    </ul>
                </div>
                <!-- end subtype -->

                <!-- surface -->
                <div data-aos="flip-up"
                     data-aos-offset="-600"
                     data-aos-delay="1800"
                     data-aos-duration="1000"
                     data-aos-easing="ease-in-out"
                     data-aos-mirror="false"
                     data-aos-once="true"
                     data-aos-anchor-placement="top-center"
                     class="bg-gray-100 py-4 flex items-center justify-center">
                    <ul class="flex flex-col gap-1 justify-center text-center">
                        <li class="lowercase">{{ __('property.area') }}</li>
                        <li class="flex justify-center"><x-carbon-area class="h-6"/></li>
                        <li class="font-bold lowercase">{{ $property->area_value }} {!! __('property.sqm') !!}</li>
                    </ul>
                </div>
                <!-- end surface -->

                <!-- terrain -->
                <div data-aos="flip-up"
                     data-aos-offset="-600"
                     data-aos-delay="2100"
                     data-aos-duration="1000"
                     data-aos-easing="ease-in-out"
                     data-aos-mirror="false"
                     data-aos-once="true"
                     data-aos-anchor-placement="top-center"
                     class="bg-gray-100 py-4 flex items-center justify-center">
                    <ul class="flex flex-col gap-1 text-center">
                        <li class="lowercase">{{ __('property.land') }}</li>
                        <li class="flex justify-center"><x-elemplus-grape class="h-6" /></li>
                        <li class="font-bold lowercase">{{ $property->surfTerrain() }} .Ha</li>
                    </ul>
                </div>
                <!-- end terrain -->

                <!-- rooms -->
                <div data-aos="flip-up"
                     data-aos-offset="-600"
                     data-aos-delay="2400"
                     data-aos-duration="1000"
                     data-aos-easing="ease-in-out"
                     data-aos-mirror="false"
                     data-aos-once="true"
                     data-aos-anchor-placement="top-center"
                     class="bg-gray-100 py-4 flex items-center justify-center">
                    <ul class="flex flex-col gap-0 text-center">
                        <li class="lowercase">{{ __('property.rooms') }}</li>
                        <li class="flex justify-center"><x-iconoir-house-rooms class="h-8"/></li>
                        <li class="font-bold lowercase">{{ $property->rooms }}</li>
                    </ul>
                </div>
                <!-- end rooms -->

                <div class="col-span-3 text-xl">
                    <a href="{{ route('properties.show', ['slug' => $property->comment->slug, 'property' => $property ]) }}"
                       class="block w-full bg-red-800 hover:bg-red-900 text-white font-bold p-2 text-center">
                        {{ __('property.cta') }}
                    </a>
                </div>

            </div>

        </div>

</article>
