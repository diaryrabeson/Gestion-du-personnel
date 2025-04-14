<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon Profil') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 conts rounded-lg shadow-md">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('storage/' . $Profile['Photo']) }}" class="w-20 h-20 rounded-full" alt="Photo de {{ $Profile['nom'] }}">
            <div class="contents">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $Profile['nom'] }} {{ $Profile['prenom'] }}</h3>
               <div class="flex"><h4>Service :</h4>  <p class="text-gray-600 dark:text-gray-300">{{ $Profile['service'] }}</p></div> 
                <div class="flex"><h4>Email :</h4><p class="text-gray-600 dark:text-gray-300"> {{ $Profile['email'] }}</p></div>
                <div class="flex"><h4>Téléphone : </h4> <p class="text-gray-600 dark:text-gray-300">{{ $Profile['telephone'] }}</p></div>
                <div class="flex"><h4>Adresse :</h4><p class="text-gray-600 dark:text-gray-300"> {{ $Profile['adresse'] }}</p></div>
                <div class="flex"><h4>Solde Conger :</h4> <p class="text-gray-600 dark:text-gray-300"> {{ $Profile['SoldeConger'] }} Jours</p></div>
                <div class="flex"><h4>Date de naissance :</h4> <p class="text-gray-600 dark:text-gray-300"> {{ $Profile['DateDeNaissance'] }}</p></div>
                <div class="flex"><h4>Genre :</h4> <p class="text-gray-600 dark:text-gray-300"> {{ $Profile['Genre'] }}</p></div>
                <div class="flex"><h4>Salaire de base :</h4><p class="text-gray-600 dark:text-gray-300"> {{ $Profile['SalaireDeBase'] }} Ariary</p></div>
                
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
    .conts {
    transition: all 0.3s ease-in-out;
    border: 2px solid #e5e7eb; /* Gris clair */
}

.dark .conts {
    border-color: #374151; /* Gris foncé pour le mode sombre */
}

.conts:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.conts img {
    border: 4px solid #0d141f; /* Bleu */
    padding: 2px;
    transition: transform 0.3s ease;
    width: auto;
    height: 13em;
}

.conts img:hover {
    transform: scale(1.05);
}

.dark .conts img {
    border-color: #60a5fa; /* Bleu plus clair en mode sombre */
}

.bg-gray-100 {
    background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
}

.dark .bg-gray-700 {
    background: linear-gradient(135deg, #374151, #1f2937);
}

.contents{
    width: 20em;
    margin-left: 3em;
}

.contents .flex h4{
    font-weight: bold;
    font-size: 17px
}
</style>