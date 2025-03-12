<form {{ $attributes->merge([ "action" => "" ]) }} method="post" onsubmit="return confirm('Do you really want to delete this');">
    @method('delete')
    @csrf
    <button type="submit" class="ring-1 ring-red-600 hover:bg-red-600 hover:text-white p-2 text-red-600 rounded-md">
        <x-far-trash-alt class="h-4"/>
    </button>
</form>
