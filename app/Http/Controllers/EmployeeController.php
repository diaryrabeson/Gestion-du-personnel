<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\Service;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Storage;
use App\Models\Supplementaire;
use Carbon\Carbon;
use App\Models\Presence;
use App\Models\Conger;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
{
    $query = $request->input('query');

    // Vérifier si l'utilisateur a entré quelque chose
    if ($query) {
        $employeers = Employer::where('NomEmp', 'LIKE', "%$query%")
                    ->orWhere('Prenom', 'LIKE', "%$query%")
                    ->get();
    } else {
        $employeers = Employer::all();
    }
 // Récupérer les employés avec pagination
    $employees = Employer::paginate(10); // 10 éléments par page
    //recuperer les service
    return view('employers.index', compact('employeers','employees'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         // Récupérer tous les services depuis la base de données
        $services = Service::all();
       

       return view('employers.create', ['services' => $services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //methode store
    
public function store(Request $request)
{

    // Validation des données
    $validatedData = $request->validate([
        'NomEmp' => 'required|string|max:255',
        'Prenom' => 'required|string|max:255',
        'Adresse' => 'nullable|string|max:255',
        'mail' => 'required|email|unique:employers,mail',
        'Telephone' => 'nullable|string|max:20',
        'Photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'DatedeNaissance' => 'required|date|before:2005-01-01',
        'DateD_embauche' => 'nullable|date',
        'Id_service' => 'required|exists:tb_service,id_service',
        'SoldeConger' => 'nullable|numeric|min:0',
        'Genre' => 'required|in:Masculin,Féminin',
        'SalaireDeBase' => 'required|numeric|min:0',
    ], [
        'DatedeNaissance.before' => 'L\'employé doit être né avant l\'année 2000.',
    ]);
   
    // Vérifier si l'email existe déjà
    $existingEmail = Employer::where('mail', $validatedData['mail'])->first();
    if ($existingEmail) {
        return redirect()->back()->with('error', 'Cet e-mail est déjà utilisé.');
    }

    // Vérifier et enregistrer l'image
    if ($request->hasFile('Photo')) {
    $file = $request->file('Photo');
    $filename = time() . '.' . $file->getClientOriginalExtension(); // Nom unique
    $file->storeAs('public/photos', $filename); // Stocker dans `storage/app/public/photos`
    $validatedData['Photo'] = 'photos/' . $filename; // Sauvegarder le bon chemin en base
}


    // Ajouter la date d'embauche si elle n'est pas fournie
    if (!$request->filled('DateD_embauche')) {
        $validatedData['DateD_embauche'] = now()->toDateString();
    }

    // Création de l'employé
    Employer::create($validatedData);

    // Redirection avec un message de succès
    return redirect()->route('employers.index')->with('success', 'Employé ajouté avec succès.');
}



 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Affiche un employé spécifique
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function edit($id_Employe)
{
    $employee = Employer::find($id_Employe);

    if (!$employee) {
        return redirect()->route('employers.index')->withErrors('Employé non trouvé.');
    }

    $services = Service::all(); // Si vous utilisez un dropdown pour les services
    return view('employers.edit', compact('employee', 'services'));
}



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_Employe)
{
 
    // Récupérer l'employé par son ID
    $employee = Employer::findOrFail($id_Employe);
 
    // Validation des données
    $validatedData = $request->validate([
        'NomEmp' => 'required|string|max:255',
        'Prenom' => 'required|string|max:255',
        'Adresse' => 'nullable|string|max:255',
        'mail' => 'required|email|unique:employers,mail,' . $employee->Id_Employe . ',Id_Employe',
        'Telephone' => 'nullable|string|max:20',
        'Photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'DatedeNaissance' => 'nullable|date',
        'DateD_embauche' => 'nullable|date',
        'Id_service' => 'required|exists:tb_service,id_service',
        'Service' => 'nullable|string',
        'SoldeConger' => 'nullable|numeric|min:0',
        'Genre' => 'required|in:Masculin,Féminin',
        'SalaireDeBase' => 'required|numeric|min:0',
    ]);

    // Vérifier si un fichier photo a été envoyé
    if ($request->hasFile('Photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($employee->Photo) {
            Storage::disk('public')->delete($employee->Photo);
        }
        // Sauvegarder la nouvelle photo
        $validatedData['Photo'] = $request->file('Photo')->store('photos', 'public');
    }

    // Mettre à jour les données de l'employé
    $employee->update($validatedData);

    // Redirection avec un message de succès
    return redirect()->route('employers.index')->with('success', 'Employé mis à jour avec succès.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id_Employe)
{
    // Récupérer l'employé par son ID
    $employee = Employer::findOrFail($id_Employe);

    // Supprimer l'employé
    $employee->delete();

    // Redirection avec un message de succès
    return redirect()->route('employers.index')->with('success', 'Employé supprimé avec succès.');
}


public function showDashboard()
{
    // Récupération des statistiques globales
    $totalSerices   = Service::count();
    $totalEmployes = Employer::count();
    $totalSupplem = Supplementaire::count();

    // Récupération du nombre d'employés par service
    $data = Employer::selectRaw('id_service, COUNT(*) as total')
                    ->groupBy('id_service')
                    ->get();

    // Préparer les données pour le graphique de répartition par service
    $labels = [];
    $totals = [];

    foreach ($data as $item) {
        $service = Service::find($item->id_service);
        if ($service) {
            $labels[] = $service->nomService;
            $totals[] = $item->total;
        }
    }

    // Récupérer les 6 derniers mois pour le graphique de présence/absence
    $moisLabels = [];
    for ($i = 5; $i >= 0; $i--) {
        $moisLabels[] = Carbon::now()->subMonths($i)->format('Y-m');
    }

    // Initialisation des tableaux de données
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

    // Passer toutes les données à la vue
    return view('admin.dashboard', compact(
        'totalEmployes', 'totalSupplem', 'totalSerices', 
        'labels', 'totals', 'moisLabels', 'presencesData', 'absencesData'
    ));
}

public function showStatus()
{
    $user = Auth::User();
    return view ('layouts.navigation', compact('user'));
}

//ceci est pour l'affichage des service dans un cercle
public function repartitionParService()
    {
        // Récupérer le nombre d'employés par service
        $data = Employer::selectRaw('id_service, COUNT(*) as total')
                        ->groupBy('id_service')
                        ->get();

        // Transformer les données pour le graphique
        $labels = [];
        $totals = [];

        foreach ($data as $item) {
            $service = Service::find($item->id_service);
            if ($service) {
                $labels[] = $service->nomService;
                $totals[] = $item->total;
            }
        }

        return view('admin.dashboard', compact('labels', 'totals'));
    }



public function search(Request $request)
{
   $query = $request->input('query');

    // Vérifier si l'utilisateur a entré quelque chose
    if ($query) {
        $employeers = Employer::where('NomEmp', 'LIKE', "%$query%")
                    ->orWhere('Prenom', 'LIKE', "%$query%")
                    ->get();
    } else {
        $employeers = Employer::all();
    }
    
 $employees = Employer::paginate(10); // 10 éléments par page
 return view('employers.index', compact('employeers','employees'));
    
}
 
public function ShowSoldConge()
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Vérifier si l'utilisateur est un employé
    $employe = \App\Models\Employer::where('mail', $user->email)->first();

    if (!$employe) {
        abort(404, "Employé non trouvé");
    }

    $currentMonth = date('m');
    $currentYear = date('Y');

    // Récupérer le nombre total de jours travaillés ce mois
    $monthlyPresenceCount = Presence::whereYear('DateSys', $currentYear)
                                    ->whereMonth('DateSys', $currentMonth)
                                    ->where('Id_Employe', $employe->Id_Employe) // Filtrer par l'employé connecté
                                    ->count();

    // Récupérer les informations de l'employé
    $employers = [
        'nom' => $employe->NomEmp,
        'prenom' => $employe->Prenom,
        'Photo' => $employe->Photo,
        'email' => $employe->mail,
        'service' => $employe->Service,
        'SoldeConger' => $employe->SoldeConger,
        'DateDeNaissance' => $employe->DatedeNaissance,
        'Genre' => $employe->Genre,
        'telephone' => $employe->Telephone,
        'adresse' => $employe->Adresse,
        'SalaireDeBase' => $employe->SalaireDeBase,
        'DateD_embauche' => $employe->DateD_embauche,
    ];

    // Récupérer uniquement les congés validés de l'employé connecté
    $conges = conger::where('status', 'Approuvé') // Filtrer les congés validés
                    ->where('Id_Employe', $employe->Id_Employe) // Filtrer par employé connecté
                    ->select('Date_debut', 'Date_Fin')
                    ->get();

    // Transformer les données pour FullCalendar
    $events = [];
    foreach ($conges as $conge) {
        $events[] = [
            'title' => "Congé",
            'start' => $conge->Date_debut,
            'end' => date('Y-m-d', strtotime($conge->Date_Fin . ' +1 day')), // Inclure la date de fin
            'color' => '#28a745', // Vert pour les congés validés
            'textColor' => '#ffffff'
        ];
    }

    return view('client.dashboard', compact('employers', 'monthlyPresenceCount', 'events'));
}
 
}
