<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon Profil') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('storage/' . $employe->photo) }}" class="w-20 h-20 rounded-full" alt="Photo de {{ $employe->nom }}">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $employe->nom }} {{ $employe->prenom }}</h3>
                <p class="text-gray-600 dark:text-gray-300">Service : {{ $employe->service }}</p>
                <p class="text-gray-600 dark:text-gray-300">Email : {{ $employe->email }}</p>
                <p class="text-gray-600 dark:text-gray-300">Téléphone : {{ $employe->telephone }}</p>
                <p class="text-gray-600 dark:text-gray-300">Adresse : {{ $employe->adresse }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Détails du Profil</h4>
            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                <p><strong>Date d'embauche :</strong> {{ $employe->date_embauche }}</p>
                <p><strong>Rôle :</strong> {{ $employe->role }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
