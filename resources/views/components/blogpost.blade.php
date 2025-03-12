<article class="pb-12"
         data-aos="fade-up"
         data-aos-delay="50"
         data-aos-duration="1000"
         data-aos-easing="ease-in-out"
         data-aos-anchor-placement="top-bottom">

    <!-- image de l'article -->
    <img src="{{ asset('storage/blog/'.$blog->image) }}" alt="{{ $blog->title }}">

    <!-- lien vers détail de l'article -->
    <a href="{{ route('blog.show', ['slug' => \Illuminate\Support\Str::slug($blog->translate->title), 'blog' => $blog]) }}">
        <h2 class="pt-6 text-2xl font-bold">{{ $blog->translate->title }}</h2>
    </a>

    <!-- tag, categories, date, user -->
    <ul class="flex gap-2 text-xs text-red-800 pt-2 pb-4">
        <li>
            @foreach($blog->tags as $tag)
                {{ $tag->name }} @if(!$loop->last),@endif
            @endforeach
        </li>
        <li>|</li>
        <li>
            @foreach($blog->categories as $cat)
                {{ $cat->name }} @if(!$loop->last),@endif
            @endforeach
        </li>
        <li>|</li>
        <li>{{ $blog->created_at->format('M Y') }}</li>
        <li>|</li>
        <li>{{ $blog->user->firstname }} {{ $blog->user->lastname }}</li>
    </ul>

    <!-- intro de l'article -->
    <div class="text-gray-500 pb-4">
        <p>{!! $blog->translate->intro !!}</p>
    </div>

    <button class="uppercase border border-red-800 text-red-800 py-1 px-4 hover:bg-red-800 hover:text-white delay-100 transition-all">{{ __('blog.read_more') }}</button>
</article>
