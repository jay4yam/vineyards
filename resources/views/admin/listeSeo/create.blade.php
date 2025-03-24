<x-app-layout>
    @push('dedicated_css')
        <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle Liste Seo') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">


        <!-- liste seo -->
        <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <form action="{{ route('back.listeseo.store') }}" class="flex flex-col gap-2" method="post">
                @csrf
                @method('post')
                <!-- liste des departements qui sera envoyée au formulaire -->
                <input type="hidden" name="liste_departement" value="">

                <!-- nom de la liste -->
                <div class="flex flex-col gap-1">
                    <label for="name">Nom de la Liste</label>
                    <input type="text" name="name" class="w-full border-gray-200" value="{{ old('name') }}">
                </div>
                <!-- end nom de la liste -->

                <div class="flex items-center gap-2">

                    <div class="w-full flex flex-col gap-1">
                        <label for="property_prefix_codes">Créer une liste par Régions Viticole</label>
                        <select name="region_viticole" class="w-full border-gray-200">
                            <option value="null">Liste de régions viticoles</option>
                            @foreach(config('property_regions') as $region => $departement)
                                <option value="{{ implode(',', $departement) }}">{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="px-4"> ou </div>

                    <!-- liste departements des produits pour la liste seo -->
                    <div class="w-full flex flex-col gap-1">
                        <label for="property_prefix_codes">Créer une liste par département</label>
                        <input type="text" name="property_prefix_codes" class="w-full border-gray-200">
                    </div>
                    <!-- end liste departements des produits pour la liste seo -->
                </div>
                <button class="bg-green-700 text-white p-2 w-fit rounded-sm">Enregistrer</button>

            </form>

        </div>
        <!-- end liste seo -->

    </div>
@push('dedicated_js')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script type="module">
    @php
        $currentTagsList = \App\Models\City::whereHas('properties')
        ->select('prefix_code')
        ->distinct()
        ->get()
        ->map(function ($city) {
           return ['value' => $city->prefix_code];
       })->values()
       ->toArray();
    @endphp
    let input = document.querySelector('input[name="property_prefix_codes"]');

    let departement_list = document.querySelector('input[name="liste_departement"]');

    // initialize Tagify on the above input node reference
    let tagify = new Tagify(input, {
        whitelist: {!! json_encode($currentTagsList) !!},
        maxTags: 10,
        dropdown: {
            maxItems: 20,           // <- mixumum allowed rendered suggestions
            classname: 'tags-look', // <- custom classname for this dropdown, so it could be targeted
            enabled: 0,             // <- show suggestions on focus
            closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
        },
        callbacks: {
            add: function (e) {
                //init un tableau
                let listTag = [];

                //si l'input tag_list n'est pas vide
                if (departement_list.value !== "") {
                    //transform la chaine contenue dans l'input en array
                    let array = [departement_list.value.split(',')];

                    //itère sur le tableau,
                    array.forEach(function (value) {
                        //ajoute chaque valeur dans le tableau
                        listTag.push(String(value));
                    });
                }

                //pousse le contenu du tagify dans le tableau
                listTag.push(String(e.detail.data.value));

                //ajoute les valeurs de tags dans l'input caché
                departement_list.value = listTag;
            },
            remove: function (e) {
                let arrayTagList = departement_list.value.split(',');
                departement_list.value = arrayTagList.splice(e.detail.data.value, 1);
            },
        },
    });

    //ajoute dynamiquement les tags dans l'input.
    //tagify.addTags();
</script>
@endpush
</x-app-layout>
