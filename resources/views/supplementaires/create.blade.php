<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter une Heure Supplémentaire') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="text-xl text-center font-bold w-full bg-yellow-200 p-4 ">
                        <h3 class="text-xl ">Pointage des heures supplementaires</h3>    </div>


                    @if ($errors->has('error'))
                        <div class="custom-alert error-alert">
                            <strong>Erreur !</strong> {{ $errors->first('error') }}
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="custom-alert success-alert">
                            <strong>Succès !</strong> {{ session('success') }}
                            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('supplementaire.store') }}" method="POST">
                        @csrf
                        <div class="mb-4" style="width: 100%;">
                            <label for="Id_Employe" class="block font-bold text-xl mt-4">Employé :</label>
                            <select name="Id_Employe" id="Id_Employe" class="w-full p-2 border rounded" required>
                                <option value="" disabled selected>-- Sélectionnez un employé --</option>
                                @foreach($employes as $employe)
                                <option value="{{ $employe->Id_Employe }}" {{ old('Id_Employe') == $employe->Id_Employe ? 'selected' : '' }}>
                                    {{ $employe->NomEmp }} {{ $employe->Prenom }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="flex justify-between">
                        <div class="mb-4">
                            <label for="DateSys" class="block font-bold text-xl">Date :</label>
                            <input type="date" name="DateSys" id="DateSys" class="w-full p-2 border rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="CoutParHeure" class="block font-bold text-xl">Coût par Heure :</label>
                            <input type="number" step="0.01" name="CoutParHeure" id="CoutParHeure" class="w-full p-2 border rounded" required>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="mb-4">
                            <label for="DebutDeSuppl" class="block font-bold text-xl">Début :</label>
                            <input type="time" name="DebutDeSuppl" id="DebutDeSuppl" class="w-full p-2 border rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="FinDeSuppl" class="block font-bold text-xl  ">Fin :</label>
                            <input type="time" name="FinDeSuppl" id="FinDeSuppl" class="w-full p-2 border rounded" required>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="mb-4">
                            <label class="font-bold text-xl">Nombre total d'heures :</label>
                            <input type="text" name="nb_total_heures" id="nb_total_heures" class="w-full p-2 border rounded bg-gray-200" readonly>
                        </div>

                        <div class="mb-4">
                            <label class="font-bold text-xl">Coût total :</label>
                            <input type="text" id="cout_total" name="cout_total" class="w-full p-2 border rounded bg-gray-200" readonly>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <div class="retour">
                        <a href="http://127.0.0.1:8000/supplementaires" class="btn-cancel">Annuler</a>
                    </div>
                        <div class="contents">   
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded button">
                            Pointer
                            </button>
                    </div>
                </div>
                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function calculateTotals() {
        let debut = document.getElementById('DebutDeSuppl').value;
        let fin = document.getElementById('FinDeSuppl').value;
        let coutParHeure = parseFloat(document.getElementById('CoutParHeure').value);

        if (debut && fin && coutParHeure) {
            let start = new Date("1970-01-01T" + debut + "Z");
            let end = new Date("1970-01-01T" + fin + "Z");
            let totalHeures = (end - start) / 3600000;
            
            document.getElementById('nb_total_heures').value = totalHeures.toFixed(2);
            document.getElementById('cout_total').value = (totalHeures * coutParHeure).toFixed(2);
        }
    }

    document.getElementById('DebutDeSuppl').addEventListener('change', calculateTotals);
    document.getElementById('FinDeSuppl').addEventListener('change', calculateTotals);
    document.getElementById('CoutParHeure').addEventListener('input', calculateTotals);
</script>
<style>
    .btn-cancel {
        background-color: #f44336;
        color: white;
        padding: 1em 2em;
        border-radius: 8px;
        font-weight: bold;
        display: block;
        margin-top: 1em;
        cursor: pointer;
    }

    .custom-alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 15px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        animation: fadeIn 0.5s ease-in-out;
        width: 100%;
    }

    .error-alert {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .success-alert {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .close-btn {
        font-weight: bold;
        cursor: pointer;
        padding: 0 10px;
        font-size: 20px;
        border: none;
        background: none;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .button {
        --color: #00A97F;
        width: 10%;
        background-color: transparent;
        border-radius: .3em;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: .5s;
        font-weight: 400;
        font-size: 17px;
        border: 1px solid;
        font-family: inherit;
        text-transform: uppercase;
        color: var(--color);
        z-index: 1;
        margin-top:1.5%;
        margin-left: 1em
}

.button::before, .button::after {
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

.button:hover::before, .button:hover::after {
 height: 410px;
 width: 410px;
}

.button:hover {
 color: rgb(10, 25, 30);
}

.button:active {
 filter: brightness(.8);
}
.mb-4{
    width: 48%;
}
</style>
