<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listes des services') }}
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
        let serviceId;

        function openModal(id) {
            serviceId = id; 
            document.getElementById("confirmationModal").classList.add("show");
        }

        function closeModal() {
            document.getElementById("confirmationModal").classList.remove("show");
        }

        function submitForm() {
            const form = document.getElementById("deleteForm");
            form.action = `{{ route('services.destroy', '') }}/${serviceId}`;
            form.submit(); 
        }
    </script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex1">
                        <div>
                            <h3 class="text-xl">Liste des fonctions</h3>
                        </div>
                        <!-- Button to add a new service -->
                        <div class="add mb-4">
                            <a href="{{ route('services.create') }}" class="  bg-blue-500  px-4 py-2 rounded">
                                Ajouter une fonction
                            </a>
                        </div>
                    </div>
                    <!-- List of Services -->
                    <ul>
                        @foreach($services as $service)
                                    <li class="flex justify-between items-center mb-2">
                                        <span>{{ $service->nomService }} - {{ $service->Description }}</span>

                                        <!-- Action Buttons for each service -->
                                        <div>
                                            <!-- Edit button with service ID -->
                                            <a href="{{ route('services.edit', ['id_service' => $service->id_service]) }}"
                                                class="bg-yellow-300 text-black px-3 py-1 rounded mr-2" style="color: blue">
                                                <i class="fa-solid fa-pen-to-square"></i></a>

                                            <!-- Delete form for each service -->
                                            <form id="deleteForm"
                                                action="{{ route('services.destroy', ['id_service' => $service->id_service]) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="bg-red-300 text-black px-3 py-1 rounded" style="color: crimson"
                                                    onclick="openModal({{ $service->id_service }})">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>

                                            <!-- Modale de confirmation -->
                                            <div id="confirmationModal" class="modal">
                                                <div class="modal-content">
                                                    <h2>Confirmation de Suppression</h2>
                                                    <p>Voulez-vous vraiment supprimer ce fonction ?</p>
                                                    <button onclick="submitForm()" class="suppr">
                                                        <i class="fa-solid fa-trash-can"></i> Supprimer
                                                    </button>
                                                    <button onclick="closeModal()" class="retour">
                                                        <i class="fa-solid fa-xmark"></i> Annuler
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                            </li>
                        @endforeach
                </ul>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>