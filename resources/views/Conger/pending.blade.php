<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Demandes de Congé en Attente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" ml-0px">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                    <div class="alert alert-success flex items-center justify-between bg-green-500 text-white p-4 rounded-lg shadow-md relative">
                        <span>{{ session('success') }}</span>
                        <button class="close-btn absolute top-0 right-0 p-2" onclick="this.parentElement.style.display='none';">
                            &times; <!-- Symbole de fermeture -->
                        </button>
                    </div>
                @endif
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl text-center font-bold w-full bg-yellow-200 p-4 mb-4">Demandes de Congé en Attente</h3>
                    </div>
                    <!-- Inclure jQuery et DataTables -->
                 
                    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />
                    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
                    
                    @if ($congesEnAttente->count() > 0)
                        <table id="congesTable"
                            class="w-full min-w-full table-auto border-collapse border border-gray-300 display">
                            <thead class="bg-beige dark:bg-gray-700">
                                <tr>
                                    <th class="border px-4 py-2">Employé</th>
                                    <th class="border px-4 py-2">Type de Congé</th>
                                    <th class="border px-4 py-2">Date Début</th>
                                    <th class="border px-4 py-2">Date Fin</th>
                                    <th class="border px-4 py-2">Jours Ouvrables</th>
                                    <th class="border px-4 py-2 w-32">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($congesEnAttente as $conge)
                                    <tr class="text-center">
                                        <td class="border px-4 py-2">
                                            {{ $conge->employers->NomEmp ?? 'Inconnu' }}
                                            {{ $conge->employers->Prenom ?? '' }}
                                        </td>
                                        <td class="border px-4 py-2">{{ $conge->typeConge->typeConge ?? 'Inconnu' }}</td>
                                        <td class="border px-4 py-2">{{ $conge->Date_debut }}</td>
                                        <td class="border px-4 py-2">{{ $conge->Date_Fin }}</td>
                                        <td class="border px-4 py-2">{{ $conge->jours_ouvrables }}</td>
                                        <td class="border px-4 py-2 flex justify-center space-x-2">
                                            <form action="{{ route('Conger.valider', $conge->id_Conge) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btnGreen">
                                                    Approuver
                                                </button>
                                            </form>
                                            <form action="{{ route('Conger.refuser', $conge->id_Conge) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btnred">
                                                    Rejeter
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else
                        <p class="text-center text-gray-600 dark:text-gray-400 mt-4">Aucune demande de congé en attente.</p>
                    @endif

                    <script>
                        $(document).ready(function () {
                            $('#congesTable').DataTable({
                                language: {
                                    "sProcessing": "Traitement en cours...",
                                    "sSearch": "Rechercher&nbsp;:",
                                    "sLengthMenu": "",
                                    "sInfo": "Affichage de l'enregistrement _START_ à _END_ sur _TOTAL_ enregistrements",
                                    "sInfoEmpty": "Affichage de l'enregistrement 0 à 0 sur 0 enregistrements",
                                    "sZeroRecords": "Aucun enregistrement à afficher",
                                    "sInfoFiltered": "(filtré à partir de _MAX_ enregistrements au total)",
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
       /* Réduire la taille de la police des éléments de DataTables */
       div.dt-container .dt-length,
  div.dt-container .dt-search,
  div.dt-container .dt-info,
  div.dt-container .dt-processing,
  div.dt-container .dt-paging {
  font-size: .9em !important
  }
    /* From Uiverse.io by cssbuttons-io */
    .bg-beige {
        background-color: #f5f5dc;
    }
    .btnGreen {
        position: relative;
        font-size: 11px;
        text-transform: uppercase;
        text-decoration: none;
        padding: 1em 2.5em;
        display: inline-block;
        cursor: pointer;
        border-radius: 6em;
        transition: all 0.2s;
        border: none;
        font-family: inherit;
        font-weight: 500;
        color: black;
        background-color: rgb(73, 173, 64);
    }

    .btnGreen:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .btnGreen:active {
        transform: translateY(-1px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .btnGreen::after {
        content: "";
        display: inline-block;
        height: 100%;
        width: 100%;
        border-radius: 100px;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        transition: all 0.4s;
    }

    .btnGreen::after {
        background-color: #67af64;
    }

    .btnGreen:hover::after {
        transform: scaleX(1.4) scaleY(1.6);
        opacity: 0;
    }


    .btnred {
        position: relative;
        font-size: 11px;
        text-transform: uppercase;
        text-decoration: none;
        padding: 1em 2.5em;
        display: inline-block;
        cursor: pointer;
        border-radius: 6em;
        transition: all 0.2s;
        border: none;
        font-family: inherit;
        font-weight: 500;
        color: black;
        background-color: hsl(0, 65%, 56%);
    }

    .btnred:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .btnred:active {
        transform: translateY(-1px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .btnred::after {
        content: "";
        display: inline-block;
        height: 100%;
        width: 100%;
        border-radius: 100px;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        transition: all 0.4s;
    }

    .btnred::after {
        background-color: hsl(0, 65%, 56%);
    }

    .btnred:hover::after {
        transform: scaleX(1.4) scaleY(1.6);
        opacity: 0;
    }
</style>