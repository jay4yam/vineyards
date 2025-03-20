<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs Edit') }}
        </h2>
    </x-slot>


    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">

        <div class="w-full">
            <a href="{{ route('back.blog.index', app()->getLocale() ) }}" class="w-1/10 bg-gray-300 text-gray-500 p-2 rounded-md">< back</a>
        </div>

        <!-- edition de l'article -->
        <div class="w-full basis-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <form action="{{ route('back.blog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="flex flex-col gap-1">
                    <label for="user_id" class="w-full">Rédacteur:</label>
                    <select name="user_id" class="border-gray-200">
                        @foreach(\App\Models\User::redactor()->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- tabs wrapper -->
                <div class="tab-wrapper w-full py-4">

                    <!-- item tabs -->
                    <div>

                        <div  class="p-3 mt-6 flex flex-col gap-4">

                            <!-- title de l'article -->
                            <div>
                                <label for="translate[fr][title]">Titre :</label>
                                <input type="text"
                                       value="{{ old('translate[fr][title]') }}"
                                       class="w-full rounded-md p-3"
                                       id="translate[fr][title]"
                                       name="translate[fr][title]" required>
                            </div>

                            <!-- seo -->
                            <div class="bg-gray-50 p-4">

                                <span>SEO</span>

                                <div>
                                    <label for="translate[fr][slug]">Slug :</label>
                                    <input type="text"
                                           value="{{ old('translate[fr][slug]') }}"
                                           class="w-full rounded-md p-3"
                                           id="translate[fr][slug]"
                                           name="translate[fr][slug]" required>
                                </div>

                                <!-- meta_title de l'article -->
                                <div>
                                    <label for="translate[fr][meta_title]">meta_title :</label>
                                    <input type="text"
                                           value="{{ old('translate[fr][meta_title]') }}"
                                           class="w-full rounded-md p-3"
                                           id="translate[fr][meta_title]"
                                           name="translate[fr][meta_title]" required>
                                </div>

                                <!-- meta_desc de l'article -->
                                <div>
                                    <label for="translate[fr][meta_desc]">meta_desc :</label>
                                    <input type="text"
                                           value="{{ old('translate[fr][meta_desc]') }}"
                                           class="w-full rounded-md p-3"
                                           id="translate[fr][meta_desc]"
                                           name="translate[fr][meta_desc]" required>
                                </div>

                            </div>

                            <!-- categories -->
                            <div>
                                <label for="category_id">Catégorie</label>
                                <select name="category['fr'][category_id]" class="w-full border-gray-200">
                                    @foreach(\App\Models\Category::where('locale', 'fr')->get() as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }} ({{ $category->locale }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- intro de l'article -->
                            <div>
                                <label for="translate[fr][intro]">Intro :</label>
                                <textarea class="w-full rounded-md p-3"
                                          id="translate[fr][intro]"
                                          name="translate[fr][intro]">{{ old('translate[fr][intro]') }}</textarea>
                            </div>

                            <!-- content de l'article -->
                            <div>
                                <label for="translate[fr][content]">Content :</label>
                                <textarea class="w-full rounded-md p-3"
                                          id="translate[fr][content]"
                                          name="translate[fr][content]">{{ old('translate[fr][content') }}</textarea>
                            </div>
                        </div>

                    </div><!-- ./end item tabs -->

                </div><!-- ./end tabs wrapper -->

                <div class="flex gap-2 p-2">
                    <!-- image de l'article -->
                    <div class="w-1/2">
                        <input type="file" name="image" class="border-gray-200" required>
                    </div>
                    <!-- end image de l'article -->

                </div>

                <div class="py-4 flex justify-center">
                    <button type="submit" class=" ring ring-green-500 text-green-500 hover:bg-green-500 hover:text-white p-2 rounded-md">Enregistrer</button>
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
