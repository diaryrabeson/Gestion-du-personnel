<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Demande de Congé
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($employer)
                        <p style="color: black"><strong>Nom de l'employé : </strong>{{ $employer->NomEmp }} {{ $employer->Prenom }}</p>
                        <form action="{{ route('Conger.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="id_typeConge">Type de Congé</label>
                                <select name="id_typeConge" id="id_typeConge" required>
                                    @foreach($typeConges as $type)
                                        <option value="{{ $type->id_typeConge }}">{{ $type->typeConge }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="Date_debut">Date Début</label>
                                <input type="date" name="Date_debut" id="Date_debut" required>
                            </div>
                            <div class="mb-4">
                                <label for="Date_Fin">Date Fin</label>
                                <input type="date" name="Date_Fin" id="Date_Fin" required>
                            </div>

                            <!-- Champ caché pour id_employe -->
                            <input type="hidden" name="id_employe" value="{{ $employer->Id_Employe }}">

                            <div class="mb-4">
                                <label for="jours_ouvrables">Nombre de jours</label>
                                <input type="text" id="jours_ouvrables" name="jours_ouvrables" readonly> <!-- Affichage du nombre de jours -->
                            </div>

                            <button type="submit">Soumettre</button>
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
</x-app-layout>
