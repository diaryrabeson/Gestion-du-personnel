<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" rel="stylesheet">
    <!-- FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/locales/fr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased flex flex-col min-h-screen">
    <div class="backf fixed w-full">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="backf bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 contenTitle">
                    {{ $header }}
                </div>
            </header>
        @endif
    </div>

    <div class="afficherMenu fixed  " style="z-index: 9999;">
        <i class="fa-solid fa-bars cursor-pointer font-bold">teste</i>
    </div>

    <div id="loadingOverlay"
         style="" class="laodingOver"
                >
        <img src="{{ asset('img/Loading5.gif') }}" alt="Chargement..." style="width: auto; height: 13em;">
    </div>

    <div class="flex-grow bg-gray-100 dark:bg-gray-900">
        <!-- Page Content -->
        
        <main class="contenn min-h-screen mx-auto">
            <div class="flex justify-between contenues" style="transition: all 0.5s ease;">
                <div class="navigations relative" style="margin-top: 2em;">
                    <!-- Inclure le menu selon le rôle de l'utilisateur -->
                    @if (Auth::user()->role === 'admin')
                        @include('layouts.menuAdmin')
                    @elseif (Auth::user()->role === 'client')
                        @include('layouts.menuClient')
                    @endif
                </div>
                <div class="contenuePage z-10">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>
<style>
    .afficherMenu {
        margin-left: 20%;
       
        margin-top: 1em;
    }

    @media screen and (max-width: 1580px) {
        .contenn {
            padding-top: 2em;
        }

        .backf {
            background-color: #ffff;
        }

        .fix {
            width: 100%;
        }
    }

    @media screen and (max-width: 768px) {
        .contenn {
            max-width: 100%;
            margin-left: 0em;
        }
    }

    .contenTitle {
        display: none;
    }




    .mobile-menus .navigations {
        /* margin-left: -100% !important; */
        position: relative !important;
        height: 35.5em;

    }

    .mobile-menus .navigations .navig {
        position: relative;
        left: -100%;
        height: 35.5em;
        transition: all 0.5s ease;
    }

    .mobile-menus .contenuePage {
        margin-left: -20%;
        position: relative;
        width: 100% !important;
        transition: all 0.9s ease;

    }

    .contenuePage {
       margin-top: 2%;
        width: 80%;
        transition: all 0.5s ease;
    }

    .mobile-menus .contenuePage .py-12 {
        transition: all 0.5s ease;
    }

    .contenues .contenuePage .py-12 .bg-white .p-6 {
        transition: all 0.5s ease;
    }
    .laodingOver{
        display: none; 
        position: fixed; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%;        
        background-color: rgba(0, 0, 0, 0.3); 
        z-index: 9999; 
        justify-content: center; align-items: center;
    }
</style>
</html>
<script>
    //pour le menu
    const menuHamburgers = document.querySelector(".afficherMenu");
    const linkss = document.querySelector(".contenues")

    menuHamburgers.addEventListener('click', () => {
        linkss.classList.toggle('mobile-menus')
    });

    //ceci est le code pour une lien de Chargement
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.navigations .menu a');
        const loading = document.getElementById('loadingOverlay');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                // Montre le loader juste après le clic (et avant la redirection)
                loading.style.display = 'flex';
                loading.style.zIndex = '999';
            });
        });
    });
</script>
