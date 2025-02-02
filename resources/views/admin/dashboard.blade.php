<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome to the Admin Dashboard!") }}
                </div>
            </div>

        
        </div>
    </div>

    <script>
        // Fonction pour empêcher le retour en arrière et réécrire l'historique
        function preventBack() {
            // Réécrire l'historique pour rendre la page "actuelle" et empêcher toute tentative de retour
            window.history.pushState(null, null, window.location.href); // Réécrit l'historique avec l'URL actuelle
            window.history.pushState(null, null, window.location.href); // Double push pour être sûr

            // Lorsque l'utilisateur essaie de revenir en arrière
            window.onpopstate = function () {
                console.log("Tentative de retour en arrière captée !");
                alert("Vous ne pouvez pas revenir en arrière. Cette action a été bloquée."); // Message de test

                // Remet la page actuelle dans l'historique pour l'empêcher de revenir
                window.history.pushState(null, null, window.location.href); 
                // On ne recharge pas la page pour ne pas perturber le flux.
            };

            // Rafraîchir immédiatement après le chargement de la page
            window.onload = function() {
                setTimeout(function(){
                    window.history.pushState(null, null, window.location.href); // Réécrire l'historique à nouveau
                }, 0);
            };
        }

        // Appliquer la fonction pour empêcher le retour en arrière
        preventBack();
    </script>

</x-app-layout>
