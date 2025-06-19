<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer un Type de Congé') }}
        </h2>
    </x-slot>
    @if($errors->any())
    <div id="error-message" class="bg-red-500 text-white p-4 relative top-12 rounded mb-4">
        <button onclick="closeErrorMessage()" class="absolute top-1 right-1 text-white">✖</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-xl text-center font-bold w-full bg-yellow-200 p-4 mb-4">
                        <h3 class="text-xl mb-4">Ajouter un Type de Congé</h3>
                    </div>


                    <!-- Formulaire de création -->
                    <form action="{{ route('TypeConger.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Champ Type de Congé -->
                        <div>
                            <label for="typeConge" class="block text-xl font-medium text-gray-700 dark:text-gray-300">
                                Type de Congé :
                            </label>
                            <input type="text" name="typeConge" id="typeConge" required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Bouton d'enregistrement -->
                        <div class="flex justify-end">
                            <a href="http://127.0.0.1:8000/listes-de-type-conger" class="btn-cancel">Annuler</a>
                            <button type="submit" class="button">
                                Ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function closeErrorMessage() {
        document.getElementById("error-message").style.display = "none"; // Masquer le message
    }
</script>
<style>
   
    .btn-cancel {
        background-color: #f44336;
        color: white;
        padding: 0.75em 2em;
        border-radius: 8px;
        font-weight: bold;
    }
    /* From Uiverse.io by nikk7007 */
    .button {
        --color: #28916e;
        margin-left: 1em;
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

    .button::before,
    .button::after {
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

    .button::before {
        top: -1em;
        left: -1em;
    }

    .button::after {
        left: calc(100% + 1em);
        top: calc(100% + 1em);
    }

    .button:hover::before,
    .button:hover::after {
        height: 410px;
        width: 410px;
    }

    .button:hover {
        color: rgb(10, 25, 30);
    }

    .button:active {
        filter: brightness(.8);
    }
</style>