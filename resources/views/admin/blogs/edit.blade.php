<x-app-layout>
    @push('dedicated_css')
        <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs Edit') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">

        <div class="w-full flex justify-between items-center ">
            <a href="{{ route('back.blog.index') }}" class="w-1/10 bg-gray-300 text-gray-500 p-2 rounded-md">< back</a>
            <a href="{{ route('back.blog.translate', ['blog' => $blog]) }}" class="flex items-center gap-1 w-1/10 bg-blue-500 text-white p-2 rounded-md">
                <x-fas-language class="h-4"/><span>Translate</span>
            </a>
        </div>

        <!-- edition de l'article -->
        <div class="w-full basis-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <form action="{{ route('back.blog.update', ['blog' => $blog] ) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1">
                    <label for="user_id" class="w-full">Rédacteur:</label>
                    <select name="user_id" class="border-gray-200">
                        @foreach(\App\Models\User::redactor()->get() as $user)
                            <option value="{{ $user->id }}" @selected($user->id === $blog->user_id)>{{ $user->fullname }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- tabs wrapper -->
                <div x-data="{ current: 0 }" class="tab-wrapper w-full py-4">

                    <!-- button tabs -->
                    <div class="flex overflow-hidden rounded-t-lg border-b-2 border-gray-900">
                        @foreach($blog->translates as $translate)
                            <button type="button"
                                    class="px-4 py-2 w-full"
                                    x-on:click="current = {{ $loop->index }}"
                                    x-bind:class="{ 'text-black bg-blue-200': current === {{ $loop->index }} }">version: {{ $translate->locale }}</button>
                        @endforeach
                    </div><!-- ./end button tabs -->

                    <!-- item tabs -->
                    <div>
                        @foreach($blog->translates as $translate)
                            <div x-show="current === {{ $loop->index }}" class="p-3 mt-6 flex flex-col gap-4">
                                <input type="hidden" name="translate[{{$translate->locale}}][id]" value="{{ $translate->id }}">

                                <!-- title de l'article -->
                                <div>
                                    <label for="translate[{{$translate->locale}}][title]">Titre :</label>
                                    <input type="text"
                                           class="w-full rounded-md p-3"
                                           id="translate[{{$translate->locale}}][title]"
                                           name="translate[{{$translate->locale}}][title]"
                                           value="{{ old('translate.'.$translate->locale.'.title') ?? $translate->title }}">
                                </div>

                                <!-- seo -->
                                <div class="bg-gray-50 p-4">

                                    <span>SEO</span>

                                    <!-- slug de l'article -->
                                    <div>
                                        <label for="translate[{{$translate->locale}}][slug]">Slug :</label>
                                        <input type="text"
                                               class="w-full rounded-md p-3"
                                               id="translate[{{$translate->locale}}][slug]"
                                               name="translate[{{$translate->locale}}][slug]"
                                               value="{{ old('translate.'.$translate->locale.'.slug') ?? $translate->slug }}">
                                    </div>

                                    <!-- meta_title de l'article -->
                                    <div>
                                        <label for="translate[{{$translate->locale}}][meta_title]">meta_title :</label>
                                        <input type="text"
                                               class="w-full rounded-md p-3"
                                               id="translate[{{$translate->locale}}][meta_title]"
                                               name="translate[{{$translate->locale}}][meta_title]"
                                               value="{{ old('translate.'.$translate->locale.'.meta_title') ?? $translate->meta_title }}">
                                    </div>

                                    <!-- meta_desc de l'article -->
                                    <div>
                                        <label for="translate[{{$translate->locale}}][meta_desc]">meta_desc :</label>
                                        <input type="text"
                                               class="w-full rounded-md p-3"
                                               id="translate[{{$translate->locale}}][meta_desc]"
                                               name="translate[{{$translate->locale}}][meta_desc]"
                                               value="{{ old('translate.'.$translate->locale.'.meta_desc') ?? $translate->meta_desc }}">
                                    </div>

                                </div>

                                <!-- categories -->
                                <div>
                                    <label for="category_id">Catégorie</label>
                                    <select name="category[{{$translate->locale}}][category_id]" class="w-full border-gray-200">
                                        @foreach(\App\Models\Category::where('locale', $translate->locale)->get() as $category)
                                            <option value="{{ $category->id }}" @if($blog->categories()->locale()->first()) @selected($blog->categories()->locale()->first()->id === $category->id) @endif>
                                                {{ $category->name }} ({{ $category->locale }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- tags -->
                                <div class="flex flex-col gap-1">
                                    <label for="tags">Tags</label>
                                    <input name="tags[{{$translate->locale}}]" type="text" class="border-gray-200">
                                    <input type="hidden" name="tags_list[{{$translate->locale}}]" value="">
                                </div>

                                <!-- intro de l'article -->
                                <div>
                                    <label for="translate[{{$translate->locale}}][intro]">Intro :</label>
                                    <textarea class="w-full rounded-md p-3" name="translate[{{$translate->locale}}][intro]">{!! old('translate.'.$translate->locale.'.intro') ?? $translate->intro !!}</textarea>
                                </div>

                                <!-- content de l'article -->
                                <div>
                                    <label for="translate[{{$translate->locale}}][content]">Content :</label>
                                    <textarea class="w-full rounded-md p-3" name="translate[{{$translate->locale}}][content]">{!! old('translate.'.$translate->locale.'.content') ?? $translate->content !!}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- ./end item tabs -->

                </div><!-- ./end tabs wrapper -->

                <div class="flex gap-2 p-2">
                    <!-- image de l'article -->
                    <div class="w-1/2">
                        @if($blog->image)
                            <img class="w-full py-2" src="{{ asset('storage/blog/'.$blog->image) }}" alt="none">
                        @endif
                        <input type="file" name="image" class="border-gray-200">
                    </div>
                    <!-- end image de l'article -->

                </div>

                <div class="py-4 flex justify-center">
                    <button type="submit" class=" ring ring-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white p-2 rounded-md">Mettre à jour</button>
                </div>
            </form>

        </div>
        <!-- end edition de l'article -->

    </div>

@push('dedicated_js')
<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/{{ config('tinymce.api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
    tinymce.init({
        selector: 'textarea',
        height: 500,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
@foreach(config('app.available_locales') as $locale)
    @php
    $currentTagsList[$locale] = array();

    foreach ( $blog->tags()->get() as $tag )
    {
        if( $tag->locale === $locale){
            $currentTagsList[$locale][] = ['id' => $tag->id ,'value' => $tag->name];
        }
    }

    $localeTagList[$locale] = array();

    foreach (\App\Models\Tag::all() as $tag)
    {
        if( $tag->locale === $locale){
            $localeTagList[$locale][] = ['id' => $tag->id ,'value' => $tag->name];
        }
    }

    @endphp
<script type="module">
    let input_{{$locale}} = document.querySelector('input[name="tags[{{$locale}}]"]');

    let tag_list_input_{{$locale}} = document.querySelector('input[name="tags_list[{{ $locale }}]"]');

    // initialize Tagify on the above input node reference
    let tagify_{{$locale}} = new Tagify(input_{{$locale}}, {
        whitelist: {!! json_encode($localeTagList[$locale]) !!},
        maxTags: 10,
        dropdown: {
            maxItems: 20,           // <- mixumum allowed rendered suggestions
            classname: 'tags-look', // <- custom classname for this dropdown, so it could be targeted
            enabled: 0,             // <- show suggestions on focus
            closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
        },
        texts: {
            duplicate: "Duplicates are not allowed"
        },
        callbacks:{
            add: function (e){
                //init un tableau
                let listTag = [];

                //init un booleen pour savoir si le tag est dans la whitelist ou pas
                let is_in_whitelist = false;

                //itère sur les item de la whitelist
                e.detail.tagify.whitelist.forEach(function (item){
                    if(e.detail.data.value === item.value){
                        return is_in_whitelist = true;
                    }
                });

                //si l'input tag_list n'est pas vide
                if(tag_list_input_{{$locale}}.value !== "")
                {
                    //transform la chaine contenue dans l'input en array
                    let array = [tag_list_input_{{$locale}}.value.split(',')];

                    //itère sur le tableau,
                    array.forEach( function (value){
                        //ajoute chaque valeur dans le tableau
                        listTag.push( String(value));
                    });
                }

                //si le tag est dans la whiteliste
                if(is_in_whitelist) {
                    //on met l'id du tag dans le tableau
                    listTag.push(String(e.detail.data.id));
                }else {
                    //sinon on met la valeur de la chaine dans le tableau
                    listTag.push(String(e.detail.data.value));
                }

                //ajoute les valeurs de tags dans l'input caché
                tag_list_input_{{$locale}}.value = listTag;
            },
            remove:function (e){

                //récupère la liste des tags sous forme de tableau
                let arrayTagList = tag_list_input_{{$locale}}.value.split(',');

                //détermine l'index de la valeur à supprimer dans le tableau
                let index = arrayTagList.indexOf(String(e.detail.data.id));

                //supprime la valeur par son index dans le tableau
                arrayTagList.splice(index, 1);

                //set l'input tag_list avec les nouvelles valeurs
                tag_list_input_{{$locale}}.value = arrayTagList;
            }
        }
    });

    //ajoute dynamiquement les tags dans l'input.
    tagify_{{$locale}}.addTags( {!! json_encode($currentTagsList[$locale]) !!} );
</script>
@endforeach
@endpush
</x-app-layout>
