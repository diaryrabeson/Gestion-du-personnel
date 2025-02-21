<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application Laravel avec Vue</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">  <!-- Inclure le CSS compilé -->
</head>
<body>

    <div class="container">
        @yield('content')  <!-- Cette ligne inclura le contenu de chaque page -->
    </div>

    <script src="{{ mix('js/app.js') }}"></script>  <!-- Inclure le JS compilé -->
</body>
</html>
