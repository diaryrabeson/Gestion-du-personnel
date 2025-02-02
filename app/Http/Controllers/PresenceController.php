<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Employer;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    // Afficher la page de pointage
    public function index()
    {
        $employes = Employer::all(); // Liste des employés
        return view('presence.index', compact('employes'));
    }

    // Enregistrer une présence
    public function pointer(Request $request)
    {  
        // Valider les données de la requête
        $request->validate([
            'Id_Employe' => 'required|exists:employers,Id_Employe',
            'Etat' => 'required|in:Présent,Absent',
            'DateSys' => 'required|date',
            'motif' => 'nullable|string|max:255',
        ]);

        // Vérifier si une présence existe déjà pour l'employé à la date donnée
        $existingPointage = Presence::where('Id_Employe', $request->Id_Employe)
                                    ->whereDate('DateSys', $request->DateSys)
                                    ->first();

        if ($existingPointage) {
            // Rediriger avec un message d'erreur si le pointage existe déjà
            return redirect()->back()->withErrors([
                'error' => 'Cet employé a déjà pointé pour cette date.'
            ]);
        }

        // Créer une nouvelle présence si aucune entrée existante n'est trouvée
        presence::create($request->all());

        return redirect()->route('presence.list')->with('success', 'Pointage enregistré avec succès.');
    }

    // Consulter les présences
    public function list()
    {
        $presences = presence::with('employe')->orderBy('DateSys', 'desc')->get();
        return view('presence.list', compact('presences'));
    }
}
