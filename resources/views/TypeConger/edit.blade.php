<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier le Type de Congé') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl mb-4">Modifier le Type de Congé</h3>
                    
                    <!-- Formulaire de modification -->
                    <form action="{{ route('TypeConger.update', $typeConger->id_typeConge) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <!-- Champ Type de Congé -->
                        <div>
                            <label for="typeConge" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Type de Congé :
                            </label>
                            <input type="text" name="typeConge" id="typeConge" value="{{ $typeConger->typeConge }}" required 
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Bouton de mise à jour -->
                        <div>
                            <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
