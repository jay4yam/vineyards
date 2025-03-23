<section class="sticky top-[64px] z-40 bg-gray-100 p-4 lg:px-8 lg:py-2 drop-shadow">

    <form action="{{ route('properties.index') }}" method="post" class="lg:container mx-auto grid grid-cols-1 lg:grid-cols-7 gap-2 justify-between items-center lg:px-40">
        @csrf

        <div class="text-gray-400">{{ __('property.filters') }}</div>

        <!-- regions -->
        <div class="w-full">
            <select name="region" class="w-full border-gray-200 ring-red-800 focus:ring-red-800 text-gray-400">
                <option value="">{{ __('property.regions') }}</option>
                @foreach($allRegions as $region => $value)
                    <option value="{{ implode(',', $value) }}">{{ $region }}</option>
                @endforeach
            </select>
        </div>
        <!-- end regions -->

        <!-- departements -->
        <div class="w-full">
            <select name="department" class="w-full border-gray-200 ring-red-800 focus:ring-red-800 text-gray-400">
                <option value="">{{ __('property.department') }}</option>
                @foreach($allDepartments as $zip => $name)
                    <option value="{{ $zip }}">{{ $name }} ({{ $zip }})</option>
                @endforeach
            </select>
        </div>
        <!-- end département -->

        <!-- surface des biens -->
        <div>
            <select name="surface" class="w-full border-gray-200 ring-red-800 focus:ring-red-800 text-gray-400">
                <option value="">{{ __('property.land') }}</option>
                @foreach($allSurfaces as $label => [$min, $max])
                    <option value="{{ $min }},{{ $max }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <!-- end surface des biens -->

        <!-- prix des biens -->
        <div>
            <select name="price" class="w-full border-gray-200 ring-red-800 focus:ring-red-800 text-gray-400">
                <option value="">{{ __('property.price') }}</option>
                @foreach($allPrices as $label => [$min, $max])
                    <option value="{{ $min }},{{ $max }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <!-- end prix des biens -->

        <!-- référence -->
        <div>
            <input name="reference" class="w-full border-gray-200 ring-red-800 focus:ring-red-800 text-gray-400 placeholder:text-gray-400" placeholder="Reference">
        </div>
        <!-- end référence -->

        <button type="submit" class="w-full bg-red-800 hover:bg-red-900 text-white font-bold p-2 rounded-sm">{{ __('property.search') }}</button>

    </form>

</section>
