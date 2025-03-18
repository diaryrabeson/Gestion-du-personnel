<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\FicheDePaye;
use App\Models\Employer;
use App\Models\Presence;
use App\Models\Supplementaire;


class FicheDePayeController extends Controller
{
     public function index(Request $request)
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Trouver l'employé correspondant au mail de l'utilisateur
    $employe = Employer::where('mail', $user->email)->first();
    if (!$employe) {
        return redirect()->back()->with('error', "Aucune fiche de paie trouvée.");
    }

    // Récupérer le mois et l'année sélectionnés (par défaut, on prend le mois et l'année actuels)
    $mois = $request->input('mois', date('m'));
    $annee = $request->input('annee', date('Y'));

    // 🔹 Récupérer le nombre total de présences pour ce mois et cette année
    $total_presence = Presence::where('Id_Employe', $employe->Id_Employe)
        ->where('Etat', 'Présent')
        ->whereMonth('DateSys', $mois)
        ->whereYear('DateSys', $annee)
        ->count();

    // 🔹 Récupérer le nombre total d'absences pour ce mois et cette année
    $total_absences = Presence::where('Id_Employe', $employe->Id_Employe)
        ->where('Etat', 'Absent')
        ->whereMonth('DateSys', $mois)
        ->whereYear('DateSys', $annee)
        ->count();

    // 🔹 Récupérer le total des heures supplémentaires pour ce mois et cette année
    $total_heures_supp = Supplementaire::where('Id_Employe', $employe->Id_Employe)
        ->whereMonth('DateSys', $mois)
        ->whereYear('DateSys', $annee)
        ->sum('nb_total_heures');

    // 🔹 Calcul du coût total des heures supplémentaires
    $cout_total_heures_supp = Supplementaire::where('Id_Employe', $employe->Id_Employe)
        ->whereMonth('DateSys', $mois)
        ->whereYear('DateSys', $annee)
        ->sum('CoutParHeure');

    // 🔹 Calcul du salaire total
    $salaire_base = $employe->SalaireDeBase;
    $prime = 0; // Prime par défaut
    $salaire_total = $salaire_base + $cout_total_heures_supp + $prime;

    // Préparer les données pour l'affichage
    $ficheDePaye = [
        'nom' => $employe->NomEmp,
        'prenom' => $employe->Prenom,
          'Photo' => $employe->Photo,
        'email' => $employe->mail,
        'service' => $employe->Service,
        'salaire_base' => $salaire_base,
        'telephone' => $employe->Telephone,
        'adresse' => $employe->Adresse,
        'total_presence' => $total_presence,
        'total_absences' => $total_absences,
        'total_heures_supp' => $total_heures_supp,
        'cout_total_heures_supp' => $cout_total_heures_supp,
        'prime' => $prime,
        'salaire_total' => $salaire_total,
    ];

    return view('ficheDePaye.index', compact('ficheDePaye', 'mois', 'annee'));
}


    public function show($id)
    {
        $fiche = FicheDePaye::with('Id_Employe')->findOrFail($id);
        return view('ficheDePaye.show', compact('fiche'));
    }
}
