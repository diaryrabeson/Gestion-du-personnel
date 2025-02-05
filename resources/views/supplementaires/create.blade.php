<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter une Heure Supplémentaire') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

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
                        <div class="mb-4">
                            <label for="Id_Employe" class="block">Employé :</label>
                            <select name="Id_Employe" id="Id_Employe" class="w-full p-2 border rounded" required>
                                <option value="" disabled selected>-- Sélectionnez un employé --</option>
                                @foreach($employes as $employe)
                                <option value="{{ $employe->Id_Employe }}" {{ old('Id_Employe') == $employe->Id_Employe ? 'selected' : '' }}>
                                    {{ $employe->NomEmp }} {{ $employe->Prenom }}
                                </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="DateSys" class="block">Date :</label>
                            <input type="date" name="DateSys" id="DateSys" class="w-full p-2 border rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="CoutParHeure" class="block">Coût par Heure :</label>
                            <input type="number" step="0.01" name="CoutParHeure" id="CoutParHeure" class="w-full p-2 border rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="DebutDeSuppl" class="block">Début :</label>
                            <input type="time" name="DebutDeSuppl" id="DebutDeSuppl" class="w-full p-2 border rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="FinDeSuppl" class="block">Fin :</label>
                            <input type="time" name="FinDeSuppl" id="FinDeSuppl" class="w-full p-2 border rounded" required>
                        </div>

                        <div class="mb-4">
                            <label>Nombre total d'heures :</label>
                            <input type="text" name="nb_total_heures" id="nb_total_heures" class="w-full p-2 border rounded bg-gray-200" readonly>
                        </div>

                        <div class="mb-4">
                            <label>Coût total :</label>
                            <input type="text" id="cout_total" name="cout_total" class="w-full p-2 border rounded bg-gray-200" readonly>
                        </div>
                       

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Enregistrer
                        </button>
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
</style>
