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
                <h3 class="text-xl text-center font-bold w-50 bg-yellow-200 p-4 mb-4">Demande de congé</h3>
                
                    @if ($employer)


                    <div class="text-xl relative my-4 text-center font-bold">
                        <div class="flex justify-center">
                            <h1>Nom de l'employé :</h1><p class="ml-4">{{ $employer->NomEmp }} {{ $employer->Prenom }}</p>
                        </div>
                        <div class="flex justify-between absolute w-full" style="top:45%">
                            <div class="titres">
                                <h2></h2>
                            </div>
                            <div class="titres">
                                <h2></h2>
                            </div>
                        </div>
                    </div>

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
                            <div class="flex justify-end">
                                <div class="retour">
                                    <a href="http://127.0.0.1:8000/Conger/create" class="btn-cancel">Annuler</a>
                                </div>
                                <div>
                                    <button type="submit" class="button">Soumettre</button>
                                </div>
                                
                            </div>
                            
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
.retour{
        margin-right: 1em
    }
    .btn-cancel {
        background-color: #f44336;
        color: white;
        padding: .8em 2em;
        border-radius: 8px;
        font-weight: bold;
        display: block;
     
    }

        label {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
        }
.titres {
        content: '';
        width: 35%;
        height: 2px;
        /* Épaisseur de la ligne */
        background: black;
        /* Couleur de la ligne */
        transform: translateY(50%);
        /* Positionne la ligne légèrement sous le texte */
        z-index: 1;
        /* Met la ligne derrière le texte */
    }
.custom-select {
    width: 100%;
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
 color: #ffffff !important;
 padding: 0.8em 1.7em;
 background-color: rgb(22, 80, 167);
 border-radius: .3em;
 position: relative;
 overflow: hidden;
 cursor: pointer;
 transition: .5s;
 font-weight: 400;
 font-size: 1em;
 border: none;
 font-family: inherit;
 
 z-index: 1;
}

    </style>
</x-app-layout>
