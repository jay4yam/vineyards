<div class="w-1/4 px-6 flex flex-col">

    <!-- category -->
    <aside>
        <h5 class="uppercase text-xl font-bold font-eurostile text-gray-400 py-4">{{ __('blog.category') }}</h5>
        <ul class="list-disc list-inside">
            @foreach($allCategories as $cat)
                <li class="text-xs italic py-1 px-4">
                    <a href="" class="hover:text-red-800">{{ $cat->name }} ({{ $cat->posts_count }})</a>
                </li>
            @endforeach
        </ul>
    </aside>
    <!-- end category -->

    <!-- search -->
    <aside class="border-t border-t-gray-200 my-6 py-12">
        <h5 class="uppercase text-xl font-bold font-eurostile text-gray-400 mb-6">{{ __('blog.search') }}</h5>
        <form action="" method="post">
            @csrf
            <div>
                <x-text-input id="search_blog" class="relative block mt-1 w-5/4" type="text" name="search_blog" :value="old('search_blog')" required/>
                <x-input-error :messages="$errors->get('search_blog')" class="mt-2"/>
            </div>

        </form>
    </aside>
    <!-- end search -->

    <!-- last articles -->
    <aside class="border-t border-t-gray-200 my-6 py-12">
        <h5 class="uppercase text-xl font-bold font-eurostile text-gray-400 mb-6">{{ __('blog.last') }}</h5>
        <ul class="list-disc list-inside">
            @foreach($lastArticles as $article)
                <li class="text-xs italic py-1 px-4">
                    <a href="{{ route('blog.show', ['blog' => $article, 'slug' => \Illuminate\Support\Str::slug($article->translate->title)]) }}" class="hover:text-red-800">
                        {{ $article->translate->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>
    <!-- end last articles -->

    <!-- tags -->
    <aside class="border-t border-t-gray-200 my-6 py-12">
        <h5 class="uppercase text-xl font-bold font-eurostile text-gray-400 mb-6">{{ __('blog.tags') }}</h5>
        <div class="flex flex-wrap gap-2">
            @foreach($allTags as $tag)
                <a href="" class="p-2 border border-red-800 text-red-800 hover:text-white hover:bg-red-800">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </aside>
    <!-- end tags -->
</div>
