<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier un Employé') }}
        </h2>
    </x-slot>

    <style>
        .form-section {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 1.5em;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5em;
            margin-top: 2em;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 0.75em;
            margin-top: 0.5em;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #4a5ba8;
            outline: none;
        }

        .form-group {
            margin-bottom: 1.5em;
        }

        .btn-submit {
            background-color: #4a5ba8;
            color: white;
            padding: 0.75em 2em;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-submit:hover {
            background-color: #4a5ba8;
        }

        .btn-cancel {
            background-color: #f44336;
            color: white;
            padding: 0.75em 2em;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-cancel:hover {
            background-color: #e53935;
        }

        .img-preview {
            margin-bottom: 1em;
            position: absolute;
            top: 5em;
            left: 90%;
        }
        .d-flex{
        display: flex;
        justify-content: space-between
    }
    .form-group{
        width: 48%
    }
    .titres {
        content: '';
        width: 38%;
        height: 2px;
        /* Épaisseur de la ligne */
        background: black;
        /* Couleur de la ligne */
        transform: translateY(50%);
        /* Positionne la ligne légèrement sous le texte */
        z-index: 1;
        /* Met la ligne derrière le texte */
    }
    </style>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl text-center font-bold w-full bg-yellow-200 p-4 ">Modifier l'Employé : {{ $employee->NomEmp }} {{ $employee->Prenom }}</h3>

                    <!-- Formulaire pour modifier un employé -->
                    <form action="{{ route('employers.update', $employee->Id_Employe) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-section">

                            <div class="text-xl relative my-4 text-center font-bold">
                                <div>
                                    <h1>Information personnel</h1>
                                </div>
                                <div class="flex justify-between absolute w-full" style="top:45%">
                                    <div class="titres">
                                        <h2></h2>
                                    </div>
                                    <div class="titres">
                                        <h2></h2>
                                    </div>
                                </div>
                            </div>
                            <!-- Champ Nom -->
                        <div class="d-flex">
                            <div class="form-group">
                                <label for="NomEmp" class="form-label">Nom</label>
                                <input type="text" name="NomEmp" id="NomEmp" class="form-control" value="{{ old('NomEmp', $employee->NomEmp) }}" required>
                            </div>

                            <!-- Champ Prénom -->
                            <div class="form-group">
                                <label for="Prenom" class="form-label">Prénom</label>
                                <input type="text" name="Prenom" id="Prenom" class="form-control" value="{{ old('Prenom', $employee->Prenom) }}" required>
                            </div>
                        </div>

                        <div class="d-flex">
                            <!-- Champ Adresse -->
                            <div class="form-group">
                                <label for="Adresse" class="form-label">Adresse</label>
                                <input type="text" name="Adresse" id="Adresse" class="form-control" value="{{ old('Adresse', $employee->Adresse) }}">
                            </div>

                            <!-- Champ Email -->
                            <div class="form-group">
                                <label for="mail" class="form-label">Email</label>
                                <input type="email" name="mail" id="mail" class="form-control" value="{{ old('mail', $employee->mail) }}" required>
                            </div>
                        </div>    
                        
                        <div class="d-flex">
                            <!-- Champ Téléphone -->
                            <div class="form-group">
                                <label for="Telephone" class="form-label">Téléphone</label>
                                <input type="text" name="Telephone" id="Telephone" class="form-control" value="{{ old('Telephone', $employee->Telephone) }}">
                            </div>

                            <!-- Champ Photo -->
                            <div class="form-group">
                                <label for="Photo" class="form-label">Photo</label>
                                @if ($employee->Photo)

                                <div class="img-preview">
                                <img src="{{ asset('storage/' . $employee->Photo) }}" alt="Photo de l'employé" width="100">
                                </div>
                                @endif

                                
                                <input type="file" name="Photo" id="Photo" class="form-control">
                            </div>
                        </div>

                        <div class="d-flex">
                            <!-- Champ Date de Naissance -->
                            <div class="form-group">
                                <label for="DatedeNaissance" class="form-label">Date de Naissance</label>
                                <input type="date" name="DatedeNaissance" id="DatedeNaissance" class="form-control" value="{{ old('DatedeNaissance', $employee->DatedeNaissance) }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="genre">Genre</label>
                                <select name="Genre" id="genre" class="form-control">
                                    <option value="Masculin" {{ old('Genre', $employee->Genre) == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                    <option value="Féminin" {{ old('Genre', $employee->Genre) == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                                </select>
                            </div>
                            
                        </div>

                        <div class="text-xl relative my-4 text-center font-bold">
                            <div>
                                <h1>Information personnel</h1>
                            </div>
                            <div class="flex justify-between absolute w-full" style="top:45%">
                                <div class="titres">
                                    <h2></h2>
                                </div>
                                <div class="titres">
                                    <h2></h2>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">

                            <!-- Champ Date d'Embauche -->
                            <div class="form-group">
                                <label for="DateD_embauche" class="form-label">Date d'Embauche</label>
                                <input type="date" name="DateD_embauche" id="DateD_embauche" class="form-control" value="{{ old('DateD_embauche', $employee->DateD_embauche) }}">
                            </div>

                            <!-- Champ Service -->
                            <div class="form-group">
                                <label for="Id_service" class="form-label">Service</label>
                                <select name="Id_service" id="Id_service" class="form-control" required>
                                    <option value="">-- Sélectionnez un service --</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id_service }}" {{ $employee->Id_service == $service->id_service ? 'selected' : '' }}>
                                            {{ $service->nomService }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex">
                            <!-- Champ Solde Congé -->
                            <div class="form-group">
                                <label for="SoldeConger" class="form-label">Solde Congé</label>
                                <input type="number" name="SoldeConger" id="SoldeConger" class="form-control" value="{{ old('SoldeConger', $employee->SoldeConger) }}" step="0.01" min="0">
                            </div>

                            <!-- Champ Salaire de Base -->
                            <div class="form-group">
                                <label for="SalaireDeBase" class="form-label">Salaire de Base</label>
                                <input type="number" name="SalaireDeBase" id="SalaireDeBase" class="form-control" value="{{ old('SalaireDeBase', $employee->SalaireDeBase) }}" step="0.01" min="0" required>
                            </div>
                        </div>
                            <!-- Boutons de soumission -->
                            <div class="flex justify-end">
                                <a href="{{ route('employers.index') }}" class="btn-cancel">Annuler</a>
                                <button type="submit" class="btn-submit ml-4">Mettre à jour</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
