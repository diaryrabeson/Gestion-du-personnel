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


public function valider(Request $request, $id)
{
    $conge = Conger::findOrFail($id);

   
    // Récupérer l'employé concerné
    $employe = Employer::findOrFail($conge->Id_Employe);

  
    // Diminuer le solde congé de l'employé
  
    $jours_ouvrables = $conge->jours_ouvrables;
    $solde_conge = $employe->SoldeConger;

    $somme = $solde_conge - $jours_ouvrables;
  
    $employe->update(['SoldeConger' => $somme]);
    // Valider le congé
    $conge->update(['status' => 'Approuvé']);

    return redirect()->route('Conger.pending')->with('success', 'Demande de congé approuvée avec succès.');
}



public function refuser($id)
{
    $conge = Conger::findOrFail($id);
    $conge->update(['status' => 'Rejeté']);

    return redirect()->route('Conger.pending')->with('success', 'Demande de congé refusée avec succès.');
}


 public function getCongesValides()
    {
        $conges = conger::where('status', 'Approuvé') // Filtrer les congés validés
            ->join('employers', 'conger.Id_Employe', '=', 'employers.Id_Employe')
            ->select('conger.Date_debut', 'conger.Date_Fin', 'employers.NomEmp', 'employers.Prenom')
            ->get();

        $events = [];

        foreach ($conges as $conge) {
            $events[] = [
                'title' => $conge->NomEmp . ' ' . $conge->Prenom,
                'start' => $conge->Date_debut,
                'end' => date('Y-m-d', strtotime($conge->Date_Fin . ' +1 day')), // Ajouter 1 jour pour inclure la fin
                'color' => '#28a745', // vert pour les congés validés
                'textColor' => '#ffffff'
            ];
        }

        return response()->json($events);
    }

 public function showNotis()
{
    $congesEnAttente = Conger::where('status', 'en attente')->count();

    if (request()->ajax()) {
        return response()->json(['congesEnAttente' => $congesEnAttente]);
    }

    return view('layouts.menuAdmin', compact('congesEnAttente'));
}



//calendrier dans le tableau de bord client
// public function showCalendar()
// {
//     // Récupérer l'utilisateur connecté
//     $user = Auth::user();

//     // Vérifier si l'utilisateur existe et récupérer l'employé correspondant
//     $employe = Employer::where('mail', $user->email)->first();

//     if (!$employe) {
//         return redirect()->back()->with('error', 'Employé non trouvé.');
//     }

//     // Récupérer les congés validés de l'employé
//     $conges = Conger::where('Id_Employe', $employe->id)
//                     ->where('status', 'validé')
//                     ->get(['Date_debut', 'Date_Fin']);

//     // Transformer les données pour FullCalendar
//     $events = $conges->map(function ($conge) {
//         return [
//             'title' => 'Congé',
//             'start' => $conge->Date_debut,
//             'end'   => $conge->Date_Fin,
//             'color' => '#28a745', // Vert pour indiquer un congé validé
//         ];
//     });

//     return view('client.dashboard', compact('events'));
// }
}
