<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 gap-4 py-12 max-w-7xl mx-auto px-8">

        <!-- contacts -->
    <div class="col-span-2 lg:col-span-1 w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <h2>Contacts</h2>

            <div class="py-4">
                <table class="table-auto w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">id</th>
                            <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Name</th>
                            <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">email</th>
                            <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">source</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($lastContacts as $contact)
                        <tr class="odd:bg-white even:bg-slate-50">
                            <td class="py-2 text-sm">{{ $contact->id }}</td>
                            <td class="py-2 text-sm">{{ $contact->name }}</td>
                            <td class="py-2 text-sm">{{ $contact->email }}</td>
                            <td class="py-2 text-sm">{{ $contact->sources }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <a href="" class="bg-red-800 text-white px-4 py-2 float-right hover:ring-1 hover:ring-red-800 hover:bg-white hover:text-red-800">voir</a>

        </div>
        <!-- end contacts -->

        <!-- users -->
        <div class="col-span-2 lg:col-span-1 w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <h2>Users</h2>

            <div class="py-4">
                <table class="table-auto w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">FirstName</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">LastName</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lastUsers as $user)
                        <tr class="odd:bg-white even:bg-slate-50">
                            <td class="py-2 text-sm">{{ $user->firstname }}</td>
                            <td class="py-2 text-sm">{{ $user->lastname }}</td>
                            <td class="py-2 text-sm">{{ $user->email }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <a href="" class="bg-red-800 text-white px-4 py-2 float-right hover:ring-1 hover:ring-red-800 hover:bg-white hover:text-red-800">voir</a>

        </div>
        <!-- end users -->

        <!-- blog -->
        <div class="col-span-2 w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <h2>Blog</h2>

            <div class="py-4">
                <table class="table-auto w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Title</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Redige par</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Photo</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lastBlogs as $blog)
                        <tr class="odd:bg-white even:bg-slate-50">
                            <td class="py-2 text-sm">{{ $blog->translate->title }}</td>
                            <td class="py-2 text-sm">{{ $blog->user->fullname }}</td>
                            <td class="py-2 text-sm">
                                <img class="w-20" src="{{ asset('storage/blog/'.$blog->image) }}" alt="">
                            </td>
                            <td class="py-2 text-sm">
                                <div class="flex gap-2">
                                    <!-- lien edition article -->
                                    <x-edit-backoffice href="{{ route('back.blog.edit', ['blog' => $blog]) }}" />

                                    <!-- lien voir article -->
                                    <x-show-backoffice target="_blank" href="{{ route('blog.show', ['blog' => $blog, 'slug' => \Illuminate\Support\Str::slug($blog->translate->title)]) }}"/>

                                    <!-- lien voir article -->
                                    <x-form-delete-backoffice action="{{ route('back.blog.destroy', ['blog' => $blog]) }}"/>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <a href="" class="bg-red-800 text-white px-4 py-2 float-right hover:ring-1 hover:ring-red-800 hover:bg-white hover:text-red-800">voir</a>

        </div>
        <!-- end blogs -->

    </div>
</x-app-layout>
