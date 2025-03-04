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

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" font-sans antialiased">
    <div class=" min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="backf fixed fix">

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
<style> 
@media screen and (max-width: 1580px) {
.contenn{
    max-width: 85%;
    margin-left: 13em;
    padding-top: 2em
}
.backf{
    background-color: #ffff;
}

.fix{
    width: 100%;
  
}
}


@media screen and (max-width: 768px) {
.contenn{
    max-width: 100%;
    margin-left: 0em;
}
}

.contenTitle{
    display: none;
}
</style>
        <!-- Page Content -->
        <main class=" contenn mx-auto px-4 sm:px-6 lg:px-8 max-w-full sm:max-w-4xl lg:ml-48 lg:w-4/5">
            {{ $slot }}
        </main>
    </div>
</body>
</html>