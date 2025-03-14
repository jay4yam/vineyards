<form action="{{ route('properties.index') }}" class="lg:container mx-auto grid grid-cols-1 lg:grid-cols-6 gap-2 justify-between items-center lg:px-40">
    <div class="text-gray-400">{{ __('property.filters') }}</div>

    <!-- types des biens -->
    <div class="w-full">
        <select name="type" id="type" class="w-full border-gray-200 ring-red-800 focus:ring-red-800 text-gray-400">
            <option value="">{{ __('property.types') }}</option>
            @foreach($allTypes as $id => $name)
                <option value="{{ $id }}" @selected($id == request()->get('type'))>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <!-- end types des biens -->

    <!-- sous-types des biens -->
    <div>
        <select name="subtype" id="subtype" class="w-full border-gray-200 ring-red-800 focus:ring-red-800 text-gray-400">
            <option value="">{{ __('property.subtypes') }}</option>
            @foreach($allSubtypes as $id => $name)
                <option value="{{ $id}}" @selected($id == request()->get('subtype'))>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <!-- end sous-types des biens -->

    <!-- regions des biens -->
    <div>
        <select name="region" id="region" class="w-full border-gray-200 ring-red-800 focus:ring-red-800 text-gray-400">
            <option value="">{{ __('property.regions') }}</option>
            @foreach($allRegions as $id => $name)
                <option value="{{ $id }}" @selected($id == request()->get('region'))>{{ $name }}</option>
            @endforeach
        </select>
    </div>
    <!-- end sous-types de bien -->

    <!-- prix des biens -->
    <div>
        <select name="price" id="price" class="w-full border-gray-200 ring-red-800 focus:ring-red-800 text-gray-400">
            <option value="">{{ __('property.price') }}</option>
            <option value="< 1 000 000 €">< 1 000 000 €</option>
            <option value="1 000 000 € - 2 000 000 €">1 000 000 € - 2 000 000 €</option>
            <option value="2 000 000 € - 5 000 000 €">2 000 000 € - 5 000 000 €</option>
            <option value="5 000 000 € - 10 000 000 €">5 000 000 € - 10 000 000 €</option>
            <option value="> 10 000 000 €">> 10 000 000 €</option>
        </select>
    </div>
    <!-- end sous-types de bien -->

    <button class="w-full bg-red-800 hover:bg-red-900 text-white font-bold p-2 rounded-sm">{{ __('property.search') }}</button>
</form>
