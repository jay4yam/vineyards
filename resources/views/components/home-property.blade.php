<div data-aos="fade-up"
     data-aos-offset="{{ $index * 1 }}"
     data-aos-delay="500"
     data-aos-duration="1000"
     data-aos-easing="ease-in-out"
     data-aos-mirror="false"
     data-aos-once="false"
     data-aos-anchor-placement="top-center"
     class="group relative flex items-center justify-center h-full w-fit overflow-hidden hover:cursor-pointer">

    <div class="transition ease-in-out delay-100 hover:brightness-75 h-full">
        <img class="group-hover:blur-sm group-hover:scale-110 group-hover:duration-300 h-full object-cover" src="{{ asset('storage/properties/'.$property->reference.'/'.$property->picture->name) }}" alt="{{ $property->name }}"/>
    </div>

    <ul class="absolute hidden group-hover:block group-hover:duration-300 text-white text-lg font-black uppercase text-shadow text-center gap-2">
        <li class="text-base border-white border-b">{{ $property->reference }}</li>
        <li class="text-base">{{ $property->subtype->name }} - {{ $property->region->name }}</li>
        <li class="text-sm flex flex-row justify-around gap-2">
            <div class="flex flex-row items-center gap-2">
                <x-mdi-fruit-grapes class="mx-auto h-4"/>
                <span>{{ $property->surfTerrain() }} ha</span></div>
            <div class="flex flex-row items-center gap-2">
                <x-carbon-area class="mx-auto h-4"/>
                <span>{{ $property->area_value }} {!! __('property.sqm') !!}</span>
            </div>
            <div class="flex flex-row items-center gap-2">
                <x-fas-map-marker-alt class="mx-auto h-4"/>
                <span>{{ $property->city->name }}</span>
            </div>
        </li>
        <li class="text-lg">{{ \Illuminate\Support\Number::currency($property->price->value, in:'Euro', locale: app()->getLocale(), precision: 0) }}</li>
    </ul>

</div>
