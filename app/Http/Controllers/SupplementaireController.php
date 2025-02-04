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
        $employes = Employe::all();
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
        //
        $request->validate([
            'DateSys' => 'required|date',
            'CoutParHeure' => 'required|numeric',
            'DebutDeSuppl' => 'required',
            'FinDeSuppl' => 'required',
            'nb_total_heures' =>'required',
            'cout_total' => "required",
            'Id_Employe' => 'required|exists:employes,Id_Employe',
        ]);

        $supplementaire->update($request->all());

        return redirect()->route('supplementaires.index')->with('success', 'Heure supplémentaire mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
