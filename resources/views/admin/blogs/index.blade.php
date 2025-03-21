<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">

        <div class="w-full flex justify-end">
            <a href="{{ route('back.blog.create', ) }}" class="text-right w-1/10 bg-orange-500 text-white p-2 rounded-md">Nouvel Article</a>
        </div>

        <!-- article -->
        <div class="w-full bg-white overflow-hidden drop-shadow shadow-sm sm:rounded-lg p-6 text-gray-900">

            <h2>Articles</h2>

            <div class="py-4">
                <table class="table-auto w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">id</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Titre</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Publié par</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Image</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>
                                <div>{{ $article->translate->title }}</div>
                                <div>
                                    <ul class="flex text-xs gap-2">
                                    @foreach($article->translates as $trans)
                                        <li class="bg-blue-500 p-1 text-white rounded-md">{{ $trans->locale }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div>{{ $article->user->firstname }} {{ $article->user->lastname }}</div>
                                <div class="text-xs italic">le {{ $article->created_at->format('d M Y') }}</div>
                            </td>
                            <td><img class="h-14" src="{{ asset('storage/blog/'.$article->image) }}" alt=""></td>
                            <td>
                                <div class="flex gap-2">
                                    <!-- lien edition article -->
                                    <x-edit-backoffice href="{{ route('back.blog.edit', ['blog' => $article]) }}" />

                                    <!-- lien voir article -->
                                    <x-show-backoffice target="_blank" href="{{ route('blog.show', ['locale' => app()->getLocale(), 'blog' => $article, 'slug' => \Illuminate\Support\Str::slug($article->translate->title)]) }}"/>

                                    <!-- lien voir article -->
                                    <x-form-delete-backoffice action="{{ route('back.blog.destroy', ['blog' => $article]) }}"/>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <div>
                {{ $articles->links() }}
            </div>
        </div>
        <!-- end articles blogs -->

        <div class="w-1/3 bg-white drop-shadow p-6">
            <h3>Categories</h3>

            <form action="{{ route('back.category.update_or_create', ['category' => request('category_id') ?? null]) }}" method="post" class="flex gap-1 py-2">
                @csrf
                @method('patch')
                <input type="hidden" name="create_or_update" value="{{ request('type') ?? 'create' }}">

                <div class="w-full">
                    <input type="text" name="categorie" class="w-full border-gray-200" placeholder="nouvelle catégorie" value="{{ request('category_name') }}">
                    @error('categorie')<p class="text-red-800">{{ $message }}</p>@enderror
                </div>
                <div>
                    <select name="locale" class="border-gray-200">
                        @foreach(config('app.available_locales') as $locale)
                            <option value="{{ $locale }}">{{ $locale }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-green-700 text-white hover:bg-green-600 p-2 rounded-md">{{ request('type') ?? 'create' }}</button>
            </form>

            <div>
                <table class="table-auto w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">name</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">lang</th>
                        <th scope="col" class="p-2 text-right text-sm font-medium text-slate-900">Options</th>
                    </tr>
                    </thead>
                @foreach($categories as $category)
                    <tr>
                        <td class="py-2">{{ $category->name }} <span class="text-xs italic">({{ $category->posts_count }})</span></td>
                        <td><img class="h-4" src="{{ asset('images/flag_'.$category->locale.'.webp') }}" alt=""></td>
                        <td>
                            <div class="flex gap-2 justify-end">
                                <!-- lien edition article -->
                                <x-edit-backoffice href="{{ route('back.blog.index', ['category_id' => $category->id, 'category_name' => $category->name, 'type' => 'update']) }}" />

                                <!-- lien voir article -->
                                <x-form-delete-backoffice action="{{ route('back.category.destroy', ['category' => $category]) }}"/>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
