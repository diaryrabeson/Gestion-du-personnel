<!-- resources/views/layouts/menu.blade.php -->
<style>
    .menu {
        display: none;
        /* Masqué par défaut sur mobile */
    }

    .menu.active {
        display: block;
        /* Affiche le menu lorsqu'il est actif */
    }

    @media screen and (max-width: 1580px) {

        .liens {
            /* background-color: rgba(59, 130, 246, 0.7); Bleu avec une transparence */
            transition: background-color 0.3s ease;
            border-radius: 10px;
            height: 73%;
            width: 13em;
        }

        .men:hover {
            background-color: rgba(59, 130, 246, 1);
            /* Bleu moins transparent au survol */
        }

        .men:active {
            background-color: rgba(29, 78, 216, 1);
            /* Un bleu plus foncé au clic */
        }

        .navig {
            display: inline-block;
            margin-top: 4.6em;
            padding: 12px 24px;
            position: inherit;
            top: -.6em;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            background-color: #1a2035 !important;
            /* Couleur de fond primaire */
            /* background-image: linear-gradient(to right, #3b82f6, #0824a1, #013594), url('/resources/img/technologie.jpg'); Dégradé sur fond d'image */
            background-size: cover;
            background-position: center;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s, box-shadow 0.3s;
            width: 19vw;
            height: 100%;
        }

        .burgu {
            display: none;
            color: black;
            font-size: 3em;
            position: absolute;

        }

        .menu {
            display: block;
            /* Affiche le menu par défaut sur les écrans plus larges */
        }
    }

    @media screen and (max-width: 768px) {

        .burgu {
            display: inline;
            color: black;
            font-size: 2em;
            position: absolute;

            left: 90vw;

        }

        .menu.active {
            height: 100px;
            /* Hauteur maximale lorsque le menu est actif (ajustez selon votre contenu) */
        }

        .menu {
            display: none;
            width: 100%;
            overflow: hidden;
            /* Masquez le débordement */
            transition: max-height 0.3s ease;
            /* Animation fluide */
            text-justify: center;
        }
    }

    .d_flex {
        display: flex;
        margin-top: 2em;
    }
    .fonts{
    line-height: 1.5em;
    font-size: 24px;    

}
</style>




<!-- Bouton Hamburger -->
<div class="fixed top-5 left-5 z-20">
    <button id="menu-toggle" class="burgu text-black bg-blue-800 p-2 rounded">
        &#9776; <!-- Symbole hamburger -->
    </button>
</div>
<div id="loadingOverlay"
     style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.3); z-index: 9999; justify-content: center; align-items: center;">
    <img src="{{ asset('img/Loading5.gif') }}" alt="Chargement..." style="width: auto;
    height: 13em;position: relative;
   ">
</div>
<!-- Menu Vertical à gauche -->

<div
    class=" menu navig fixed top-24 left-0 bg-blue-800 text-white border-r border-gray-100 dark:border-gray-700 p-4 w-60 h-full">
    <ul class="liens space-y-4">
        <div class="d_flex men">
            <i class="fa-solid fa-circle-user men fonts"></i>
            <li>
                <a href="{{ route('ProfileEmployer.profile') }}"
                    class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                    Profile employé
                </a>
            </li>
        </div>
       
        
        <div class="d_flex men">
            <i class="fa-solid fa-address-card men fonts"></i>
            <li>
                <a href="{{ route('Conger.create') }}"
                    class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                    Demande de Congé
                </a>
            </li>
        </div>

        <div class="d_flex men">
            <i class="fa-solid fa-pen-nib men fonts"></i>
            <li>
                <a href="{{ route('ficheDePaye.index') }}"
                    class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                    Fiche de paie
                </a>
            </li>
        </div>

        <div class="d_flex men">
            <i class="fa-solid fa-message men fonts"></i>
            <li>
                <a href="{{ route('Messages.Listing') }}" class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                    Message
                </a>
            </li>
        </div>

        <div class="d_flex men">
            <i class="fa-solid fa-right-from-bracket men fonts"></i>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="men logouts">Déconnexion</button>
                </form>
                
            </li>
        </div>
    </ul>
</div>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const menu = document.querySelector('.menu');
        menu.classList.toggle('active'); // Ajoute ou enlève la classe active
    });



    
    //ceci est le code pour une lien de Chargement
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.men a');
        const overlay = document.getElementById('loadingOverlay');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                // Montre le loader juste après le clic (et avant la redirection)
                overlay.style.display = 'flex';
            });
        });

        // Pour les boutons de formulaire comme "Déconnexion"
        const logoutBtn = document.querySelector('form button[type="submit"]');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function () {
                overlay.style.display = 'flex';
            });
        }
    });
</script>