<?php

namespace App\Http\Controllers;
use App\Models\Service;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'nomService' => 'required|string|max:255',
        'Description' => 'required|string|max:255',
    ]);

    // Vérification des doublons
    $existsNomService = Service::where('nomService', $request->nomService)->exists();
    $existsDescription = Service::where('Description', $request->Description)->exists();

    if ($existsNomService && $existsDescription) {
        return redirect()->back()->withErrors([
            'both' => 'Ce fonction est déjà enregistrés.'
        ]);
    }

    // Création du service
    Service::create($request->all());

    return redirect()->route('services.index')->with('success', 'Service créé avec succès.');
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($service)
{
    $service = Service::findOrFail($service); // Cela récupère le service avec l'ID
    return view('services.edit', compact('service'));
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
        'nomService' => 'required|string|max:255',
        'Description' => 'required|string|max:255',
    ]);

    // Vérification des doublons, en ignorant l'enregistrement actuel
    $existsNomService = Service::where('nomService', $request->nomService)
        ->where('id_service', '!=', $id) // Ignorer l'enregistrement en cours
        ->exists();

    $existsDescription = Service::where('Description', $request->Description)
        ->where('id_service', '!=', $id) // Ignorer l'enregistrement en cours
        ->exists();

    if ($existsNomService && $existsDescription) {
        return redirect()->back()->withErrors([
            'both' => 'Le service et la description sont déjà enregistrés.'
        ]);
    }

    // Mise à jour du service
    $service = Service::findOrFail($id);
    $service->update($request->all());

    return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
}
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
