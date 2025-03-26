<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de Paie</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .container { width: 100%; margin: auto; }
        .header, .footer { text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table, .table th, .table td { border: 1px solid black; }
        .table th, .table td { padding: 8px; text-align: left; }
        .title { text-align: center; font-size: 18px; font-weight: bold; }
  
     

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FICHE DE PAIE</h1>
            <p>Période : {{ \Carbon\Carbon::create($ficheDePaye['annee'], $ficheDePaye['mois'], 1)->locale('fr')->translatedFormat('F Y') }}</p>
        </div>

        <table style="width: 100%; ">
            <tr>
                <!-- Bloc Informations du personnel -->
                <td style="width: 50%; padding: 15px;   background-color: #f9f9f9; vertical-align: top;">
                    <p><strong>Nom :</strong> {{ $ficheDePaye['nom'] }} {{ $ficheDePaye['prenom'] }}</p>
                    <p><strong>Email :</strong> {{ $ficheDePaye['email'] }}</p>
                    <p><strong>Service :</strong> {{ $ficheDePaye['service'] }}</p>
                    <p><strong>Téléphone :</strong> {{ $ficheDePaye['telephone'] }}</p>
                    <p><strong>Adresse :</strong> {{ $ficheDePaye['adresse'] }}</p>
                </td>
        
                <!-- Bloc Informations de l'entreprise -->
                <td style="width: 50%; padding: 15px;  background-color: #f9f9f9; text-align: center; vertical-align: top;">
                 
                    <p>R@ndevteam.com</p>
                    <p>NIF3002364629</p>
                    <p>STAT : 6121 11 2016 0 036665</p>
                    <p>Email : manager@rendevteam.com</p>
                    <p>Téléphone : +261 34 94 034 55</p>
                </td>
            </tr>
        </table>
        
        
        <h2>Détails de la Paie</h2>
        <table class="table">
            <tr>
                <th>Description</th>
                <th>Valeur</th>
            </tr>
            <tr>
                <td>Salaire de Base</td>
                <td>{{ number_format($ficheDePaye['salaire_base'], 2) }} Ariary</td>
            </tr>
            <tr>
                <td>Présences</td>
                <td>{{ $ficheDePaye['total_presence'] }} jours</td>
            </tr>
            <tr>
                <td>Absences</td>
                <td>{{ $ficheDePaye['total_absences'] }} jours</td>
            </tr>
            <tr>
                <td>Heures Supplémentaires</td>
                <td>{{ $ficheDePaye['total_heures_supp'] }} heures</td>
            </tr>
            <tr>
                <td>Coût Total Heures Supplémentaires</td>
                <td>{{ number_format($ficheDePaye['cout_total_heures_supp'], 2) }} Ariary</td>
            </tr>
            <tr>
                <td>Prime</td>
                <td>{{ number_format($ficheDePaye['prime'], 2) }} Ariary</td>
            </tr>
            <tr>
                <th>Salaire Total</th>
                <th>{{ number_format($ficheDePaye['salaire_total'], 2) }} Ariary</th>
            </tr>
        </table>

        <div class="footer">
            <p>Fiche générée automatiquement.</p>
        </div>
    </div>
</body>
</html>
