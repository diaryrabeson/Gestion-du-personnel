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
            height: 12em;
            border-radius: 1em;
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 25em;
            text-align: center;
            transform: translateY(-30px);
            transition: transform 0.3s ease;
            
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
    let TypeCOngeID;

    function openModal(id) {
        TypeCOngeID = id; // Enregistrer l'identifiant de l'employé
        document.getElementById("confirmationModal").classList.add("show");
    }

    function closeModal() {
        document.getElementById("confirmationModal").classList.remove("show");
    }

    function submitForm() {
        const form = document.getElementById("deleteForm");
        // Mettre à jour l'action du formulaire avec la bonne route
        form.action = `{{ route('TypeConger.destroy', '') }}/${TypeCOngeID}`;
        form.submit(); // Soumettre le formulaire
    }

</script>
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
                    <table class="w-full text-left border-collapse" style="width: 33em;position: relative;left: 12em;">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                {{-- <th class="border px-4 py-2">ID</th> --}}
                                <th class="border px-4 py-2">Type de Congé</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($typeCongers as $typeConger)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                    {{-- <td class="border px-4 py-2">{{ $typeConger->id_typeConge }}</td> --}}
                                    <td class="border px-4 py-2">{{ $typeConger->typeConge }}</td>
                                    <td class="border px-4 py-2 flex justify-between">
                                        <!-- Edit button -->
                                        <a href="{{ route('TypeConger.edit', $typeConger->id_typeConge) }}" style="color: blue" class="bg-yellow-300 text-black px-3 py-1 rounded mr-2">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <!-- Delete form -->
                                        <form id="deleteForm" 
                                        action="{{ route('TypeConger.destroy', $typeConger->id_typeConge) }}" 
                                        method="POST" style="display:inline;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="button" class="bg-red-300 text-black px-3 py-1 rounded" style="color: crimson" 
                                              onclick="openModal({{ $typeConger->id_typeConge }})">
                                          <i class="fa-solid fa-trash-can"></i>
                                      </button>
                                  </form>
                                  
                                  <!-- Modale de confirmation -->
                                  <div id="confirmationModal" class="modal">
                                      <div class="modal-content">
                                          <h2>Confirmation de Suppression</h2>
                                          <p>Voulez-vous vraiment supprimer ce type de congé ?</p>
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
