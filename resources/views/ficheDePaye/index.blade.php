@php
    use Carbon\Carbon;

    setlocale(LC_TIME, 'fr_FR.utf8', 'fr_FR', 'fr', 'French');
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fiche de Paie') }}
        </h2>
    </x-slot>

    <!-- Formulaire de recherche -->
    <div class=" mx-auto bg-white dark:bg-gray-800 p-6 flex justify-between rounded-lg mt-12 shadow-md mb-6">
        <form method="GET" action="{{ route('ficheDePaye.index') }}">
            <div class="flex justify-start">
                <div class="">
                    <label for="mois" class="text-gray-700 dark:text-gray-300 font-semibold">Mois :</label>
                    <select name="mois" id="mois" class="form-control p-2 border rounded">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ request('mois', date('m')) == $m ? 'selected' : '' }}>
                                {{ Carbon::create(null, $m, 1)->locale('fr')->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="ml-4 w-full">
                    <label for="annee" class="text-gray-700 dark:text-gray-300 font-semibold">Année :</label>
                    <select name="annee" id="annee" class="form-control w-full p-2 border rounded">
                        @for ($y = date('Y') - 5; $y <= date('Y'); $y++)
                            <option value="{{ $y }}" {{ request('annee', date('Y')) == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>
           
                <div>
                    <button type="submit" class="text-white text-xs cursor-pointer bg-gray-500 px-8 py-3 rounded font-semibold mt-6  ml-8">
                        Rechercher
                    </button>
                </div>
           
 </div>
        </form>
        <div class="">
            <div class="text-center mt-2">
                <a href="{{ route('fiche-pdf', ['mois' => request('mois'), 'annee' => request('annee')]) }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                   Exporter <i class="fas fa-file-download"></i>


                </a>
            </div>
        </div>
    </div>

    <!-- Affichage de la fiche de paie -->
    @if ($ficheDePaye)
        <div class="  mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div class="randevdes">
                    <img class="logoRandev" src="http://127.0.0.1:8000/img/logo.png" alt="Description de l'image">
                    <p>R@ndevteam.com</p>
                    <p>NIF3002364629 </p>
                    <p>STAT : 6121 11 2016 0 036665 </p>
                    <p>Email : manager@rendevteam.com </p>
                    <p>Téléphone : + 261 34 94 034 55</p>

                </div>
                <div class="fichertitre">
                    <h1>FICHE DE PAIE</h1>
                </div>

            </div>
            <div class="flex information justify-between">
                <div class="flex items-center contenus space-x-4">
                    <img src="{{ asset('storage/' . $ficheDePaye['Photo']) }}" class="w-20 h-20 rounded-full"
                        alt="Photo de {{ $ficheDePaye['nom'] }}">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $ficheDePaye['nom'] }}
                            {{ $ficheDePaye['prenom'] }}
                        </h3>
                        <p class="text-gray-600  dark:text-gray-300"><span class="text-black font-bold">Fonction : </span>{{ $ficheDePaye['service'] }} {{ $ficheDePaye['descService'] }}</p>
                        <p class="text-gray-600  dark:text-gray-300"><span class="text-black font-bold">E-mail :</span> {{ $ficheDePaye['email'] }}</p>
                        <p class="text-gray-600  dark:text-gray-300"><span class="text-black font-bold">Téléphone :</span> {{ $ficheDePaye['telephone'] }}</p>
                        <p class="text-gray-600  dark:text-gray-300"><span class="text-black font-bold">Adresse :</span> {{ $ficheDePaye['adresse'] }}</p>
                    </div>
                </div>
                <div>
                    @if(request()->has('mois') && request()->has('annee'))
                        <div class="mt-4 p-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded">
                            <strong>Période sélectionnée :</strong>
                            {{ Carbon::create(request('annee'), request('mois'), 1)->locale('fr')->translatedFormat('F Y') }}
                        </div>
                    @endif
                </div>

            </div>


            <div class="mt-6">
                <div class="text-xl relative my-4 text-center font-bold">
                    <div>
                        <h1>Détails de la Fiche de Paie</h1>
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
                <table class="w-full  border-collapse  border-gray-300 dark:border-gray-600 rounded-lg">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                            <th class="p-2 border">Description</th>
                            <th class="p-2 border">Valeur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border">Salaire de Base</td>
                            <td class="p-2 border">{{ number_format($ficheDePaye['salaire_base'], 2) }} Ariary</td>
                        </tr>
                        <tr>
                            <td class="p-2 border">Présences</td>
                            <td class="p-2 border">{{ $ficheDePaye['total_presence'] ?? 0 }} jours</td>
                        </tr>
                        <tr>
                            <td class="p-2 border">Absences</td>
                            <td class="p-2 border">{{ $ficheDePaye['total_absences'] ?? 0 }} jours</td>
                        </tr>
                        <tr>
                            <td class="p-2 border">Heures Supplémentaires</td>
                            <td class="p-2 border">{{ $ficheDePaye['total_heures_supp'] ?? 0 }} heures</td>
                        </tr>
                        <tr>
                            <td class="p-2 border">Coût Total Heures Supplémentaires</td>
                            <td class="p-2 border">{{ number_format($ficheDePaye['cout_total_heures_supp'], 2) }} Ariary
                            </td>
                        </tr>
                     
                        <tr class="bg-blue-100 back dark:bg-blue-800 font-bold">
                            <td class="p-2 border text-white dark:text-white">Salaire Total</td>
                            <td class="p-2 border text-white dark:text-white">
                                {{ number_format($ficheDePaye['salaire_total'], 2) }} Ariary</td>
                        </tr>
                    </tbody>
                </table>
               
                
                
            </div>
        </div>
    @else
        <p class="text-center text-gray-600 dark:text-gray-300 mt-4">Aucune fiche de paie trouvée pour cette période.</p>
    @endif
</x-app-layout>
<style>
    @font-face {
        font-family: 'PoppinsExtraLight';
        src: url('/fonts/PoppinsExtraLight.otf') format('opentype'),
            url('/fonts/PoppinsExtraLight.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }
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
  
    .marg {
        margin-left: 2em;
    }

    .back {
        background-color: #666
    }

    .information {
        padding: 1em;
    }

   

    .fichertitre {
        font-family: 'PoppinsExtraLight';
        font-size: 2em;
        font-weight: bolder;
        margin-right: 4em;
    }

    .randevdes {
        border: 3px solid black;
        width: 35em;
        border-radius: 2em;
        padding: 1em;
    }

  

    .contenus img {
        width: auto;
        height: 7em;
    }



    /* From Uiverse.io by shah1345 */
   
</style>