<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon Profil') }}
        </h2>
    </x-slot>

    <div class=" mx-auto bg-white dark:bg-gray-800 p-6 conts rounded-lg shadow-md">
        <h3 class="text-xl text-center font-bold w-50 bg-yellow-200 p-4 mb-4">Profile employé</h3>
        <div class="text-xl relative my-4 text-center font-bold">
            <div>
                <h1>Information personnel</h1>
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
        <div class="flex items-center space-x-6 p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <div>
                <img src="{{ asset('storage/' . $Profile['Photo']) }}" class="w-24 h-24 rounded-full border-2 border-gray-300 dark:border-gray-600" alt="Photo de {{ $Profile['nom'] }}">
            </div>
            <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg flex-1">
             
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <h4 class="font-bold text-lg text-gray-700 dark:text-gray-300">Nom :</h4>
                        <p class="ml-2 text-lg text-gray-600 dark:text-gray-300">{{ $Profile['nom'] }}</p>
                    </div>
                    <div class="flex items-center">
                        <h4 class="font-bold text-lg text-gray-700 dark:text-gray-300">Prénom :</h4>
                        <p class="ml-2 text-lg text-gray-600 dark:text-gray-300">{{ $Profile['prenom'] }}</p>
                    </div>
                    <div class="flex items-center">
                        <h4 class="font-bold text-lg text-gray-700 dark:text-gray-300">Fonction :</h4>
                        <p class="ml-2 text-lg text-gray-600 dark:text-gray-300">{{ $Profile['service'] }} {{ $Profile['descService'] }}</p>
                    </div>
                    <div class="flex items-center">
                        <h4 class="font-bold text-lg text-gray-700 dark:text-gray-300">Email :</h4>
                        <p class="ml-2 text-lg text-gray-600 dark:text-gray-300">{{ $Profile['email'] }}</p>
                    </div>
                    <div class="flex items-center">
                        <h4 class="font-bold text-lg text-gray-700 dark:text-gray-300">Téléphone :</h4>
                        <p class="ml-2 text-lg text-gray-600 dark:text-gray-300">{{ $Profile['telephone'] }}</p>
                    </div>
                    <div class="flex items-center">
                        <h4 class="font-bold text-lg text-gray-700 dark:text-gray-300">Adresse :</h4>
                        <p class="ml-2 text-lg text-gray-600 dark:text-gray-300">{{ $Profile['adresse'] }}</p>
                    </div>
                    <div class="flex items-center">
                        <h4 class="font-bold text-lg text-gray-700 dark:text-gray-300">Solde Congé :</h4>
                        <p class="ml-2 text-lg text-gray-600 dark:text-gray-300">{{ $Profile['SoldeConger'] }} Jours</p>
                    </div>
                    <div class="flex items-center">
                        <h4 class="font-bold text-lg text-gray-700 dark:text-gray-300">Date de naissance :</h4>
                        <p class="ml-2 text-lg text-gray-600 dark:text-gray-300">{{ \Carbon\Carbon::parse($Profile['DateDeNaissance'])->format('d/m/Y') }}</p>
                    </div>
                    <div class="flex items-center">
                        <h4 class="font-bold text-lg text-gray-700 dark:text-gray-300">Genre :</h4>
                        <p class="ml-2 text-lg text-gray-600 dark:text-gray-300">{{ $Profile['Genre'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <div class="text-xl relative my-4 text-center font-bold">
                <div>
                    <h1>Détails du Profil</h1>
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
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                 <div class="space-y-2">
                    <p class="text-lg text-gray-700 dark:text-gray-300">
                        <strong>Date d'embauche :</strong> <span class="text-gray-600 dark:text-gray-400"> {{ $Profile['DateD_embauche	'] }}</span>
                    </p>
                    <p class="text-lg text-gray-700 dark:text-gray-300">
                        <strong>Rôle :</strong> <span class="text-gray-600 dark:text-gray-400">Employé</span>
                    </p>
                    <p class="text-lg text-gray-700 dark:text-gray-300">
                        <strong>Salaire de base :</strong> <span class="text-gray-600 dark:text-gray-400">{{ $Profile['SalaireDeBase'] }} Ariary</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
     .titres {
        content: '';
        width: 38%;
        height: 2px;
        /* Épaisseur de la ligne */
        background: black;
        /* Couleur de la ligne */
        transform: translateY(50%);
        /* Positionne la ligne légèrement sous le texte */
        z-index: 1;
        /* Met la ligne derrière le texte */
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