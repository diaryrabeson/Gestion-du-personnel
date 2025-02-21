<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Demandes de Congé en Attente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($congesEnAttente->count() > 0)
                        <table class="min-w-full table-auto border-collapse border border-gray-300">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                 
                                    <th class="border px-4 py-2">Employé</th>
                                    <th class="border px-4 py-2">Type de Congé</th>
                                    <th class="border px-4 py-2">Date Début</th>
                                    <th class="border px-4 py-2">Date Fin</th>
                                    <th class="border px-4 py-2">Jours Ouvrables</th>
                                    <th class="border px-4 py-2 w-32">Action</th> <!-- Réduction de la largeur -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($congesEnAttente as $conge)
                                    <tr class="text-center">
                                        
                                        <td class="border px-4 py-2">
                                            {{ $conge->employers->NomEmp ?? 'Inconnu' }} 
                                            {{ $conge->employers->Prenom ?? '' }}
                                        </td>
                                        <td class="border px-4 py-2">{{ $conge->typeConge->typeConge ?? 'Inconnu' }}</td>
                                        <td class="border px-4 py-2">{{ $conge->Date_debut }}</td>
                                        <td class="border px-4 py-2">{{ $conge->Date_Fin }}</td>
                                        <td class="border px-4 py-2">{{ $conge->jours_ouvrables }}</td>
                                        <td class="border px-4 py-2 flex justify-center space-x-2">
                                            <form action="{{ route('Conger.valider', $conge->id_Conge) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btnGreen">
                                                    Approuver
                                                </button>
                                            </form>
                                            <form action="{{ route('Conger.refuser', $conge->id_Conge) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btnred">
                                                    Rejeter
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $congesEnAttente->links() }} <!-- Pagination -->
                        </div>
                    @else
                        <p class="text-center text-gray-600 dark:text-gray-400 mt-4">Aucune demande de congé en attente.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    /* From Uiverse.io by cssbuttons-io */ 
.btnGreen {
  position: relative;
  font-size: 11px;
  text-transform: uppercase;
  text-decoration: none;
  padding: 1em 2.5em;
  display: inline-block;
  cursor: pointer;
  border-radius: 6em;
  transition: all 0.2s;
  border: none;
  font-family: inherit;
  font-weight: 500;
  color: black;
  background-color: rgb(73, 173, 64);
}

.btnGreen:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.btnGreen:active {
  transform: translateY(-1px);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

.btnGreen::after {
  content: "";
  display: inline-block;
  height: 100%;
  width: 100%;
  border-radius: 100px;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
  transition: all 0.4s;
}

.btnGreen::after {
  background-color: #67af64;
}

.btnGreen:hover::after {
  transform: scaleX(1.4) scaleY(1.6);
  opacity: 0;
}


.btnred {
  position: relative;
  font-size: 11px;
  text-transform: uppercase;
  text-decoration: none;
  padding: 1em 2.5em;
  display: inline-block;
  cursor: pointer;
  border-radius: 6em;
  transition: all 0.2s;
  border: none;
  font-family: inherit;
  font-weight: 500;
  color: black;
  background-color:hsl(0, 65%, 56%);
}

.btnred:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.btnred:active {
  transform: translateY(-1px);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

.btnred::after {
  content: "";
  display: inline-block;
  height: 100%;
  width: 100%;
  border-radius: 100px;
  position: absolute;
  top: 0;
  left: 0;
  z-index: -1;
  transition: all 0.4s;
}

.btnred::after {
  background-color: hsl(0, 65%, 56%);
}

.btnred:hover::after {
  transform: scaleX(1.4) scaleY(1.6);
  opacity: 0;
}
</style>
