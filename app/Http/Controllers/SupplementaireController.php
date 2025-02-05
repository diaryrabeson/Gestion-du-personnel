<?php

namespace App\Http\Controllers;
use App\Models\Employer;
use App\Models\Supplementaire;
use Illuminate\Http\Request;

class SupplementaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $supplementaires = Supplementaire::with('Employer')->paginate(10);
        return view('supplementaires.index', compact('supplementaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $employes = employer::all();
        return view('supplementaires.create', compact('employes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
         $request->validate([
            'DateSys' => 'required|date',
            'CoutParHeure' => 'required|numeric',
            'DebutDeSuppl' => 'required',
            'FinDeSuppl' => 'required',
            'nb_total_heures' =>'required',
            'cout_total' => "required",
            'Id_Employe' => 'required|exists:employers,Id_Employe',
        ]);

        Supplementaire::create($request->all());

        return redirect()->route('supplementaires.index')->with('success', 'Heure supplémentaire ajoutée avec succès'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employes = Employer::all();
        $supplementaire = Supplementaire::findOrFail($id);
        return view('supplementaires.edit', compact('supplementaire', 'employes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Validation des données
    $request->validate([
        'DateSys' => 'required|date',
        'CoutParHeure' => 'required|numeric',
        'DebutDeSuppl' => 'required',
        'FinDeSuppl' => 'required',
        'nb_total_heures' => 'required|numeric',
        'cout_total' => 'required|numeric',
        'Id_Employe' => 'required|exists:employers,Id_Employe',
    ]);

    // Récupérer l'heure supplémentaire existante
    $supplementaire = Supplementaire::findOrFail($id);

    // Mise à jour des données
    $supplementaire->update([
        'DateSys' => $request->DateSys,
        'CoutParHeure' => $request->CoutParHeure,
        'DebutDeSuppl' => $request->DebutDeSuppl,
        'FinDeSuppl' => $request->FinDeSuppl,
        'nb_total_heures' => $request->nb_total_heures,
        'cout_total' => $request->cout_total,
        'Id_Employe' => $request->Id_Employe,
    ]);

    // Redirection avec message de succès
    return redirect()->route('supplementaires.index')->with('success', 'Heure supplémentaire mise à jour avec succès.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    // Récupérer l'employé par son ID
    $supplementaire = Supplementaire::findOrFail($id);

    // Supprimer l'employé
    $supplementaire->delete();

    // Redirection avec un message de succès
    return redirect()->route('supplementaires.index')->with('success', 'Employé supprimé avec succès.');
}
}
