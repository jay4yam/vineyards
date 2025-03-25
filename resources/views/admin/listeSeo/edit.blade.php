<x-app-layout>
    @push('dedicated_css')
        <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste Seo') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">

        <div class="w-full flex justify-between items-center ">
            <a href="{{ route('back.listeseo.index') }}" class="w-1/10 bg-gray-300 text-gray-500 p-2 rounded-md">< back</a>
            <a href="{{ route('back.listeseo.translate', ['listeseo' => $listeseo]) }}" class="flex items-center gap-1 w-1/10 bg-blue-500 text-white p-2 rounded-md">
                <x-fas-language class="h-4"/><span>Translate</span>
            </a>
        </div>

        <!-- liste seo -->
        <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <form action="{{ route('back.listeseo.update', ['listeseo' => $listeseo]) }}" class="flex flex-col gap-2" method="post">
                @csrf
                @method('post')
                <!-- liste des departements qui sera envoyée au formulaire -->
                <input type="hidden" name="liste_departement" value="">

                <!-- nom de la liste -->
                <div class="flex flex-col gap-1">
                    <label for="name">Nom de la Liste</label>
                    <input type="text" name="name" class="w-full border-gray-200" value="{{ old('name', $listeseo->name) }}" disabled>
                </div>
                <!-- end nom de la liste -->

                <div class="flex items-center gap-2">

                    <div class="w-full flex flex-col gap-1">
                        <label for="property_prefix_codes">Créer une liste par Régions Viticole</label>
                        <select name="region_viticole" class="w-full border-gray-200">
                            <option value="null">Liste de régions viticoles</option>
                            @foreach(config('property_regions') as $region => $departement)
                                <option value="{{ implode(',', $departement) }}" @selected($departement === $listeseo->property_prefix_codes)>{{ $region }}</option>
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

            </form>

        </div>
        <!-- end liste seo -->

        <!-- traduction liste seo -->
        <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">


            <!-- si la liste contient des traductions -->
            @if(count($listeseo->translates))
                <!-- tabs wrapper -->
                <div x-data="{ current: 0 }" class="tab-wrapper w-full py-4">

                    <form action="{{ route('back.listeseo.update', ['listeseo' => $listeseo]) }}" class="flex flex-col gap-2" method="post">
                        @csrf
                        @method('patch')
                        <!-- liste des departements qui sera envoyée au formulaire -->
                        <input type="hidden" name="listeseo_id" value="{{ $listeseo->id }}">

                        <!-- button tabs -->
                        <div class="flex overflow-hidden rounded-t-lg border-b-2 border-gray-900">
                            @foreach(config('app.available_locales') as $locale)
                                <button type="button" class="px-4 py-2 w-full" x-on:click="current = {{ $loop->index }}"
                                        x-bind:class="{ 'text-black bg-blue-200': current === {{ $loop->index }} }">version: {{ $locale }}</button>
                            @endforeach
                        </div><!-- ./end button tabs -->


                        <!-- item tabs -->
                        <div>
                            @foreach($listeseo->translates as $translate)
                                <div x-show="current === {{ $loop->index }}" class="p-3 mt-6 flex flex-col gap-4">

                                    <input type="hidden" name="translate[{{$translate->locale}}][id]" value="{{ $translate->id }}">

                                    <input type="hidden" name="locale" value="{{$translate->locale}}">

                                    <!-- meta_title de la liste -->
                                    <div>
                                        <label for="translate[{{$translate->locale}}][meta_title_seo]">Title_seo :</label>
                                        <input type="text" class="w-full rounded-md p-3 border-gray-200"
                                               name="translate[{{$translate->locale}}][meta_title_seo]"
                                               value="{{ old('translate.'.$translate->locale.'.meta_title_seo', $translate->meta_title_seo) }}">
                                    </div>

                                    <!-- meta_description_seo la liste -->
                                    <div>
                                        <label for="translate[{{$translate->locale}}][meta_description_seo]">Meta Description Seo :</label>
                                        <input type="text" class="w-full rounded-md p-3 border-gray-200"
                                               name="translate[{{$translate->locale}}][meta_description_seo]"
                                               value="{{ old('translate.'.$translate->locale.'.meta_description_seo', $translate->meta_description_seo) }}">
                                    </div>

                                    <!-- header_h1 de la liste -->
                                    <div>
                                        <label for="translate[{{$translate->locale}}][header_h1]">Header H1 :</label>
                                        <input type="text" class="w-full rounded-md p-3 border-gray-200"
                                               name="translate[{{$translate->locale}}][header_h1]"
                                               value="{{ old('translate.'.$translate->locale.'.header_h1', $translate->header_h1) }}">
                                    </div>

                                    <!-- intro de la liste -->
                                    <div>
                                        <label for="translate[{{$translate->locale}}][intro]">Intro</label>
                                        <textarea type="text" class="w-full rounded-md p-3 border-gray-200" name="translate[{{$translate->locale}}][intro]">{!! old('translate.'.$translate->locale.'.intro', $translate->intro) !!}</textarea>
                                    </div>

                                    <!-- content de la liste -->
                                    <div>
                                        <label for="translate[{{$translate->locale}}][content]">Intro</label>
                                        <textarea type="text" class="w-full rounded-md p-3 border-gray-200" name="translate[{{$translate->locale}}][content]">{!! old('translate.'.$translate->locale.'.content', $translate->content) !!}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div><!-- ./end item tabs -->

                        <button class="bg-green-700 text-white p-2 w-fit rounded-sm">Save</button>

                    </form>

                </div>
                <!-- end tabs wrapper -->

            <!-- si la liste ne contient pas de traduction -->
            @else
                <!-- tabs wrapper -->
                <div x-data="{ current: 0 }" class="tab-wrapper w-full py-4">

                    <form action="{{ route('back.listeseo.update', ['listeseo' => $listeseo]) }}" class="flex flex-col gap-2" method="post">
                        @csrf
                        @method('patch')
                        <!-- liste des departements qui sera envoyée au formulaire -->
                        <input type="hidden" name="listeseo_id" value="{{ $listeseo->id }}">

                        <!-- button tabs -->
                        <div class="flex overflow-hidden rounded-t-lg border-b-2 border-gray-900">

                            <button type="button" class="px-4 py-2 w-full" x-on:click="current = 0" x-bind:class="{ 'text-black bg-blue-200': current === 0 }">
                                version: fr
                            </button>
                        </div>
                        <!-- ./end button tabs -->

                        <!-- container de la traduction -->
                        <div class="flex flex-col gap-2">

                            <input type="hidden" name="locale" value="fr">

                            <!-- meta_title de la liste -->
                            <div>
                                <label for="translate[fr][meta_title_seo]">Title_seo :</label>
                                <input type="text"
                                       class="w-full rounded-md p-3 border-gray-200"
                                       name="translate[fr][meta_title_seo]"
                                       value="{{ old('translate.fr.meta_title_seo') }}">
                            </div>

                            <!-- meta_description_seo la liste -->
                            <div>
                                <label for="translate[fr][meta_description_seo]">Meta Description Seo :</label>
                                <input type="text"
                                       class="w-full rounded-md p-3 border-gray-200"
                                       name="translate[fr][meta_description_seo]"
                                       value="{{ old('translate.fr.meta_description_seo') }}">
                            </div>

                            <!-- header_h1 de la liste -->
                            <div>
                                <label for="translate[fr][header_h1]">Header H1 :</label>
                                <input type="text"
                                       class="w-full rounded-md p-3 border-gray-200"
                                       name="translate[fr][header_h1]"
                                       value="{{ old('translate.fr.header_h1') }}">
                            </div>

                            <!-- intro de la liste -->
                            <div>
                                <label for="translate[fr][intro]">Intro</label>
                                <textarea type="text" class="w-full rounded-md p-3 border-gray-200" name="translate[fr][intro]">{{ old('translate.fr.intro') }}</textarea>
                            </div>

                            <!-- content de la liste -->
                            <div>
                                <label for="translate[fr][content]">Intro</label>
                                <textarea type="text" class="w-full rounded-md p-3 border-gray-200" name="translate[fr][content]">{{ old('translate.fr.content') }}</textarea>
                            </div>

                        </div>
                        <!-- ./end item tabs -->

                    <button class="bg-green-700 text-white p-2 w-fit rounded-sm">Save</button>

                </form>

                </div>
                <!-- end tabs wrapper -->
            @endif
            <!-- si la liste ne contient pas de traduction -->
        </div>

    </div>
@push('dedicated_js')
<!-- tinyMce -->
<script src="https://cdn.tiny.cloud/1/{{ config('tinymce.api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- init tinyMce -->
<script>
    tinymce.init({
        selector: 'textarea',
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script type="module">
    @php
        $whitelist = \App\Models\City::whereHas('properties')
        ->select('prefix_code')
        ->distinct()
        ->get()
        ->map(function ($city) {
           return ['value' => $city->prefix_code];
       })->values()
       ->toArray();

        $currentList = array();

        foreach ($listeseo->property_prefix_codes as $code)
        {
            $currentList[] = ['value' => $code];
        }
    @endphp
    let input = document.querySelector('input[name="property_prefix_codes"]');

    let departement_list = document.querySelector('input[name="liste_departement"]');

    // initialize Tagify on the above input node reference
    let tagify = new Tagify(input, {
        whitelist: {!! json_encode($whitelist) !!},
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
                listTag.push(String(e.detail.data.id));

                //ajoute les valeurs de tags dans l'input caché
                departement_list.value = listTag;
            },
            remove: function (e) {
                let arrayTagList = departement_list.value.split(',');
                departement_list.value = arrayTagList.splice(e.detail.data.index, 1);
            },
        },
    });

    //ajoute dynamiquement les tags dans l'input.
    tagify.addTags({!! json_encode($currentList)  !!});
</script>
@endpush
</x-app-layout>
