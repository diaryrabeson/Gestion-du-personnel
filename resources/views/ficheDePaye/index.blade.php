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
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg conteneur shadow-md mb-6">
        <form method="GET" action="{{ route('ficheDePaye.index') }}"
            class="flex flex-col md:flex-row md:items-center gap-4">
            <div class="contents">
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
        <div class="max-w-4xl marg mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
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
                        <p class="text-gray-600  dark:text-gray-300">Service : {{ $ficheDePaye['service'] }}</p>
                        <p class="text-gray-600  dark:text-gray-300">Email : {{ $ficheDePaye['email'] }}</p>
                        <p class="text-gray-600  dark:text-gray-300">Téléphone : {{ $ficheDePaye['telephone'] }}</p>
                        <p class="text-gray-600  dark:text-gray-300">Adresse : {{ $ficheDePaye['adresse'] }}</p>
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
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Détails de la Fiche de Paie</h4>
                <table class="w-full tablea border-collapse border border-gray-300 dark:border-gray-600 rounded-lg">
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
                        <tr>
                            <td class="p-2 border">Prime</td>
                            <td class="p-2 border">{{ number_format($ficheDePaye['prime'], 2) }} Ariary</td>
                        </tr>
                        <tr class="bg-blue-100 back dark:bg-blue-800 font-bold">
                            <td class="p-2 border text-blue-600 dark:text-blue-400">Salaire Total</td>
                            <td class="p-2 border text-blue-600 dark:text-blue-400">
                                {{ number_format($ficheDePaye['salaire_total'], 2) }} Ariary</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center pdf mt-4">
                    <a href="{{ route('fiche-pdf', ['mois' => request('mois'), 'annee' => request('annee')]) }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                       Pdf <i class="fas fa-file-download"></i>


                    </a>
                </div>
                
                
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
    .pdf{
        position: absolute;
        top: 6em;
        left: 71em;
    }
    .pdf a{
        color: black;
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

    .tablea {
        width: 63em !important;
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

    .contenus {
        width: 21em;
        justify-content: space-between;
    }

    .contenus img {
        width: auto;
        height: 7em;
    }

    .contents {
        display: flex;
        width: 41em;
        justify-content: space-between;
    }

    .conteneur {
        margin-top: 3em;
        margin-left: 3em;
    }

    .border {
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