<article data-aos="fade-up"
         data-aos-offset="-200"
         data-aos-delay="500"
         data-aos-duration="1000"
         data-aos-easing="ease-in-out"
         data-aos-mirror="false"
         data-aos-once="true"
         data-aos-anchor-placement="top-center"
         class="group hover:cursor-pointer hover:bg-red-800 ease-in-out delay-150 transition-all">

    <div class="flex flex-col lg:flex-row p-2">

        <figure class="relative basis-2/3 overflow-hidden">
            <img class="h-full w-full object-cover group-hover:scale-105 ease-in-out delay-150 transition-all" loading="lazy" src="{{ asset('storage/properties/'.$property->picture->name) }}" alt="{{ $property->name }}">
            <div class="absolute bottom-0 flex gap-2 p-6">
                @foreach( $property->pictures as $picture )
                    <img loading="lazy" class="border-4 border-white h-20" src="{{ asset('storage/properties/'.$picture->name) }}" alt="">
                    @if($loop->index >= 4)
                        @break
                    @endif
                @endforeach
            </div>
        </figure>

        <div class="basis-1/3 flex flex-col gap-4 justify-between p-12 bg-gray-50">

            <div>
                <span class="italic text-xs">{{ $property->region->name }} - {{ $property->city->name }} - {{ $property->reference }}</span>
                <h2 class="font-bold">{{ $property->comment->title }}</h2>
                <p class="italic text-xs">{{ $property->subtype->name }}</p>
            </div>

            <p class="text-justify italic">{!! \Illuminate\Support\Str::limit($property->comment->comment, 200, '...', true) !!}</p>
            <span class="text-red-800 font-bold">{{ \Illuminate\Support\Number::currency($property->price, in:'EUR', locale: app()->getLocale(), precision: 0) }}</span>

            <ul>
                @foreach($property->areas as $areas)
                    <li class="flex gap-2 text-xs items-center">
                        <x-mdi-fruit-grapes class="h-6"/>
                        <span>{{ $areas->areaType->name }} : {!! \Illuminate\Support\Number::format($areas->area)  !!} {!! __('property.sqm')  !!}</span>
                    </li>
                @endforeach
            </ul>

            <a href="{{ route('properties.show', ['slug' => $property->comment->slug, 'property' => $property ]) }}"
               class="bg-red-800 hover:bg-red-900 text-white font-bold w-1/2 p-2 text-center">
                Voir le produit
            </a>
        </div>

    </div>

</article>
