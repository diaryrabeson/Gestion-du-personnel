<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fiche de Paie') }}
        </h2>
    </x-slot>

    <!-- Formulaire de recherche -->
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg conteneur shadow-md mb-6">
        <form method="GET" action="{{ route('ficheDePaye.index') }}" class="flex flex-col md:flex-row md:items-center gap-4">
           <div class="contents" >
            <div class="">
                <label for="mois" class="text-gray-700 dark:text-gray-300 font-semibold">Mois :</label>
                <select name="mois" id="mois" class="form-control p-2 border rounded">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('mois', date('m')) == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="">
                <label for="annee" class="text-gray-700 dark:text-gray-300 font-semibold">Année :</label>
                <select name="annee" id="annee" class="form-control p-2 border rounded">
                    @for ($y = date('Y') - 5; $y <= date('Y'); $y++)
                        <option value="{{ $y }}" {{ request('annee', date('Y')) == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>

            <div>
                <button type="submit" class="button2">
                    Rechercher
                </button>
            </div>
        </div>
            
        </form>
    </div>

    <!-- Affichage de la fiche de paie -->
    @if ($ficheDePaye)
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . $ficheDePaye['Photo']) }}" class="w-20 h-20 rounded-full" alt="Photo de {{ $ficheDePaye['nom'] }}">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $ficheDePaye['nom'] }} {{ $ficheDePaye['prenom'] }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">Service : {{ $ficheDePaye['service'] }}</p>
                    <p class="text-gray-600 dark:text-gray-300">Email : {{ $ficheDePaye['email'] }}</p>
                    <p class="text-gray-600 dark:text-gray-300">Téléphone : {{ $ficheDePaye['telephone'] }}</p>
                    <p class="text-gray-600 dark:text-gray-300">Adresse : {{ $ficheDePaye['adresse'] }}</p>
                </div>
            </div>

            <div class="mt-6">
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Détails de la Fiche de Paie</h4>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <p><strong>Salaire de Base :</strong> {{ number_format($ficheDePaye['salaire_base'], 2) }} €</p>
                    <p><strong>Présences :</strong> {{ $ficheDePaye['total_presence'] ?? 0 }} jours</p>
                    <p><strong>Absences :</strong> {{ $ficheDePaye['total_absences'] ?? 0 }} jours</p>
                    <p><strong>Heures Supplémentaires :</strong> {{ $ficheDePaye['total_heures_supp'] ?? 0 }} heures</p>
                    <p><strong>Coût Total Heures Supplémentaires :</strong> {{ number_format($ficheDePaye['cout_total_heures_supp'], 2) }} €</p>
                    <p><strong>Prime :</strong> {{ number_format($ficheDePaye['prime'], 2) }} €</p>
                    <p class="text-xl font-bold text-blue-600 dark:text-blue-400"><strong>Salaire Total :</strong> {{ number_format($ficheDePaye['salaire_total'], 2) }} €</p>
                </div>
            </div>
        </div>
    @else
        <p class="text-center text-gray-600 dark:text-gray-300 mt-4">Aucune fiche de paie trouvée pour cette période.</p>
    @endif
</x-app-layout>
<style>
    .contents{
        display: flex;
        width: 41em;
        justify-content: space-between;
    }

    .conteneur{
        margin-top: 3em;
        margin-left: 3em;
    }
    .border{
        width: 12em;
    }
    /* From Uiverse.io by shah1345 */ 
.button2 {
margin-top: -.2em;
  display: inline-block;
  transition: all 0.2s ease-in;
  position: relative;
  overflow: hidden;
  z-index: 1;
  color: #090909;
  padding: 0.7em 1.7em;
  cursor: pointer;
  font-size: 14px;
  border-radius: 0.5em;
  background: #e8e8e8;
  border: 1px solid #e8e8e8;
  box-shadow: 6px 6px 12px #c5c5c5, -6px -6px 12px #ffffff;
}

.button2:active {
  color: #666;
  box-shadow: inset 4px 4px 12px #c5c5c5, inset -4px -4px 12px #ffffff;
}

.button2:before {
  content: "";
  position: absolute;
  left: 50%;
  transform: translateX(-50%) scaleY(1) scaleX(1.25);
  top: 100%;
  width: 140%;
  height: 180%;
  background-color: rgba(0, 0, 0, 0.05);
  border-radius: 50%;
  display: block;
  transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
  z-index: -1;
}

.button2:after {
  content: "";
  position: absolute;
  left: 55%;
  transform: translateX(-50%) scaleY(1) scaleX(1.45);
  top: 180%;
  width: 160%;
  height: 190%;
  background-color: #009087;
  border-radius: 50%;
  display: block;
  transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
  z-index: -1;
}

.button2:hover {
  color: #ffffff;
  border: 1px solid #009087;
}

.button2:hover:before {
  top: -35%;
  background-color: #009087;
  transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}

.button2:hover:after {
  top: -45%;
  background-color: #009087;
  transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}

</style>