<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajout des employées') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-xl text-bold">Créer un nouvel Employé</h1>

                    <!-- Form to add a new employee -->
                    <form action="{{ route('employers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="">-------Information personnel-------</div>
                        <div class="d-flex">
                            <div class="mb-4">
                                <label for="NomEmp" class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" name="NomEmp" id="NomEmp"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="Prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                                <input type="text" name="Prenom" id="Prenom"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    required>
                            </div>
                        </div>

                        <div class="d-flex">
                        <div class="mb-4">
                            <label for="Adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                            <input type="text" name="Adresse" id="Adresse"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="mail" class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" name="mail" id="mail"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="mb-4">
                            <label for="Telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="text" name="Telephone" id="Telephone"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="Photo" class="block text-sm font-medium text-gray-700">Photo</label>
                            <input type="file" name="Photo" id="Photo"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="mb-4">
                            <label for="DatedeNaissance" class="block text-sm font-medium text-gray-700">Date de
                                Naissance</label>
                            <input type="date" name="DatedeNaissance" id="DatedeNaissance" max="1999-12-31"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="Genre">Genre</label>
                            <select name="Genre" id="Genre"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="Masculin" {{ old('Genre') == 'Masculin' ? 'selected' : '' }}>Masculin
                                </option>
                                <option value="Féminin" {{ old('Genre') == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                            </select>
                        </div>
                    </div>
                    <div>-------Information pour le travail-------</div>
                    <div class="d-flex">
                        <div class="mb-4">
                            <label for="DateD_embauche" class="block text-sm font-medium text-gray-700">Date
                                d'Embauche</label>
                            <input type="date" name="DateD_embauche" id="DateD_embauche"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="Id_service" class="block text-sm font-medium text-gray-700">Fontion</label>
                            <select name="Id_service" id="Id_service"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <!-- Remplissez cette liste avec les services disponibles -->
                                @foreach($services as $service)
                                    <option value="{{ $service->id_service }}">{{ $service->nomService }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="mb-4">
                            <label for="SoldeConger" class="block text-sm font-medium text-gray-700">Solde de
                                Congé</label>
                            <input type="number" max="31" name="SoldeConger" id="SoldeConger"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="SalaireDeBase" class="block text-sm font-medium text-gray-700">Salaire de
                                Base</label>
                            <input type="number" name="SalaireDeBase" id="SalaireDeBase"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                    </div>
                        <div class="flex justify-between">
                            <button type="submit"
                                class=" button bg-green-500 text-black px-6 py-3 rounded-md shadow-md hover:bg-green-600 transition">
                                Créer l'Employé
                            </button>
                            <a href="http://127.0.0.1:8000/employers" class="btn-cancel">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // cecie est le code pour empecher l'admin de selectionner la date superieur de l'année 2004 dans la date de naissance de l'employer
        document.addEventListener("DOMContentLoaded", function () {
            let dateNaissanceInput = document.getElementById("DatedeNaissance");

            if (dateNaissanceInput) {
                let today = new Date();
                let maxDate = new Date(2004, 11, 31).toISOString().split("T")[0]; // Date max : 31 décembre 1999
                dateNaissanceInput.setAttribute("max", maxDate);

                dateNaissanceInput.addEventListener("change", function () {
                    if (this.value > maxDate) {
                        alert("L'employé doit être né avant l'an 2000.");
                        this.value = ""; // Efface la valeur incorrecte
                    }
                });
            }
        });

        //ceci est le code pour mettre le date d'Embauche en date d'aujourd'hui
        document.addEventListener("DOMContentLoaded", function () {
            let dateEmbaucheInput = document.getElementById("DateD_embauche");

            if (dateEmbaucheInput) {
                let today = new Date();
                let todayFormatted = today.toISOString().split("T")[0]; // Format YYYY-MM-DD

                dateEmbaucheInput.value = todayFormatted; // Remplissage automatique du champ
            }
        });
    </script>

</x-app-layout>

<style>
    .btn-cancel{
        background-color: #f44336;
    color: white;
    padding: 0.75em 2em;
    border-radius: 8px;
    font-weight: bold;
    }
       .button {
 --color: #00A97F;
 padding: 0.8em 1.7em;
 background-color: transparent;
 border-radius: .3em;
 position: relative;
 overflow: hidden;
 cursor: pointer;
 transition: .5s;
 font-weight: 400;
 font-size: 17px;
 border: 1px solid;
 font-family: inherit;
 text-transform: uppercase;
 color: var(--color);
 z-index: 1;
}

.button::before, .button::after {
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

.button::before {
 top: -1em;
 left: -1em;
}

.button::after {
 left: calc(100% + 1em);
 top: calc(100% + 1em);
}

.button:hover::before, .button:hover::after {
 height: 410px;
 width: 410px;
}

.button:hover {
 color: rgb(10, 25, 30);
}

.button:active {
 filter: brightness(.8);
}
    .d-flex{
        display: flex;
        justify-content: space-between
    }
    .mb-4{
        width: 48%
    }
</style>