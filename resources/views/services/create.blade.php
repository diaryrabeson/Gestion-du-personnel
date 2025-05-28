<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl">Créer un nouveau fonction</h3>

                    <!-- Form to add a new service -->
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nomService" class="block text-sm font-medium text-gray-700">Fonction</label>
                            <input type="text" name="nomService" id="nomService"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="Description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="Description" id="Description"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <div class="mb-4">
                            <div class="flex justify-between">
                                <button type="submit" class="Ajout">
                                    Ajouter
                                </button>
                                <a href="http://127.0.0.1:8000/services" class="btn-cancel">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .btn-cancel {
        background-color: #f44336;
        color: white;
        padding: 0.75em 2em;
        border-radius: 8px;
        font-weight: bold;
    }

    .Ajout {
        --color: #28916e;
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

    .Ajout::before,
    .Ajout::after {
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

    .Ajout:hover::before,
    .Ajout:hover::after {
        height: 410px;
        width: 410px;
    }

    .Ajout:hover {
        color: rgb(10, 25, 30);
    }

    .Ajout:active {
        filter: brightness(.8);
    }
</style>