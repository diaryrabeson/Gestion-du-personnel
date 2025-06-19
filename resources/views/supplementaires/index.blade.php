<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liste des Heures Supplémentaires') }}
        </h2>
    </x-slot>
    <style>
   
        .add{
            color: white;
            margin-bottom : 2em;
            background-color : green;
        
        }
        
        .back{
         background-color: rgb(79, 187, 79)  ;
         height: 2em;   
         text-align: center;
         padding-top: 0.2em;
         font-weight: bold
        }
        .flex1{
            display:flex;
            justify-content : space-between;
            
        }
       

        .suppr {
            background-color: #e63946;
            /* Couleur de fond */
            color: white;
            /* Couleur du texte */
            padding: 10px 15px;
            /* Espacement interne */
            border: none;
            /* Pas de bordure */
            border-radius: 5px;
            /* Coins arrondis */
            font-size: 16px;
            /* Taille de la police */
            cursor: pointer;
            /* Curseur en forme de main */
            transition: background-color 0.3s, transform 0.2s;
            /* Effets de transition */
        }

        .suppr:hover {
            background-color: #d62839;
            /* Couleur au survol */
            transform: scale(1.05);
            /* Légère augmentation de la taille */
        }

        .suppr:active {
            transform: scale(0.95);
            /* Réduction de la taille au clic */
        }

        .retour {
            background-color: #6c6c6c;
            /* Couleur de fond claire */
            color: #ffffff;
            /* Couleur du texte */
            padding: 10px 15px;
            /* Espacement interne */
            border: none;
            /* Pas de bordure */
            border-radius: 5px;
            /* Coins arrondis */
            font-size: 16px;
            /* Taille de la police */
            cursor: pointer;
            /* Curseur en forme de main */
            transition: background-color 0.3s, transform 0.2s;
            /* Effets de transition */
        }

        .retour:hover {
            background-color: #a8dadc;
            /* Couleur au survol */
            transform: scale(1.05);
            /* Légère augmentation de la taille */
        }

        .retour:active {
            transform: scale(0.95);
            /* Réduction de la taille au clic */
        }
        th{
            background-color: rgb(150, 150, 147);
            border:  #e5e7eb 1px solid;
        }
        td ,th{
            border: #e5e7eb 1px solid;
        }
        div.dt-container .dt-search{
            margin-bottom: 1em !important;
            text-align: right;
            left: 0em !important;
            margin-top: 3% !important;
            position: absolute !important;
        }
  

        .modal-content h2 {
            background-color: #080824;
            color: white;
            font-weight: 700;
            font-size: 1.3em
        }

        .modal-content p {
            margin-top: 1em;
            margin-bottom: 1em;
            font-size: 1.3em
        }

        .modal-content {
            height: 30%;
            border-radius: 1em;
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 25em;
            text-align: center;
            transform: translateY(-30px);
            /* Déplacement vers le haut */
            transition: transform 0.3s ease;
            /* Transition de transformation */
        }

        .modal.show .modal-content {
            transform: translateY(0);
            /* Remettre à sa place */
        }

        .modal.show {
            display: block;
            /* Afficher la modale */
            opacity: 1;
            /* Opacité finale */
        }
        </style>
        <script>
            $(document).ready(function() {
                $('#TableSupplementaire').DataTable({
                    // Supprimez les options pour activer la pagination et la recherche
                    language: {
                    "sProcessing": "Traitement en cours...",
                    "sSearch": "Rechercher&nbsp;:",
                    "sLengthMenu": "",
                    "sInfo": "Affichage de l'enregistrement _START_ à _END_ sur _TOTAL_ enregistrements",
                    "sInfoEmpty": "Affichage de l'enregistrement 0 à 0 sur 0 enregistrements",
                    "sZeroRecords": "Aucun enregistrement à afficher",
                    "sInfoFiltered": "(filtré à partir de _MAX_ enregistrements au total)", // Traduction ajoutée
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sPrevious": "Précédent",
                        "sNext": "Suivant",
                        "sLast": "Dernier"
                        }
                    }
                });
            });
            
           
            </script>
            <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />
            <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
                    <div class="py-2">
                        <div class="mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <div class="text-xl text-center font-bold w-full bg-yellow-200 p-4 mb-4">
                                        <h3 class="text-xl">Liste des heures supplementaires</h3>    </div>
                                        <!-- Bouton pour ajouter un nouvel employé -->
                                       <div class="float-right absolute z-50" style="left:90%" > 
                                        <a href="{{ route('supplementaires.create') }}" class=" bg-blue-500 text-white  px-4 py-2 rounded">
                                        <i class="fa-solid fa-plus text-bold"></i>  Pointer</a>
                                    </div>
                                        
                                        
                                
                                    @if(session('success'))
                                    <div class="bg-green-500 text-white top-20 p-4 rounded mb-4 absolute" style="width: 73%">
                                        <span>{{ session('success') }}</span>
                                        <button onclick="this.parentElement.style.display='none';" class="absolute top-1 right-1 text-white">
                                            <i class="fa-solid fa-times"></i> <!-- Assurez-vous d'inclure Font Awesome -->
                                        </button>
                                    </div>
                                @endif

                                    <table class="" id="TableSupplementaire" style="margin-top: 2%" >
                                        <thead>
                                            <tr>
                                                <th> Employé  </th>
                                                <th> Date </th>
                                                <th>Début  </th>
                                                <th> Fin </th>
                                                <th> Nombre total d'heures </th>
                                                <th> Coût total </th>
                                                <th> Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach ($supplementaires as $heure)
                                                <tr>
                                                    <td>
                                                        {{ $heure->Employer->NomEmp }} {{ $heure->Employer->Prenom }}
                                                    </td>
                                                    <td>
                                                        {{ $heure->DateSys }}
                                                    </td>
                                                    <td>
                                                        {{ $heure->DebutDeSuppl }}
                                                    </td>
                                                    <td>
                                                        {{ $heure->FinDeSuppl }}
                                                    </td>
                                                    <td>
                                                        {{ $heure->nb_total_heures }}
                                                    </td>
                                                    <td class="text-right">
                                                        {{ $heure->cout_total }}Ar
                                                    </td>
                                                    <td class=" text-sm font-medium flex justify-center">
                                                        <a href="{{ route('supplementaire.edit', $heure->id_supplementaire) }}"
                                                            class="bg-yellow-300 text-black px-3 py-1 rounded mr-2" style="color: blue"> <i class="fa-solid fa-pen-to-square"></i></a>
                                                            <form id="deleteForm-{{ $heure->id_supplementaire }}" action="{{ route('supplementaire.destroy', $heure->id_supplementaire) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" onclick="openModal({{ $heure->id_supplementaire }})" class="bg-red-300 text-black px-3 py-1 rounded" style="color:crimson">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </button>
                                                            </form>


                                                            

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div id="confirmationModal" class="modal" style="display: none; position: fixed; z-index: 1000; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.4);">
                                        <div class="modal-content">
                                            <h2>Demande de confirmation</h2>
                                            <p>Voulez-vous vraiment supprimer cet enregistrement ?</p>
                                            <button onclick="closeModal()" class="retour" style="margin-left: 10px;">
                                                <i class="fa-solid fa-xmark"></i> Annuler
                                            </button>
                                            <button id="confirmDelete" class="suppr" style="background-color: crimson; color: white; padding: 8px 16px; margin-top: 10px;">
                                                <i class="fa-solid fa-trash-can"></i> Supprimer
                                            </button>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
</x-app-layout>

<script>
    let selectedFormId = null;

    function openModal(id) {
        selectedFormId = "deleteForm-" + id;
        document.getElementById("confirmationModal").style.display = "block";
    }

    function closeModal() {
        selectedFormId = null;
        document.getElementById("confirmationModal").style.display = "none";
    }

    document.getElementById("confirmDelete").addEventListener("click", function () {
        if (selectedFormId) {
            document.getElementById(selectedFormId).submit();
        }
    });

    // Ferme la modale si on clique en dehors
    window.onclick = function (event) {
        const modal = document.getElementById("confirmationModal");
        if (event.target === modal) {
            closeModal();
        }
    };
</script>
