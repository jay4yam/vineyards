<ul class=" flex gap-2">

    <li class="group relative">

        <img class="h-4" src="{{ asset('images/flag_'. app()->getLocale() .'.webp') }}" alt="{{ app()->getLocale() }}">

        <ul class="hidden group-hover:block absolute">
            @foreach( $langageLinks as $lang => $link)
                @if($lang != app()->getLocale())
                    <li class="py-2">
                        <a href="{{ $link }}">
                            <img class="h-4" src="{{ asset('images/flag_'.$lang.'.webp') }}" alt="traduction en {{ $lang }}">
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
</ul>
