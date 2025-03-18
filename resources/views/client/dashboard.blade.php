
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Client Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg conten">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="CardDash">
                        <p>TABLEAU DE BORD DU CLIENT </p>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    .conten{
        height: 27em;
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
        background-color: #1a2035!important;
        width: 60em;
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
</style>