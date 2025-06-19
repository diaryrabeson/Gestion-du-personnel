<!-- resources/views/layouts/menu.blade.php -->
<style>
    .men {
        padding-top: 11px;
    }

    .fonts {
        line-height: 1.5em;
        font-size: 24px;

    }

    

    .menu.active {
        display: block;
        /* Affiche le menu lorsqu'il est actif */
    }

   
        .d_flex {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;

        }

        .liens {
            /* background-color: rgba(0, 0, 0, 0.5); Bleu avec une transparence */

            transition: background-color 0.3s ease;
            border-radius: 10px;
            height: 73%;
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
            background-color: #1a2035 !important;
            /* margin-top: -.2em; */
            padding: 2em 5px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            /* background-color: rgb(70, 66, 66); Couleur de fond primaire */
            /* background-image: url('{{ asset('img/technologie4.jpg') }}'); Dégradé sur fond d'image */
            background-size: cover;
            background-position: center;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s, box-shadow 0.3s;
            width: 19vw;
            height: 100%;
            transition: all 0.5s ease;
        }

        .logouts {
            line-height: 2.5em;
            margin-left: .5em
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
        .mobile-menu {
            margin-left: 0;
        }

   

    @media screen and (max-width: 768px) {

        .burgu {
            display: inline;
            color: black;
            font-size: 2em;
            position: absolute;
            top: -2.2em;
            left: 90vw;

        }

        .mobile-menu {
            margin-left: 0 !important;
        }

        .menu.active {
            /* height: 100px; */
            /* Hauteur maximale lorsque le menu est actif (ajustez selon votre contenu) */
        }

        .menu {
            display: flex;
            width: 100%;
            height: auto;
            overflow: hidden;
            /* Masquez le débordement */
            transition: max-height 0.3s ease;
            /* Animation fluide */
            text-justify: center;
            position: absolute;
            justify-content: center;

        }

        .d_flex {
            display: flex;
            justify-content: center
        }

        .navig {
            display: inline-block;
            background-color: #1a2035c7 !important;
            backdrop-filter: blur(7px);
            /* margin-top: -.2em; */
            padding: 2em 24px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            /* background-color: rgb(70, 66, 66); Couleur de fond primaire */
            /* background-image: url('{{ asset('img/technologie4.jpg') }}'); Dégradé sur fond d'image */
            background-size: cover;
            background-position: center;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
            margin-left: -100%
        }

    }

    div.notific {
        position: absolute;
        top: 2.2em;
        left: 12em;
        background: #9595ff;
        width: 2em;
        border-radius: 1em;
    }
   
</style>




<!-- Bouton Hamburger -->


<!-- Menu Vertical à gauche -->
<div class=" menu navig fixed  left-0 bg-blue-800 text-white border-r border-gray-100 dark:border-gray-700  w-60 h-full">
    <ul class="liens ">
        <div class="fixed menuHamburger top-5 left-5 z-20">
            <button id="menu-toggle" class="burgu text-black bg-blue-800 p-2 rounded">
                &#9776; <!-- Symbole hamburger -->
            </button>
        </div>
       


        <div class="d_flex w-full ">
           
            <li class="w-full text-left">
                <a href="{{ route('Conger.pending') }}"
                    class="men w-full block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700" >
                     <i class="fa-solid fa-address-card men fonts mr-4"></i> <span>Validation Congée</span>
                </a>
            </li>
        </div>
        <div class="d_flex w-full">
           
            <li class="w-full text-left">
                <a href="{{ route('employers.index') }}"
                    class="men w-full block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                    <i class="fa-solid fa-circle-user men fonts mr-4"></i><span>Employés</span>  
                </a>
            </li>
        </div>
        <div class="d_flex w-full">
            
            <li class="w-full text-left">
                <a href="{{ route('services.index') }}"
                    class="men w-full block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                    <i class="fa-solid fa-gear men fonts mr-4"></i><span>Fonction</span>
                </a>
            </li>
        </div>

        <div class="d_flex w-full">
          
            <li class="w-full text-left">
                <a href="{{ route('TypeConger.index') }}"
                    class="men w-full block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                    <i class="fa-regular fa-file-lines men fonts mr-4"></i><span>Type Congé</span>
                </a>
            </li>
        </div>
        <div class="d_flex w-full">
          
            <li class="w-full text-left">
                <a href="{{ route('presence.list') }}"
                    class="men w-full block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                    <i class="fa-solid fa-pen-nib men fonts mr-4"></i> <span>Pointage</span> 
                </a>
            </li>
        </div>

        <div class="d_flex w-full">
           
            <li class="w-full text-left">
                <a href="{{ route('supplementaires.index') }}"
                    class="men w-full block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                    <i class="fa-solid fa-calendar-week men fonts mr-4"></i> <span>Heures Supplementaires</span>
                </a>
            </li>
        </div>
        <div class="d_flex w-full">
         
            <li class="w-full text-left">
                <a href="{{ route('Messages.Listing') }}"
                    class="men w-full block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                    <i class="fa-solid fa-message men fonts mr-4"></i><span>Messages</span>
                </a>
            </li>
        </div>
       
        <div class="flex w-full ">
            
            <li class="w-full text-left relative pl-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="men w-full text-left"><i class="fa-solid fa-right-from-bracket men fonts mr-4"></i><span>Déconnexion</span></button>
                </form>

            </li>
        </div>

        <div class="notific">
            @if($congesEnAttente > 0)
                {{-- <span>Congés en attente : {{ $congesEnAttente }}</span> --}}
                <span id="congesNotification"
                    class="hidden  text-white text-xs font-bold rounded-full px-2"></span>
            @endif

        </div>
      
 
    </ul>
</div>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const menu = document.querySelector('.menu');
        menu.classList.toggle('active'); // Ajoute ou enlève la classe active
    });


//pour le menu
    const menuHamburger = document.querySelector(".menuHamburger")
    const links = document.querySelector(".navig")

    menuHamburger.addEventListener('click', () => {
        links.classList.toggle('mobile-menu')
    })


    
    })
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchCongesEnAttente() {
        $.ajax({
            url: "{{ route('admin.notifications') }}",
            type: "GET",
            dataType: "json",
            success: function (response) {
                let badge = $("#congesNotification");
                if (response.congesEnAttente > 0) {
                    badge.text(response.congesEnAttente).removeClass("hidden");
                } else {
                    badge.addClass("hidden");
                }
            }
        });
    }

    // Charger au début
    fetchCongesEnAttente();

    // Rafraîchir toutes les 5 secondes
    setInterval(fetchCongesEnAttente, 3000);




    
        // Pour les boutons de formulaire comme "Déconnexion"
        const logoutBtn = document.querySelector('form button[type="submit"]');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function () {
                overlay.style.display = 'flex';
            });
        }
    });
</script>