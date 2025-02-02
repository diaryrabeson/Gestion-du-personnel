<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liste des Types de Congé') }}
        </h2>
    </x-slot>

    <style>
        .add {
            background-color: rgb(79, 187, 79);
            height: 2em;
            text-align: center;
            padding-top: 0.2em;
            font-weight: bold;
            color: white;
            border-radius: 0.5em;
        }

        .flex1 {
            display: flex;
            justify-content: space-between;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex1">
                        <div>
                            <h3 class="text-xl">Liste des Types de Congé</h3>
                        </div>

                        <!-- Button to add a new type of congé -->
                        <div class="add mb-4">
                            <a href="{{ route('TypeConger.create') }}" class="bg-blue-500 px-4 py-2 rounded">
                                Ajouter un type de congé
                            </a>
                        </div>
                    </div>

                    <!-- List of types of congé -->
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Type de Congé</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($typeCongers as $typeConger)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="border px-4 py-2">{{ $typeConger->id_typeConge }}</td>
                                    <td class="border px-4 py-2">{{ $typeConger->typeConge }}</td>
                                    <td class="border px-4 py-2 flex justify-between">
                                        <!-- Edit button -->
                                        <a href="{{ route('TypeConger.edit', $typeConger->id_typeConge) }}" class="bg-yellow-300 text-black px-3 py-1 rounded mr-2">
                                            Modifier
                                        </a>
                                        <!-- Delete form -->
                                        <form action="{{ route('TypeConger.destroy', $typeConger->id_typeConge) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-300 text-black px-3 py-1 rounded" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination (if needed) -->
                    <div class="mt-4">
                        {{ $typeCongers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
