<div class="w-full flex justify-between bg-gray-200 p-2 text-xs">
    <a href="{{ route('properties.show', ['slug' => \Illuminate\Support\Str::slug($previousProperty->comment->title), 'property' => $previousProperty->id]) }}" class="hover:text-red-800 hover:underline">< {{__('property.prev')}}</a>
    <a href="{{ route('properties.index') }}" class="hover:text-red-800 hover:underline">{{__('property.back')}}</a>
    <a href="{{ route('properties.show', ['slug' => \Illuminate\Support\Str::slug($nextProperty->comment->title), 'property' => $nextProperty->id]) }}" class="hover:text-red-800 hover:underline">{{__('property.next')}} ></a>
</div>
