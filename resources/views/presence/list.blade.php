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
        div.dt-container .dt-search{
            margin-bottom: 1em !important;
            text-align: right;
            left: 0em !important;
            margin-top: 3% !important;
            position: absolute !important;
        }

    </style>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#presenceTable').DataTable({
            // Supprimez les options pour activer la pagination et la recherche
            language: {
                "sProcessing": "Traitement en cours...",
                "sSearch": "Rechercher&nbsp;:",
                "sLengthMenu": "",
                "sInfo": "Affichage de l'enregistrement _START_ à _END_ sur _TOTAL_ enregistrements",
                "sInfoEmpty": "Affichage de l'enregistrement 0 à 0 sur 0 enregistrements",
                "sZeroRecords": "Aucun enregistrement à afficher",
                "sInfoFiltered": "(filtré à partir de _MAX_ enregistrements au total)", // Traduction ajoutée
                "oPaginate": {
                    "sFirst": "Premier",
                    "sPrevious": "Précédent",
                    "sNext": "Suivant",
                    "sLast": "Dernier"
                }
            }
        });
    });


</script>
    <div class="py-6">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <!-- Affichage des messages de succès -->
                   @if(session('success'))
                   <div class="bg-green-500 text-white top-50 w-8/12 p-4 rounded mb-4 absolute">
                       <span>{{ session('success') }}</span>
                       <button onclick="this.parentElement.style.display='none';" class="absolute top-1 right-1 text-white">
                           <i class="fa-solid fa-times"></i> <!-- Assurez-vous d'inclure Font Awesome -->
                       </button>
                   </div>
               @endif
                        <div class="text-xl text-center font-bold w-full bg-yellow-200 p-4 mb-4">
                            <h3 class="text-xl">Liste des Présences et des absences</h3>
                        </div>

                        <!-- Button to add a new attendance record -->
                        <div class="float-right absolute z-50" style="left:90%">
                            <a href="{{ route('presence.pointer') }}" class="bg-blue-500 px-4 py-2 rounded">
                                <i class="fa-solid fa-plus"></i>Pointer
                            </a>
                        </div>
                 

                    <!-- Table of presences -->
                    <table class="min-w-full table-auto border-collapse border border-gray-300 mt-4" style="margin-top: 3%" id="presenceTable">
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
                                    <td class="border text-left px-4 py-2">{{ \Carbon\Carbon::parse($presence->DateSys)->format('d/m/Y') }}</td>
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
