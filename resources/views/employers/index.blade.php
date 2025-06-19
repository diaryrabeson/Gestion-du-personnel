<!-- resources/views/employers/index.blade.php -->


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employés') }}
        </h2>
    </x-slot>
    <style>
        .add {
            color: white;
            margin-bottom: 2em;
            background-color: green;

        }

        .back {
            background-color: rgb(79, 187, 79);
            height: 2em;
            text-align: center;
            padding-top: 0.2em;
            font-weight: bold
        }

        .flex1 {
            display: flex;
            justify-content: space-between;

        }

        .rechreh {
            font-size: 2em;
            position: relative;
            color: black;
            width: 2em;
            height: 1em;
            height: 100%;
            padding-top: .3em;
        }

        .inputRecherhc {
            width: 20em;
            padding-top: .3em;
            height: 3.2em;
        }

        .btnrech {
            height: 4em;
            background: aquamarine;
            position: absolute;
            left: 36em;
            top: 4.6em;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            transition: opacity 0.3s ease;

        }

        .modal-content h2 {
            background-color: #080824;
            color: white;
            font-weight: 700;
        }

        .modal-content p {
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .modal-content {
            height: 10em;
            border-radius: 1em;
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 25em;
            text-align: center;
            transform: translateY(-30px);
            /* Déplacement vers le haut */
            transition: transform 0.3s ease;
            /* Transition de transformation */
        }

        .modal.show .modal-content {
            transform: translateY(0);
            /* Remettre à sa place */
        }

        .modal.show {
            display: block;
            /* Afficher la modale */
            opacity: 1;
            /* Opacité finale */
        }



        .suppr {
            background-color: #e63946;
            /* Couleur de fond */
            color: white;
            /* Couleur du texte */
            padding: 10px 15px;
            /* Espacement interne */
            border: none;
            /* Pas de bordure */
            border-radius: 5px;
            /* Coins arrondis */
            font-size: 16px;
            /* Taille de la police */
            cursor: pointer;
            /* Curseur en forme de main */
            transition: background-color 0.3s, transform 0.2s;
            /* Effets de transition */
        }

        .suppr:hover {
            background-color: #d62839;
            /* Couleur au survol */
            transform: scale(1.05);
            /* Légère augmentation de la taille */
        }

        .suppr:active {
            transform: scale(0.95);
            /* Réduction de la taille au clic */
        }

        .retour {
            background-color: #6c6c6c;
            /* Couleur de fond claire */
            color: #ffffff;
            /* Couleur du texte */
            padding: 10px 15px;
            /* Espacement interne */
            border: none;
            /* Pas de bordure */
            border-radius: 5px;
            /* Coins arrondis */
            font-size: 16px;
            /* Taille de la police */
            cursor: pointer;
            /* Curseur en forme de main */
            transition: background-color 0.3s, transform 0.2s;
            /* Effets de transition */
        }

        .beige {
            background-color: beige;
            border: #e5e7eb 1px solid;
        }

        .retour:hover {
            background-color: #a8dadc;
            /* Couleur au survol */
            transform: scale(1.05);
            /* Légère augmentation de la taille */
        }

        .retour:active {
            transform: scale(0.95);
            /* Réduction de la taille au clic */
        }

        .dataTables_wrapper .dataTables_filter {
            float: left !important;
            margin-bottom: 1em;
            text-align: right
        }

        .dataTables_wrapper {
            position: relative;
            clear: both;
            top: -2em
        }
    </style>
    <script>
        $(document).ready(function () {
            $('#employertables').DataTable({
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

            // Événements pour le modal
            let employeeId;

            window.openModal = function (id) {
                employeeId = id; // Enregistrer l'identifiant de l'employé
                document.getElementById("confirmationModal").style.display = "block"; // Afficher le modal
            }

            window.closeModal = function () {
                document.getElementById("confirmationModal").style.display = "none"; // Fermer le modal
            }

            document.getElementById('confirmDelete').onclick = function () {
                const form = document.getElementById("deleteForm_" + employeeId); // Sélecteur dynamique
                form.submit(); // Soumettre le formulaire
            };
        });
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Message de succès -->
                @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4 relative">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.style.display='none';" class="absolute top-1 right-1 text-white">
                        <i class="fa-solid fa-times"></i> <!-- Assurez-vous d'inclure Font Awesome -->
                    </button>
                </div>
            @endif
            @if(session('danger'))
                <div class="bg-red-500 text-white p-4 rounded mb-4 relative">
                    <span>{{ session('danger') }}</span>
                    <button onclick="this.parentElement.style.display='none';" class="absolute top-1 right-1 text-white">
                        <i class="fa-solid fa-times"></i> <!-- Assurez-vous d'inclure Font Awesome -->
                    </button>
                </div>
            @endif

            

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="text-xl text-center font-bold w-full bg-yellow-200 p-4 mb-4">
                        <h3 class="">Liste des Employés</h3>
                    </div>


                    <div class="float-right relative z-50">
                        <a href="{{ route('employers.create') }}" class="bg-blue-500  px-4 py-2 rounded">
                            <i class="fa-solid fa-plus"></i> Ajouter
                        </a>
                    </div>
                    <!-- Liste des employés -->
                    <table class="min-w-full bg-white border border-gray-300 -top-8" id="employertables">
                        <thead class="beige">
                            <tr class="beige">
                                <th class="border px-4 py-2">Nom</th>
                                <th class="border px-4 py-2">Prénom</th>
                                <th class="border px-4 py-2">Téléphone</th>
                                <th class="border px-4 py-2">Adresse</th>
                                <th class="border px-4 py-2">E-mail</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employeers as $employee)
                                <tr class="border">
                                    <td class="border px-4 py-2">{{ $employee->NomEmp }}</td>
                                    <td class="border px-4 py-2">{{ $employee->Prenom }}</td>
                                    <td class="border px-4 py-2">{{ $employee->Telephone }}</td>
                                    <td class="border px-4 py-2">{{ $employee->Adresse }}</td>
                                    <td class="border px-4 py-2">{{ $employee->mail }}</td>
                                    <td class="border px-4 py-2 flex justify-center">
                                        <!-- Modifier -->
                                        <a href="{{ route('employers.edit', ['id_Employe' => $employee->Id_Employe]) }}"
                                            class="bg-yellow-300 text-black px-3 py-1 rounded mr-2" style="color:blue">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <!-- Formulaire de suppression -->
                                        <form id="deleteForm_{{ $employee->Id_Employe }}"
                                            action="{{ route('employers.destroy', ['id_Employe' => $employee->Id_Employe]) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" style="color: crimson;"
                                                class="bg-red-300 text-black px-3 py-1 rounded"
                                                onclick="openModal({{ $employee->Id_Employe }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>


                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-red-500 py-4">
                                        Aucun employé trouvé.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Modale de confirmation -->
                    <div id="confirmationModal" class="modal" style="display:none;">
                        <div class="modal-content">
                            <h2>Demande de confirmation</h2>
                            <p>Voulez-vous vraiment supprimer cet employé ?</p>
                            <button id="confirmDelete" class="suppr">
                                <i class="fa-solid fa-trash-can"></i> Supprimer
                            </button>
                            <button onclick="closeModal()" class="retour">
                                <i class="fa-solid fa-xmark"></i> Annuler
                            </button>
                        </div>
                    </div>

                    <!-- Pagination (si nécessaire) -->
                    <div class="mt-4">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>