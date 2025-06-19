<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Demande de Congé
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6">
                <h3 class="text-xl text-center font-bold w-50 bg-yellow-200 p-4 mb-4">Profile employé</h3>
                
                    @if ($employer)
                        <p style="color: black"><strong>Nom de l'employé : </strong>{{ $employer->NomEmp }} {{ $employer->Prenom }}</p>
                        <form action="{{ route('Conger.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="id_typeConge">Type de Congé</label>
                                <select name="id_typeConge" id="id_typeConge" class="custom-select" required>
                                    @foreach($typeConges as $type)
                                        <option value="{{ $type->id_typeConge }}">{{ $type->typeConge }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="Date_debut">Date Début</label>
                                <input type="date" name="Date_debut" id="Date_debut" class="custom-select" required>
                            </div>
                            <div class="mb-4">
                                <label for="Date_Fin">Date Fin</label>
                                <input type="date" name="Date_Fin" id="Date_Fin" class="custom-select" required>
                            </div>

                            <!-- Champ caché pour id_employe -->
                            <input type="hidden" name="id_employe" value="{{ $employer->Id_Employe }}">

                            <div class="mb-4">
                                <label for="jours_ouvrables">Nombre de jours</label>
                                <input type="text" id="jours_ouvrables" name="jours_ouvrables" class="custom-select" readonly> <!-- Affichage du nombre de jours -->
                            </div>

                            <button type="submit" class="button">Soumettre</button>
                        </form>
                    @else
                        <p class="text-red-500 font-bold">Pas d'accès</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour calculer la différence entre les dates
        document.getElementById('Date_debut').addEventListener('change', calculerJours);
        document.getElementById('Date_Fin').addEventListener('change', calculerJours);

        function calculerJours() {
            // Récupération des valeurs des dates
            const dateDebut = document.getElementById('Date_debut').value;
            const dateFin = document.getElementById('Date_Fin').value;

            if (dateDebut && dateFin) {
                // Conversion des dates en objets Date
                const debut = new Date(dateDebut);
                const fin = new Date(dateFin);

                // Calcul du nombre de jours entre les deux dates
                const diffTime = fin - debut;
                const diffDays = diffTime / (1000 * 3600 * 24);

                // Vérification si la date de fin est après la date de début
                const inputJours = document.getElementById('jours_ouvrables');
                if (diffDays >= 0) {
                    inputJours.value = diffDays + 1; // Ajoute 1 jour pour inclure la date de début
                } else {
                    inputJours.value = 'Erreur : dates invalides';
                }
            }
        }
    </script>

    <style>
        label {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

.custom-select {
    width: 100%;
    max-width: 60em;  /* Ajuste la largeur */
    padding: 10px;
    font-size: 16px;
    border: 2px solid #8aaed3;  /* Bordure bleue */
    border-radius: 5px;
    background-color: white;
    color: #333;
    cursor: pointer;
    transition: 0.3s;
}

/* Effet au survol */
.custom-select:hover {
    border-color: #0056b3;
}

/* Effet au focus */
.custom-select:focus {
    outline: none;
    border-color: #87e27b;  /* Change la couleur au focus */
    box-shadow: 0 0 5px rgba(255, 102, 0, 0.5);
}

/* Style des options */
.custom-select option {
    font-size: 16px;
    background: white;
    color: #333;
}

/* Désactive l'option par défaut */
.custom-select option:first-child {
    color: gray;
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
    </style>
</x-app-layout>
