<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs Edit') }}
        </h2>
    </x-slot>


    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">

        <div class="w-full flex justify-between items-center ">
            <a href="{{ route('backblog.index', []) }}" class="w-1/10 bg-gray-300 text-gray-500 p-2 rounded-md">< back</a>
            <a href="{{ route('blog.translate', [app()->getLocale(), 'blog' => $backblog]) }}" class="flex items-center gap-1 w-1/10 bg-blue-500 text-white p-2 rounded-md"><x-fas-language class="h-4"/><span>Translate</span></a>
        </div>

        <!-- edition de l'article -->
        <div class="w-full basis-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <form action="{{ route('backblog.update', [app()->getLocale(), 'backblog' => $backblog] ) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="flex flex-col gap-1">
                    <label for="user_id" class="w-full">Rédacteur:</label>
                    <select name="user_id" class="border-gray-200">
                        @foreach(\App\Models\User::redactor()->get() as $user)
                            <option value="{{ $user->id }}" @selected($user->id === $backblog->user_id)>{{ $user->fullname }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- tabs wrapper -->
                <div x-data="{ current: 0 }" class="tab-wrapper w-full py-4">

                    <!-- button tabs -->
                    <div class="flex overflow-hidden rounded-t-lg border-b-2 border-gray-900">
                        @foreach($backblog->translates as $translate)
                            <button type="button"
                                    class="px-4 py-2 w-full"
                                    x-on:click="current = {{ $loop->index }}"
                                    x-bind:class="{ 'text-black bg-blue-200': current === {{ $loop->index }} }">version: {{ $translate->locale }}</button>
                        @endforeach
                    </div><!-- ./end button tabs -->

                    <!-- item tabs -->
                    <div>
                        @foreach($backblog->translates as $translate)
                            <div x-show="current === {{ $loop->index }}" class="p-3 mt-6 flex flex-col gap-4">
                                <input type="hidden" name="translate[{{$translate->locale}}][id]" value="{{ $translate->id }}">

                                <!-- title de l'article -->
                                <div>
                                    <label for="translate[{{$translate->locale}}][title]">Titre :</label>
                                    <input type="text"
                                           class="w-full rounded-md p-3"
                                           id="translate[{{$translate->locale}}][title]"
                                           name="translate[{{$translate->locale}}][title]"
                                           value="{{ old($translate->title, $translate->title) }}">
                                </div>

                                <!-- seo -->
                                <div class="bg-gray-50 p-4">

                                    <span>SEO</span>

                                    <div>
                                        <label for="translate[{{$translate->locale}}][slug]">Slug :</label>
                                        <input type="text"
                                               class="w-full rounded-md p-3"
                                               id="translate[{{$translate->locale}}][slug]"
                                               name="translate[{{$translate->locale}}][slug]"
                                               value="{{ old($translate->slug, $translate->slug) }}">
                                    </div>

                                    <!-- meta_title de l'article -->
                                    <div>
                                        <label for="translate[{{$translate->locale}}][meta_title]">meta_title :</label>
                                        <input type="text"
                                               class="w-full rounded-md p-3"
                                               id="translate[{{$translate->locale}}][meta_title]"
                                               name="translate[{{$translate->locale}}][meta_title]"
                                               value="{{ old($translate->meta_title, $translate->meta_title) }}">
                                    </div>

                                    <!-- meta_desc de l'article -->
                                    <div>
                                        <label for="translate[{{$translate->locale}}][meta_desc]">meta_desc :</label>
                                        <input type="text"
                                               class="w-full rounded-md p-3"
                                               id="translate[{{$translate->locale}}][meta_desc]"
                                               name="translate[{{$translate->locale}}][meta_desc]"
                                               value="{{ old($translate->meta_desc, $translate->meta_desc) }}">
                                    </div>

                                </div>


                                <!-- intro de l'article -->
                                <div>
                                    <label for="translate[{{$translate->locale}}][intro]">Intro :</label>
                                    <textarea class="w-full rounded-md p-3"
                                              id="translate[{{$translate->locale}}][intro]"
                                              name="translate[{{$translate->locale}}][intro]">{{ old($translate->intro, $translate->intro) }}</textarea>
                                </div>

                                <div>
                                    <label for="translate[{{$translate->locale}}][content]">Content :</label>
                                    <textarea class="w-full rounded-md p-3"
                                              id="translate[{{$translate->locale}}][content]"
                                              name="translate[{{$translate->locale}}][content]">{{ old($translate->content, $translate->content) }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- ./end item tabs -->

                </div><!-- ./end tabs wrapper -->

                <div class="flex gap-2 p-2">
                    <!-- image de l'article -->
                    <div class="w-1/2">
                        @if($backblog->image)
                            <img class="w-full py-2" src="{{ asset('storage/blog/'.$backblog->image) }}" alt="none">
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
        <script src="https://cdn.tiny.cloud/1/dsnrqd6wanwpw9ttx90g1id6n31mhs3ooj2njnn63k3brdq9/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
        <script>
            tinymce.init({
                selector: 'textarea',
            });
        </script>
    @endpush
</x-app-layout>
