<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\Service;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Storage;



class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
{
    // Récupérer les employés avec pagination
    $employees = Employer::paginate(10); // 10 éléments par page

    // Retourner la vue avec les données paginées
    return view('employers.index', compact('employees'));
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
    $totalEmployes = Employer::count(); // Récupérer le nombre total des employés

    return view('admin.dashboard', compact('totalEmployes'));
}

public function showStatus()
{
    $user = Auth::User();
    return view ('layouts.navigation', compact('user'));
}



}
