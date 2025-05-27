<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Client Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg conten" style="width: 104%">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="background: #9d999c1f;">
                    <div class="CardDash">
                        <p>TABLEAU DE BORD DU EMPLOYER </p>

                    </div>

                    <div class="flex cards">
                        @if($employers)
                                    <div class="card" style="width: 100%">
                                        <div class="card-body">
                                            <div class="flex">

                                                <div class="card-client">
                                                    <a href="{{ route('services.index') }}">
                                                        <div class="user-picture3">
                                                            <i class="fas fa-sack-dollar  fontss"></i>
                                                            <path
                                                                d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z">
                                                            </path>
                                                            </svg>
                                                        </div>
                                                        <div style="margin-top: 2em;">
                                                            <span>Salaire de base :
                                                            </span>
                                                            <p class="name-client"> {{ $employers['SalaireDeBase'] }} Ariary

                                                            </p>
                                                        </div>
                                                        <div class="social-media">
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="card-client">
                                                    <a href="{{ route('services.index') }}">
                                                        <div class="user-picture3" style="background: #0ea728;">
                                                            <i class="fa-solid fa-calendar  fontss"></i>
                                                            <path
                                                                d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z">
                                                            </path>
                                                            </svg>
                                                        </div>
                                                        <div style="margin-top: 2em;">
                                                            <span>Solde de congé :
                                                            </span>
                                                            <p class="name-client"> {{ $employers['SoldeConger'] }} jours

                                                            </p>
                                                        </div>
                                                        <div class="social-media">
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="card-client">
                                                    <a href="#">
                                                        <div class="user-picture3" style="background: #e88a15;">
                                                            <i class="fa-solid fa-clipboard  fontss"></i>
                                                            <path
                                                                d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z">
                                                            </path>
                                                            </svg>
                                                        </div>
                                                        <div style="width:9em;margin-top: 1.3em;">
                                                            <span>Présences ce mois ci :
                                                            </span>
                                                            <p class="name-client"> {{ $monthlyPresenceCount }} jours
                                                                {{-- <span id="jours-travailles">{{ $monthlyPresenceCount }}
                                                                    Jours</span> --}}

                                                            </p>
                                                        </div>
                                                        <div class="social-media">
                                                        </div>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>





                                    </div>
                                </div>
                                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Calendrier des congés
                                        validés</h2>
                                    <div id="calendar" class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg"></div>
                                </div>
                            </div>
                        @else
                            <p class="text-danger">Aucune information disponible.</p>
                        @endif
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .conten {
        height: 72em;
    }

    @font-face {
        font-family: 'TitreDAshboard';
        src: url('/fonts/MouldyCheeseRegularWyMWG.woff2') format('woff2'),
            url('/fonts/MouldyCheeseRegularWyMWG.woff') format('woff'),
            url('/fonts/MouldyCheeseRegularWyMWG.otf') format('opentype'),
            url('/fonts/MouldyCheeseRegularWyMWG.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'PoppinsExtraLight';
        src: url('/fonts/PoppinsExtraLight.otf') format('opentype'),
            url('/fonts/PoppinsExtraLight.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    .CardDash {
        background-color: #1a2035 !important;
        width: 100%;
        /* border-radius: 1em; */
        height: 5em;
        text-align: center;
        line-height: 5em;
        /* background: rgb(147 126 235); */
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
    }

    .CardDash p {
        font-family: 'TitreDAshboard';
        /* color: #0a0a0a; */
        font-size: 2em;
        color: white
    }

    .card-client a {
        display: flex;
        justify-content: space-between;
    }

    .card-client {
        width: 17em;
        height: 8em;
        margin: 2em;
        background: #ffffff;
        /* padding-top: 25px; */
        padding-bottom: 25px;
        padding-left: 20px;
        padding-right: 20px;
        /* border: 1px solid #c5d5d3; */
        box-shadow: 0 6px 10px rgba(207, 212, 222, 1);
        border-radius: 10px;
        text-align: center;
        color: #000000;
        font-family: "Poppins", sans-serif;
        transition: all 0.3s ease;
    }

    .card-client:hover {
        transform: translateY(-10px);
    }

    .user-picture3 {
        overflow: hidden;
        object-fit: cover;
        width: 5rem;
        height: 5rem;
        /* border: 4px solid #7cdacc; */
        border-radius: 999px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
        background: #1572e8;
        color: white;
        margin-top: 1.3em
    }

    .fontss {
        font-size: 34px;
        padding: 0;

    }

    .user-picture3 svg {
        width: 2.5rem;
        fill: currentColor;
    }

    .titreStatis {
        font-family: PoppinsExtraLight;
        text-align: center;
        margin-bottom: 1em;
        border-bottom: 4px chocolate solid;
        font-weight: bold;
        /* margin-top: 4em; */
    }

    .fc-daygrid-day-frame {
    max-height: 50px !important; /* Ajuste la hauteur selon ton besoin */
    padding: 2px !important; /* Réduit l'espacement interne */
}

.cards{
    /* margin-left: -11px */
}
.fc-daygrid-event {
    font-size: 12px !important; /* Réduit la taille du texte des événements */
    padding: 2px 4px !important; /* Ajuste l'espace autour du texte */
}
/* .fc-daygrid-day .fc-day .fc-day-mon .fc-day-past .fc-day-other{
    height: 4em !important;
} */

@media screen and (max-width: 760px){
    .CardDash p{
        font-size: 1.5em
    }
}
</style>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales/fr.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            initialView: 'dayGridMonth',
            events: {!! json_encode($events) !!},
        });
        calendar.render();
    });
</script>