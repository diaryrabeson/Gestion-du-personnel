<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\JoursFeries;
use App\Models\Conger;
use Carbon\Carbon;


class CongerController extends Controller
{
    public function index()
    {
    $conges = Conger::with('typeConge', 'employers')->paginate(10); // Utilisez le modèle Conger ici
    return view('conger.index', compact('conges'));
    }

   public function create()
{
    $typeConges = \DB::table('typeconger')->get(); // Récupération des types de congé

    $userEmail = Auth::user()->email; // Email de l'utilisateur connecté
    $employer = Employer::where('mail', $userEmail)->first(); // Vérifie l'e-mail dans la table employes

    // Vérifiez le contenu exact de $employer


    return view('Conger.create', compact('typeConges', 'employer'));
}

    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'id_typeConge' => 'required|exists:typeconger,id_typeConge',
            'Date_debut' => 'required|date|before_or_equal:Date_Fin',
            'Date_Fin' => 'required|date|after_or_equal:Date_debut',
            'id_employe' => 'required|exists:employers,Id_Employe',
            'status' => 'nullable|string', // Permet que status soit null
            'commentaire' => 'nullable|string', // Permet que commentaire soit null
        ]);

        // Récupération des jours fériés depuis la base de données
        $joursFeries = JoursFeries::pluck('date')->toArray();

        // Calcul des jours ouvrables
        $joursOuvrables = $this->calculerJoursOuvrables($request->Date_debut, $request->Date_Fin, $joursFeries);

        // Création d'un enregistrement dans la table `conger`
      Conger::create([
        'id_typeConge' => $request->id_typeConge,
        'Date_debut' => $request->Date_debut,
        'Date_Fin' => $request->Date_Fin,
        'Id_Employe' => $request->id_employe,
        'status' => $request->status ?? 'En attente', // Définit 'En attente' si status est null
        'jours_ouvrables' => $joursOuvrables,
        'commentaire' => $request->commentaire ?? null, // Définit null si commentaire n'est pas fourni
    ]);

        // Redirection après la création
        return redirect()->route('Conger.index')->with('success', 'Demande de congé créée avec succès.');
    }

    /**
     * Calcul des jours ouvrables entre deux dates, en excluant les week-ends et les jours fériés.
     *
     * @param string $dateDebut
     * @param string $dateFin
     * @param array $joursFeries
     * @return int
     */
    private function calculerJoursOuvrables($dateDebut, $dateFin, $joursFeries)
    {
        $debut = Carbon::parse($dateDebut);
        $fin = Carbon::parse($dateFin);
        $joursOuvrables = 0;

        // Boucle pour parcourir chaque jour entre les deux dates
        while ($debut <= $fin) {
            if (!$debut->isWeekend() && !in_array($debut->toDateString(), $joursFeries)) {
                $joursOuvrables++;
            }
            $debut->addDay();
        }

        return $joursOuvrables;
    }

//ceci est le code pour faire afficher tous les liste des congée en attente
    public function pending()
{
    $congesEnAttente = Conger::where('status', 'En attente')->with('typeConge', 'employers')->paginate(10);
    return view('Conger.pending', compact('congesEnAttente'));
}


public function valider($id)
{
    $conge = Conger::findOrFail($id);
    $conge->update(['status' => 'Approuvé']);

    return redirect()->route('Conger.pending')->with('success', 'Demande de congé approuvée avec succès.');
}

public function refuser($id)
{
    $conge = Conger::findOrFail($id);
    $conge->update(['status' => 'Rejeté']);

    return redirect()->route('Conger.pending')->with('success', 'Demande de congé refusée avec succès.');
}

}
