<!-- resources/views/employers/index.blade.php -->


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employés') }}
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
                    <h3 class="text-xl">Liste des Employés</h3>
                    <!-- Bouton pour ajouter un nouvel employé -->
                    <a href="{{ route('employers.create') }}" class="Ajout">
                        Ajouter un Employé
                    </a>
                    
                    
                </div>
                
                <!-- Liste des employés -->
                <ul>
                    @foreach($employees as $employee)
                        <li class="flex justify-between items-center mb-2 border-b pb-2">
                            <!-- Affichage des informations principales -->
                            <span>
                                {{ $employee->NomEmp }} {{ $employee->Prenom }} - 
                                {{ $employee->Service }} ({{ $employee->Telephone }})
                            </span>
                            
                            <!-- Boutons d'action pour chaque employé -->
                            <div>
                                <!-- Bouton d'édition avec l'ID de l'employé -->
                                <a href="{{ route('employers.edit', ['id_Employe' => $employee->Id_Employe]) }}" 
                                    class="bg-yellow-300 text-black px-3 py-1 rounded mr-2">
                                     Modifier
                                 </a>
                                 
                                <!-- Formulaire de suppression -->
                                <form action="{{ route('employers.destroy', ['id_Employe' => $employee->Id_Employe]) }}" 
                                    method="POST" 
                                    style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" 
                                          class="bg-red-300 text-black px-3 py-1 rounded">
                                      Supprimer
                                  </button>
                              </form>
                              
                            </div>
                        </li>
                    @endforeach
                </ul>
                
                <!-- Pagination (si nécessaire) -->
                <div class="mt-4">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>

