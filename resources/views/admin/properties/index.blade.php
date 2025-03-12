<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Properties') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-4 gap-4 py-12 max-w-7xl mx-auto px-8">

        @foreach($properties as $property)
            <div class="w-full">
                <div class="relative">
                    <img class="w-full" src="{{ asset('storage/properties/'.$property->picture->name) }}" alt="{{$property->name}}">
                    <div class="absolute flex justify-between top-0 bg-white w-full p-2 text-xs">
                        <span>{{ $property->reference }}</span>
                        <span>{{ $property->subtype->name }}</span>
                    </div>
                </div>

                <div class="bg-white p-2 text-xs">
                    <div class="flex justify-between">
                        <p>{{ $property->region->name }}</p>
                        <p>{{ $property->city->name }}</p>
                    </div>
                    <div> price : {{ \Illuminate\Support\Number::currency( $property->price, in: 'Euro', locale: app()->getLocale(), precision: 0 ) }}</div>
                    <div class="flex justify-between">
                        <div class="flex gap-2"><x-mdi-fruit-grapes class="h-4"/> {{ $property->surfTerrain() }}</div>
                        <div class="flex gap-2"><x-carbon-area class="h-4"/> {{ $property->area_value }} {!! __('property.sqm') !!}</div>
                    </div>
                </div>

            </div>
        @endforeach

    </div>

</x-app-layout>
