<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="CardDash">
                    <p>Welcome to the Admin Dashboard!  </p>
               
                </div>


                <div>
                    <!-- From Uiverse.io by abrahamcalsin -->
                    <div class="card-client">
                        <div class="user-picture">
                            <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z">
                                </path>
                            </svg>
                        </div>
                        <p class="name-client">{{$totalEmployes }}
                            <span>Employés enregistré
                            </span>
                        </p>
                        <div class="social-media">
                        </div>
                    </div>
                </div>
                <div id="calendar"></div>
            </div>

        
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'fr',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '/conges-valides', // Charger les congés validés depuis l’API
            });

            calendar.render();
        });
    </script>

</x-app-layout>
<style>
/* From Uiverse.io by adamgiebl */ 
.CardDash {

width: 63.3em;
height: 5em;
text-align: center;
    line-height: 5em;
  background: rgb(236, 236, 236);
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
}






    /* From Uiverse.io by abrahamcalsin */
    .card-client {
        margin: 2em;
        background: #2c3e50;
        width: 13rem;
        padding-top: 25px;
        padding-bottom: 25px;
        padding-left: 20px;
        padding-right: 20px;
        border: 4px solid #c5d5d3;
        box-shadow: 0 6px 10px rgba(207, 212, 222, 1);
        border-radius: 10px;
        text-align: center;
        color: #fff;
        font-family: "Poppins", sans-serif;
        transition: all 0.3s ease;
    }

    .card-client:hover {
        transform: translateY(-10px);
    }

    .user-picture {
        overflow: hidden;
        object-fit: cover;
        width: 5rem;
        height: 5rem;
        border: 4px solid #7cdacc;
        border-radius: 999px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
    }

    .user-picture svg {
        width: 2.5rem;
        fill: currentColor;
    }

    .name-client {
        margin: 0;
        margin-top: 20px;
        font-weight: 600;
        font-size: 18px;
    }

    .name-client span {
        display: block;
        font-weight: 200;
        font-size: 16px;
    }

    .social-media:before {
        content: " ";
        display: block;
        width: 100%;
        height: 2px;
        margin: 20px 0;
        background: #7cdacc;
    }

    .social-media a {
        position: relative;
        margin-right: 15px;
        text-decoration: none;
        color: inherit;
    }

    .social-media a:last-child {
        margin-right: 0;
    }

    .social-media a svg {
        width: 1.1rem;
        fill: currentColor;
    }

    /*-- Tooltip Social Media --*/
    .tooltip-social {
        background: #262626;
        display: block;
        position: absolute;
        bottom: 0;
        left: 50%;
        padding: 0.5rem 0.4rem;
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 600;
        opacity: 0;
        pointer-events: none;
        transform: translate(-50%, -90%);
        transition: all 0.2s ease;
        z-index: 1;
    }

    .tooltip-social:after {
        content: " ";
        position: absolute;
        bottom: 1px;
        left: 50%;
        border: solid;
        border-width: 10px 10px 0 10px;
        border-color: transparent;
        transform: translate(-50%, 100%);
    }

    .social-media a .tooltip-social:after {
        border-top-color: #262626;
    }

    .social-media a:hover .tooltip-social {
        opacity: 1;
        transform: translate(-50%, -130%);
    }
</style>