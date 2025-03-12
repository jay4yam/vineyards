<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">

        <div class="w-full flex justify-end">
            <a href="{{ route('backuser.create', app()->getLocale()) }}" class="text-right w-1/10 bg-gray-500 text-white p-2 rounded-md">
                Nouvel Utilisateur
            </a>
        </div>

        <!-- users -->
        <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <h2>Users</h2>

            <div class="py-4">

                <table class="table-auto w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">id</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Full Name</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Role</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Avatar</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div>{{ $user->fullname }}</div>
                                <div>
                                    <ul class="flex gap-2 text-xs">
                                        <li class="bg-blue-300 text-blue-950 w-fit p-1 rounded-md">article : {{ $user->blogs_count }}</li>
                                        <li class="bg-orange-300 text-orange-950 w-fit p-1 rounded-md">properties : {{ $user->properties_count }}</li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                {{ $user->role }}
                            </td>
                            <td>
                                <img class="h-14" src="{{ asset('storage/user/'.$user->avatar) }}" alt="">
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <!-- lien edition article -->
                                    <x-edit-backoffice href="{{ route('backuser.edit', [app()->getLocale(), 'backuser' => $user]) }}" />

                                    <!-- lien voir article -->
                                    <x-form-delete-backoffice action="{{ route('backuser.destroy', [app()->getLocale(), 'backuser' => $user]) }}"/>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

            <div>
                {{ $users->links() }}
            </div>
        </div>
        <!-- end articles blogs -->

    </div>
</x-app-layout>
