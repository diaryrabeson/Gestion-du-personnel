<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use Carbon\Carbon;
use DB;

class StatistiqueController extends Controller
{
    public function getPresenceAbsenceParMois()
    {
        // Récupérer les 6 derniers mois
        $moisLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $moisLabels[] = Carbon::now()->subMonths($i)->format('Y-m');
        }

        // Initialiser les tableaux de données
        $presencesData = [];
        $absencesData = [];

        foreach ($moisLabels as $mois) {
            // Nombre de présences pour le mois
            $presences = Presence::where('Etat', 'Présent')
                ->whereYear('DateSys', substr($mois, 0, 4))
                ->whereMonth('DateSys', substr($mois, 5, 2))
                ->count();

            // Nombre d'absences pour le mois
            $absences = Presence::where('Etat', 'Absent')
                ->whereYear('DateSys', substr($mois, 0, 4))
                ->whereMonth('DateSys', substr($mois, 5, 2))
                ->count();

            // Ajouter les valeurs aux tableaux
            $presencesData[] = $presences;
            $absencesData[] = $absences;
        }

        return response()->json([
            'labels' => $moisLabels,
            'presences' => $presencesData,
            'absences' => $absencesData,
        ]);
         return view('admin.dashboard', compact('mois', 'presences', 'absences'));
    }
}
