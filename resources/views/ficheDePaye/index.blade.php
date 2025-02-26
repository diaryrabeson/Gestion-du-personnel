<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fiche de Paie') }}
        </h2>
    </x-slot>

    <!-- Formulaire de recherche -->
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mb-6">
        <form method="GET" action="{{ route('ficheDePaye.index') }}" class="flex flex-col md:flex-row md:items-center gap-4">
            <div class="flex flex-col">
                <label for="mois" class="text-gray-700 dark:text-gray-300 font-semibold">Mois :</label>
                <select name="mois" id="mois" class="form-control p-2 border rounded">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('mois', date('m')) == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="flex flex-col">
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
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">
                    Rechercher
                </button>
            </div>
        </form>
    </div>

    <!-- Affichage de la fiche de paie -->
    @if ($ficheDePaye)
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . $ficheDePaye['photo']) }}" class="w-20 h-20 rounded-full" alt="Photo de {{ $ficheDePaye['nom'] }}">
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
