<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pointage de Présence') }}
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
                    <!-- Affichage des messages d'erreur -->
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Affichage des messages de succès -->
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Formulaire de pointage -->
                    <form action="{{ route('presence.pointer') }}" method="POST">
                        @csrf
                        <div>
                            <label for="Id_Employe">Employé :</label>
                            <select name="Id_Employe" id="Id_Employe" required>
                                <option value="" disabled selected>-- Sélectionnez un employé --</option>
                                @foreach($employes as $employe)
                                    <option value="{{ $employe->Id_Employe }}" {{ old('Id_Employe') == $employe->Id_Employe ? 'selected' : '' }}>
                                        {{ $employe->NomEmp }} {{ $employe->Prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="Etat">État :</label>
                            <select name="Etat" id="Etat" required>
                                <option value="Présent" {{ old('Etat') == 'Présent' ? 'selected' : '' }}>Présent</option>
                                <option value="Absent" {{ old('Etat') == 'Absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>

                        <div>
                            <label for="DateSys">Date :</label>
                            <input type="date" name="DateSys" id="DateSys" value="{{ old('DateSys') }}" required>
                        </div>

                        <div>
                            <label for="motif">Motif (si Absent) :</label>
                            <textarea name="motif" id="motif">{{ old('motif') }}</textarea>
                        </div>
                    
                                        
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4">Pointer</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<style>
    /* Styles communs pour les alertes */
.custom-alert {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 15px;
    position: absolute;
    font-family: Arial, sans-serif;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    animation: fadeIn 0.5s ease-in-out;
    width: 69em;
}

.custom-alert strong {
    font-weight: bold;
}

/* Alertes pour les erreurs */
.error-alert {
    background-color: #f8d7da; /* Rouge clair */
    color: #721c24; /* Rouge foncé */
    border: 1px solid #f5c6cb;
}

/* Alertes pour les succès */
.success-alert {
    background-color: #d4edda; /* Vert clair */
    color: #155724; /* Vert foncé */
    border: 1px solid #c3e6cb;
}

/* Bouton de fermeture */
.close-btn {
    color: inherit;
    font-weight: bold;
    cursor: pointer;
    padding: 0 10px;
    font-size: 20px;
    line-height: 20px;
    border: none;
    background: none;
}

/* Animation d'apparition */
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