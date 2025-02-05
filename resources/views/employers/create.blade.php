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
                <h3 class="text-xl">Créer un nouvel Employé</h3>

                <!-- Form to add a new employee -->
                <form action="{{ route('employers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="NomEmp" class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="NomEmp" id="NomEmp" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="Prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                        <input type="text" name="Prenom" id="Prenom" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="Adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                        <input type="text" name="Adresse" id="Adresse" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="mail" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" name="mail" id="mail" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="Telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="text" name="Telephone" id="Telephone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="Photo" class="block text-sm font-medium text-gray-700">Photo</label>
                        <input type="file" name="Photo" id="Photo" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="DatedeNaissance" class="block text-sm font-medium text-gray-700">Date de Naissance</label>
                        <input type="date" name="DatedeNaissance" id="DatedeNaissance"
                            max="1999-12-31"
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    
                    <div  class="mb-4">
                        <label for="Genre">Genre</label>
                        <select name="Genre" id="Genre" class="form-control">
                            <option value="Masculin" {{ old('Genre') == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                            <option value="Féminin" {{ old('Genre') == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                        </select>
                    </div>
                    

                    <div class="mb-4">
                        <label for="DateD_embauche" class="block text-sm font-medium text-gray-700">Date d'Embauche</label>
                        <input type="date" name="DateD_embauche" id="DateD_embauche" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                 
                    <div class="mb-4">
                        <label for="Id_service" class="block text-sm font-medium text-gray-700">Service</label>
                        <select name="Id_service" id="Id_service" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <!-- Remplissez cette liste avec les services disponibles -->
                            @foreach($services as $service)
                                <option value="{{ $service->id_service }}">{{ $service->nomService }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="SoldeConger" class="block text-sm font-medium text-gray-700">Solde de Congé</label>
                        <input type="number" max="31" name="SoldeConger" id="SoldeConger" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="SalaireDeBase" class="block text-sm font-medium text-gray-700">Salaire de Base</label>
                        <input type="number" name="SalaireDeBase" id="SalaireDeBase" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4 bg-green-500">
                        <button type="submit" class="bg-green-500 text-black px-6 py-3 rounded-md shadow-md hover:bg-green-600 transition">
                            Créer l'Employé
                        </button>
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
