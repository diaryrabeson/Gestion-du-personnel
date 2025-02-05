<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liste des Heures Supplémentaires') }}
        </h2>
    </x-slot>
    <style>
        /* From Uiverse.io by nikk7007 */ 
        .Ajout {
         --color: #00A97F;
         padding: 0.8em 1.7em;
         background-color: transparent;
         border-radius: .3em;
         position: relative;
         overflow: hidden;
         cursor: pointer;
         transition: .5s;
         font-weight: 400;
         font-size: 14px;
         border: 1px solid;
         font-family: inherit;
         text-transform: uppercase;
         color: var(--color);
         z-index: 1;
        }
        
        .Ajout::before, .Ajout::after {
         content: '';
         display: block;
         width: 50px;
         height: 50px;
         transform: translate(-50%, -50%);
         position: absolute;
         border-radius: 50%;
         z-index: -1;
         background-color: var(--color);
         transition: 1s ease;
        }
        
        .Ajout::before {
         top: -1em;
         left: -1em;
        }
        
        .Ajout::after {
         left: calc(100% + 1em);
         top: calc(100% + 1em);
        }
        
        .Ajout:hover::before, .Ajout:hover::after {
         height: 410px;
         width: 410px;
        }
        
        .Ajout:hover {
         color: rgb(10, 25, 30);
        }
        
        .Ajout:active {
         filter: brightness(.8);
        }
        
        
        .add{
            color: white;
            margin-bottom : 2em;
            background-color : green;
        
        }
        
        .back{
         background-color: rgb(79, 187, 79)  ;
         height: 2em;   
         text-align: center;
         padding-top: 0.2em;
         font-weight: bold
        }
        .flex1{
            display:flex;
            justify-content : space-between;
            
        }
        
        </style>

                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-xl">Liste des heures supplementaires</h3>
                                        <!-- Bouton pour ajouter un nouvel employé -->
                                        <a href="{{ route('supplementaires.create') }}" class="Ajout">
                                            Pointer une heure supplementaires
                                        </a>
                                        
                                        
                                    </div>
                                    @if (session('success'))
                                        <div class="custom-alert success-alert">
                                            <strong>Succès !</strong> {{ session('success') }}
                                            <span class="close-btn"
                                                onclick="this.parentElement.style.display='none';">&times;</span>
                                        </div>
                                    @endif

                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Employé
                                                </th>
                                                <th
                                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Date
                                                </th>
                                                <th
                                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Début
                                                </th>
                                                <th
                                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Fin
                                                </th>
                                                <th
                                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Nombre total d'heures
                                                </th>
                                                <th
                                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Coût total
                                                </th>
                                                <th
                                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-700 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                            @foreach ($supplementaires as $heure)
                                                <tr>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {{ $heure->Employer->NomEmp }} {{ $heure->Employer->Prenom }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                        {{ $heure->DateSys }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                        {{ $heure->DebutDeSuppl }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                        {{ $heure->FinDeSuppl }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                        {{ $heure->nb_total_heures }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                        {{ $heure->cout_total }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <a href="{{ route('supplementaire.edit', $heure->id_supplementaire) }}"
                                                            class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Modifier</a>
                                                        <form
                                                            action="{{ route('supplementaire.destroy', $heure->id_supplementaire) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-red-600 dark:text-red-400 hover:text-red-900 ml-4">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="mt-4">
                                        {{ $supplementaires->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</x-app-layout>

