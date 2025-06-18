<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-xl text-center font-bold w-full bg-yellow-200 p-4 mb-4">
                        <h2 class="text-xl ">Liste des utilisateurs</h2>
                    </div>

                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="border border-gray-300 p-2">Nom</th>
                                <th class="border border-gray-300 p-2">Statut</th>
                                <th class="border border-gray-300 p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userList as $userLists)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ $userLists->name }}</td>
                                    <td class="border border-gray-300 p-2">
                                        @if($userLists->status == 'online')
                                            <span class="text-green-500 font-semibold">🟢 En ligne</span>
                                        @else
                                            <span class="text-gray-500 font-semibold">⚪ Hors ligne</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 p-2 text-center">
                                        <a href="{{ route('Messages.index', $userLists->id) }}" class="">
                                            <i class="fas fa-envelope mr-2"></i>
                                            Envoyer un message
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>