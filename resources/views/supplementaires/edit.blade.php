<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier une Heure Supplémentaire') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Affichage des erreurs -->
                    @if ($errors->has('error'))
                        <div class="custom-alert error-alert">
                            <strong>Erreur !</strong> {{ $errors->first('error') }}
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="custom-alert success-alert">
                            <strong>Succès !</strong> {{ session('success') }}
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulaire de modification -->
                    <form action="{{ route('supplementaire.update', $supplementaire->id_supplementaire) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="Id_Employe" class="block">Employé :</label>
                            <select name="Id_Employe" id="Id_Employe" class="w-full p-2 border rounded" required>
                                <option value="" disabled>-- Sélectionnez un employé --</option>
                                @foreach($employes as $employe)
                                    <option value="{{ $employe->Id_Employe }}" 
                                        {{ $supplementaire->id_employe == $employe->Id_Employe ? 'selected' : '' }}>
                                        {{ $employe->NomEmp }} {{ $employe->Prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="DateSys" class="block">Date :</label>
                            <input type="date" name="DateSys" id="DateSys" class="w-full p-2 border rounded" 
                                value="{{ old('DateSys', $supplementaire->DateSys) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="CoutParHeure" class="block">Coût par Heure :</label>
                            <input type="number" step="0.01" name="CoutParHeure" id="CoutParHeure" class="w-full p-2 border rounded" 
                                value="{{ old('CoutParHeure', $supplementaire->CoutParHeure) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="DebutDeSuppl" class="block">Début :</label>
                            <input type="time" name="DebutDeSuppl" id="DebutDeSuppl" class="w-full p-2 border rounded" 
                                value="{{ old('DebutDeSuppl', $supplementaire->DebutDeSuppl) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="FinDeSuppl" class="block">Fin :</label>
                            <input type="time" name="FinDeSuppl" id="FinDeSuppl" class="w-full p-2 border rounded" 
                                value="{{ old('FinDeSuppl', $supplementaire->FinDeSuppl) }}" required>
                        </div>

                        <div class="mb-4">
                            <label>Nombre total d'heures :</label>
                            <input type="text" name="nb_total_heures" id="nb_total_heures" class="w-full p-2 border rounded bg-gray-200" readonly 
                                value="{{ old('nb_total_heures', $supplementaire->nb_total_heures) }}">
                        </div>

                        <div class="mb-4">
                            <label>Coût total :</label>
                            <input type="text" id="cout_total" name="cout_total" class="w-full p-2 border rounded bg-gray-200" readonly 
                                value="{{ old('cout_total', $supplementaire->cout_total) }}">
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Mettre à jour
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Calcul automatique du nombre d'heures et du coût total
    document.getElementById('DebutDeSuppl').addEventListener('change', calculerHeuresSupplementaires);
    document.getElementById('FinDeSuppl').addEventListener('change', calculerHeuresSupplementaires);
    document.getElementById('CoutParHeure').addEventListener('input', calculerCoutTotal);

    function calculerHeuresSupplementaires() {
        let debut = document.getElementById('DebutDeSuppl').value;
        let fin = document.getElementById('FinDeSuppl').value;
        if (debut && fin) {
            let debutDate = new Date('1970-01-01T' + debut);
            let finDate = new Date('1970-01-01T' + fin);
            let diffHeures = (finDate - debutDate) / (1000 * 60 * 60);
            document.getElementById('nb_total_heures').value = diffHeures > 0 ? diffHeures.toFixed(2) : 0;
            calculerCoutTotal();
        }
    }

    function calculerCoutTotal() {
        let nbHeures = parseFloat(document.getElementById('nb_total_heures').value) || 0;
        let coutParHeure = parseFloat(document.getElementById('CoutParHeure').value) || 0;
        document.getElementById('cout_total').value = (nbHeures * coutParHeure).toFixed(2);
    }
</script>
