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
                            <select name="Id_Employe" class="custom-select" id="Id_Employe" required>
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
                            <select name="Etat" id="Etat" class="custom-select" required>
                                <option value="Présent" {{ old('Etat') == 'Présent' ? 'selected' : '' }}>Présent</option>
                                <option value="Absent" {{ old('Etat') == 'Absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>

                        <div>
                            <label for="DateSys">Date :</label>
                            <input type="date" class="custom-select" name="DateSys" id="DateSys" value="{{ old('DateSys') }}" required>
                        </div>

                        <div>
                            <label for="motif">Motif (si Absent) :</label>
                            <textarea name="motif" class="custom-select" id="motif">{{ old('motif') }}</textarea>
                        </div>
                    
                        <div class="contents">                
                        <button type="submit" class="button">Pointer</button>
                        </div>
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

/* Style du label */
label {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

/* Style du select */
.custom-select {
    width: 100%;
    max-width: 60em;  /* Ajuste la largeur */
    padding: 10px;
    font-size: 16px;
    border: 2px solid #8aaed3;  /* Bordure bleue */
    border-radius: 5px;
    background-color: white;
    color: #333;
    cursor: pointer;
    transition: 0.3s;
}

/* Effet au survol */
.custom-select:hover {
    border-color: #0056b3;
}

/* Effet au focus */
.custom-select:focus {
    outline: none;
    border-color: #87e27b;  /* Change la couleur au focus */
    box-shadow: 0 0 5px rgba(255, 102, 0, 0.5);
}

/* Style des options */
.custom-select option {
    font-size: 16px;
    background: white;
    color: #333;
}

/* Désactive l'option par défaut */
.custom-select option:first-child {
    color: gray;
}



/*css pour le button*/
/* From Uiverse.io by nikk7007 */ 
.button {
 --color: #00A97F;
 padding: 0.8em 1.7em;
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
.contents{
    margin: 1em 0em 0 2em;
}
</style>