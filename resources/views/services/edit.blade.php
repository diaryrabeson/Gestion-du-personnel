<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier le Service') }}
        </h2>
    </x-slot>
    @if($errors->any())
        <div class="bg-red-500 text-white p-4 rounded relative top-12 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl text-center font-bold w-50 bg-yellow-200 p-4 mb-4">Modification du fonction</h3>

                    <!-- Formulaire de modification -->
                    <form action="{{ route('services.update', $service->id_service) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nomService" class="block text-sm font-medium text-gray-700">Fontion</label>
                            <input type="text" name="nomService" id="nomService"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                value="{{ $service->nomService }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="Description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="Description" id="Description"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $service->Description }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <a href="http://127.0.0.1:8000/services" class="btn-cancel">Annuler</a>
                            <button type="submit" class="Ajout ml-4">
                                Mettre à jour
                            </button>

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