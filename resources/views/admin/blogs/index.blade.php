<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">

        <div class="w-full flex justify-end">
            <a href="{{ route('backblog.create', ) }}" class="text-right w-1/10 bg-orange-500 text-white p-2 rounded-md">Nouvel Article</a>
        </div>

        <!-- article -->
        <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

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
                                    <x-edit-backoffice href="{{ route('backblog.edit', [app()->getLocale(), 'backblog' => $article]) }}" />

                                    <!-- lien voir article -->
                                    <x-show-backoffice target="_blank" href="{{ route('blog.show', ['locale' => app()->getLocale(), 'blog' => $article, 'slug' => \Illuminate\Support\Str::slug($article->translate->title)]) }}"/>

                                    <!-- lien voir article -->
                                    <x-form-delete-backoffice action="{{ route('backblog.destroy', [app()->getLocale(), 'backblog' => $article]) }}"/>
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

    </div>
</x-app-layout>
