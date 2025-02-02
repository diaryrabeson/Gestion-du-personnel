<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pointage de Présence') }}
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex1">
                        <div>
                            <h3 class="text-xl">Liste des Présences</h3>
                        </div>

                        <!-- Button to add a new attendance record -->
                        <div class="add mb-4">
                            <a href="{{ route('presence.pointer') }}" class="bg-blue-500 px-4 py-2 rounded">
                                Pointer
                            </a>
                        </div>
                    </div>

                    <!-- Table of presences -->
                    <table class="min-w-full table-auto border-collapse border border-gray-300 mt-4">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border px-4 py-2">Date</th>
                                <th class="border px-4 py-2">Employé</th>
                                <th class="border px-4 py-2">État</th>
                                <th class="border px-4 py-2">Motif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presences as $presence)
                                <tr>
                                    <td class="border px-4 py-2">{{ $presence->DateSys }}</td>
                                    <td class="border px-4 py-2">{{ $presence->employe->NomEmp }} {{ $presence->employe->Prenom }}</td>
                                    <td class="border px-4 py-2">{{ $presence->Etat }}</td>
                                    <td class="border px-4 py-2">{{ $presence->motif ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
