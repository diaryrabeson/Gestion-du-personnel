<!-- resources/views/employers/index.blade.php -->


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employés') }}
        </h2>
    </x-slot>
    <style>
        /* From Uiverse.io by nikk7007 */
        .Ajout {
            --color: #00A97F;
            padding: 0.8em 1.7em;
            background-color: transparent;
            border-radius: .3em;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: .5s;
            font-weight: 400;
            font-size: 14px;
            border: 1px solid;
            font-family: inherit;
            text-transform: uppercase;
            color: var(--color);
            z-index: 1;
        }

        .Ajout::before,
        .Ajout::after {
            content: '';
            display: block;
            width: 50px;
            height: 50px;
            transform: translate(-50%, -50%);
            position: absolute;
            border-radius: 50%;
            z-index: -1;
            background-color: var(--color);
            transition: 1s ease;
        }

        .Ajout::before {
            top: -1em;
            left: -1em;
        }

        .Ajout::after {
            left: calc(100% + 1em);
            top: calc(100% + 1em);
        }

        .Ajout:hover::before,
        .Ajout:hover::after {
            height: 410px;
            width: 410px;
        }

        .Ajout:hover {
            color: rgb(10, 25, 30);
        }

        .Ajout:active {
            filter: brightness(.8);
        }


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
            opacity: 0;
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
    </style>
    <script>
        let employeeId;

        function openModal(id) {
            employeeId = id; // Enregistrer l'identifiant de l'employé
            document.getElementById("confirmationModal").classList.add("show");
        }

        function closeModal() {
            document.getElementById("confirmationModal").classList.remove("show");
        }

        function submitForm() {
            const form = document.getElementById("deleteForm");
            // Mettre à jour l'action du formulaire avec la bonne route
            form.action = `{{ route('employers.destroy', '') }}/${employeeId}`;
            form.submit(); // Soumettre le formulaire
        }

    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('employers.search') }}" method="GET" class="mb-4 flex">
                <input type="text" name="query" placeholder="Rechercher un employé..."
                    class="border px-4 py-2 w-1/3 rounded-lg inputRecherhc" value="{{ request('query') }}">
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 btnrech rounded-lg">
                    <i class="fa-solid fa-magnifying-glass rechreh"></i>
                </button>
            </form>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl">Liste des Employés</h3>
                        <!-- Bouton pour ajouter un nouvel employé -->
                        <a href="{{ route('employers.create') }}" class="Ajout">
                            Ajouter un Employé
                        </a>


                    </div>

                    <!-- Liste des employés -->
                    <table class="min-w-full bg-white border border-gray-300" >
                        <thead>
                            <tr class="bg-gray-200">
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
                                        <form id="deleteForm"
                                            action="{{ route('employers.destroy', ['id_Employe' => $employee->Id_Employe]) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" style="color: crimson;" class="bg-red-300 text-black px-3 py-1 rounded"
                                                onclick="openModal({{ $employee->Id_Employe }})">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>

                                        <!-- Modale de confirmation -->
                                        <div id="confirmationModal" class="modal">
                                            <div class="modal-content">
                                                <h2>Confirmation de Suppression</h2>
                                                <p>Voulez-vous vraiment supprimer cet employé ?</p>
                                                <button onclick="submitForm()" class="suppr">
                                                    <i class="fa-solid fa-trash-can"></i> Supprimer
                                                </button>
                                                <button onclick="closeModal()" class="retour">
                                                    <i class="fa-solid fa-xmark"></i> Annuler
                                                </button>
                                            </div>
                                        </div>
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


                    <!-- Pagination (si nécessaire) -->
                    <div class="mt-4">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>