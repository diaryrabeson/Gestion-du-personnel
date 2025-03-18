<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon Profil') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 conts rounded-lg shadow-md">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('storage/' . $Profile['Photo']) }}" class="w-20 h-20 rounded-full" alt="Photo de {{ $Profile['nom'] }}">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $Profile['nom'] }} {{ $Profile['prenom'] }}</h3>
                <p class="text-gray-600 dark:text-gray-300">Service : {{ $Profile['service'] }}</p>
                <p class="text-gray-600 dark:text-gray-300">Email : {{ $Profile['email'] }}</p>
                <p class="text-gray-600 dark:text-gray-300">Téléphone : {{ $Profile['telephone'] }}</p>
                <p class="text-gray-600 dark:text-gray-300">Adresse : {{ $Profile['adresse'] }}</p>
                <p class="text-gray-600 dark:text-gray-300">Solde Conger : {{ $Profile['SoldeConger'] }} Jours</p>
                <p class="text-gray-600 dark:text-gray-300">Date de naissance : {{ $Profile['DateDeNaissance'] }}</p>
                <p class="text-gray-600 dark:text-gray-300">Genre : {{ $Profile['Genre'] }}</p>
                <p class="text-gray-600 dark:text-gray-300">Salaire de base : {{ $Profile['SalaireDeBase'] }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Détails du Profil</h4>
            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                <p><strong>Date d'embauche :</strong> {{ $Profile['DateD_embauche	'] }}</p>
                <p><strong>Rôle :</strong> Employer</p>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .conts{
        margin-top: 5em;
        margin-left: 2em;
    }
</style>