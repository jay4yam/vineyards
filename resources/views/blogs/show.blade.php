<x-front-layout :seoData="$seoData">

    <header class="relative flex items-center justify-center h-24 lg:h-96 w-full" style="background: center/cover fixed url('{{ asset('images/bg-listing.webp') }}');">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 drop-shadow">
            <span class="font-retro text-7xl text-white text-shadow">
                {{ __('menu.handbook') }}
            </span>
        </div>
    </header>

    <!-- détail de l'articles -->
    <section class="container mx-auto p-6 lg:p-12 lg:px-48 flex flex-col lg:flex-row gap-6">

        <!-- colonnes détail article -->
        <div class="w-full lg:w-3/4">
            <article>
                <!-- titre -->
                <h1 class="text-2xl font-bold">{{ $blog->translate->title }}</h1>

                <!-- tag, cat, date, user article -->
                <ul class="flex gap-2 text-xs text-red-800 pt-2 pb-4">
                    <li>
                        @foreach($blog->tags_translates as $tag)
                        {{ $tag->name }} @if(!$loop->last),@endif
                        @endforeach
                    </li>
                    <li>|</li>
                    <li>
                        @foreach($blog->category as $cat)
                            {{ $cat->name }} @if(!$loop->last),@endif
                        @endforeach
                    </li>
                    <li>|</li>
                    <li>{{ $blog->created_at->format('M Y') }}</li>
                    <li>|</li>
                    <li>{{ $blog->user->firstname }} {{ $blog->user->lastname }}</li>
                </ul>

                <!-- intro article -->
                <div class="text-gray-500 text-justify pb-4">
                    {!! $blog->translate->intro !!}
                </div>

                <!-- image article -->
                <img class="w-full py-6" src="{{ asset('storage/blog/'.$blog->image) }}" alt="{{ $blog->title }}">

                <!-- contenu de l'article -->
                <div id="blog_content" class="text-gray-500 text-justify">
                    {!! $blog->translate->content !!}
                </div>

                <!-- bouttons share-this -->
                <div class="py-6">
                    <div class="sharethis-inline-share-buttons"></div>
                </div>
            </article>

            <!-- about users -->
            <div class="flex gap-6 border-y border-gray-200 my-12 lg:my-24 py-2 lg:py-8">
                <img class="w-32 h-fit" src="{{ asset('storage/user/'.$blog->user->avatar) }}" alt="{{ $blog->user->firstname }} {{ $blog->user->lastname }}">
                <div class="flex flex-col justify-around">
                    <h6 class="font-bold">{{ __('blog.about') }} {{ $blog->user->firstname }} {{ $blog->user->lastname }}</h6>
                    <div class="py-4 text-xs text-justify">{!! $blog->user->biography  !!}</div>
                    <a href="" class="text-xs hover:text-red-800">{{ __('blog.see_all_user_post', ['firstname' => $blog->user->firstname, 'lastname' => $blog->user->lastname]) }}</a>
                </div>
            </div>

            <!-- deux articles connexes -->
            <div class="flex flex-col lg:flex-row justify-between gap-12">

                @foreach($connexePosts as $post)
                    <a href="{{ route('blog.show', ['slug' => \Illuminate\Support\Str::slug($blog->translate->title), 'blog' => $blog]) }}">
                        <div class="flex gap-2">
                            <img class="w-1/3" src="{{ asset('storage/blog/'.$post->image) }}" alt="{{ $blog->translate->title }}">
                            <div class="w-2/3 flex flex-col justify-between gap-2">
                                <span class="text-base lg:text-lg font-bold">{{ \Illuminate\Support\Str::limit($post->translate->title, 40, '...') }}</span>
                                <span class="text-sm text-gray-400">{{ $post->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <!-- end colonnes des articles -->

        <!-- colonnes des infos -->
        @include('blogs._aside')

    </section>

</x-front-layout>
