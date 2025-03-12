<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 py-12 max-w-7xl mx-auto px-8">

        <!-- users -->
        <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

            <h2>Users</h2>

            <div class="py-4">

                <table class="table-auto w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">id</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Information</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Address IP</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">sources</th>
                        <th scope="col" class="p-2 text-left text-sm font-medium text-slate-900">Reference</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>
                                <div>{{ $contact->name }}</div>
                                <div>
                                    <ul class="flex gap-2 text-xs">
                                        <li>phone : {{ $contact->phone }}</li>
                                        <li>email : {{ $contact->email }}</li>
                                    </ul>
                                </div>
                            </td>
                            <td>
                                {{ $contact->ip_address }}
                            </td>
                            <td>{{ $contact->sources }}</td>
                            <td>{{ $contact->reference }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

            <div>
                {{ $contacts->links() }}
            </div>
        </div>
        <!-- end articles blogs -->

    </div>
</x-app-layout>
