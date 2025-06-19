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
        <div class="flex items-center space-x-4">
            <div>
                <img src="{{ asset('storage/' . $Profile['Photo']) }}" class="w-20 h-20 rounded" alt="Photo de {{ $Profile['nom'] }}">
           
            </div>
             <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg" style="width:87%">
               <div class="flex">
                    <h4 class="font-bold text-xl">Nom  :</h4><p class="text-xl text-gray-600 dark:text-gray-300">{{ $Profile['nom'] }}</p>
                    <h4 class="font-bold text-xl ml-4">Prénom :</h4><p class="text-xl text-gray-600 dark:text-gray-300">{{ $Profile['prenom'] }}</p>
                </div>
               <div class="flex"><h4 class="font-bold text-xl">Fonction :</h4>  <p class="text-xl text-gray-600 dark:text-gray-300">{{ $Profile['service'] }} {{ $Profile['descService'] }} </p></div> 
                <div class="flex"><h4 class="font-bold text-xl">Email :</h4><p class="text-xl text-gray-600 dark:text-gray-300"> {{ $Profile['email'] }}</p></div>
                <div class="flex"><h4 class="font-bold text-xl">Téléphone : </h4> <p class="text-xl text-gray-600 dark:text-gray-300">{{ $Profile['telephone'] }}</p></div>
                <div class="flex"><h4 class="font-bold text-xl">Adresse :</h4><p class="text-xl text-gray-600 dark:text-gray-300"> {{ $Profile['adresse'] }}</p></div>
                <div class="flex"><h4 class="font-bold text-xl">Solde Conger :</h4> <p class="text-xl text-gray-600 dark:text-gray-300"> {{ $Profile['SoldeConger'] }} Jours</p></div>
                <div class="flex"><h4 class="font-bold text-xl">Date de naissance :</h4> <p class="text-xl text-gray-600 dark:text-gray-300"> {{ $Profile['DateDeNaissance'] }}</p></div>
                <div class="flex"><h4 class="font-bold text-xl">Genre :</h4> <p class="text-xl text-gray-600 dark:text-gray-300"> {{ $Profile['Genre'] }}</p></div>
                
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
            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                <p><strong>Date d'embauche :</strong> {{ $Profile['DateD_embauche	'] }}</p>
                <p><strong>Rôle :</strong> Employer</p>
                <p><strong>Salaire de base :</strong>  {{ $Profile['SalaireDeBase'] }} Ariary</p>
             
              
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