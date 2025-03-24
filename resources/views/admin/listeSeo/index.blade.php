<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste Seo') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">

        <div class="w-full flex justify-end">
            <a href="{{ route('back.listeseo.create') }}" class="text-right w-1/10 bg-gray-500 text-white p-2 rounded-md">
                Nouvelle Liste
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
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Name</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Departements Produits</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allListes as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>
                                <div>{{ $list->name }}</div>
                                <div class="text-xs italic">url:{{ $list->slug }}</div>
                            </td>
                            <td>{{ implode(',' , $list->property_prefix_codes) }}</td>
                            <td>
                                <div class="flex gap-2">
                                    <!-- lien edition liste -->
                                    <x-edit-backoffice href="{{ route('back.listeseo.edit', ['listeseo' => $list]) }}" />

                                    <!-- lien suppression article -->
                                    <x-form-delete-backoffice action="{{ route('back.listeseo.destroy', ['listeseo' => $list]) }}"/>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

            <div>

            </div>
        </div>
        <!-- end liste seo -->

    </div>
</x-app-layout>
