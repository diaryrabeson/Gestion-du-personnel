<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier le Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl">Modifier le Service</h3>

                    <!-- Formulaire de modification -->
                    <form action="{{ route('services.update', $service->id_service) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nomService" class="block text-sm font-medium text-gray-700">Nom du Service</label>
                            <input type="text" name="nomService" id="nomService" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $service->nomService }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="Description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="Description" id="Description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $service->Description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-600 transition">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
