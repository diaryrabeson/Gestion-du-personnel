<?php

namespace App\Http\Controllers;
use App\Models\TypeConger;

use Illuminate\Http\Request;

class TypeCongerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $typeCongers = TypeConger::paginate(10);
        return view('typeConger.index', compact('typeCongers'));
    }

    public function create()
    {
        return view('typeConger.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'typeConge' => 'required|string|max:255|unique:typeconger,typeConge', // Vérifie l'unicité
    ], [
        'typeConge.unique' => 'Ce type de congé est déjà enregistré.', // Message d'erreur personnalisé
    ]);

    TypeConger::create($request->all());
    return redirect()->route('TypeConger.index')->with('success', 'Type de congé créé avec succès.');
}


    public function show($id)
    {
        $typeConger = TypeConger::findOrFail($id);
        return view('TypeConger.show', compact('typeConger'));
    }

    public function edit($id)
    {
        $typeConger = TypeConger::findOrFail($id);
        return view('typeConger.edit', compact('typeConger'));
    }

    public function update(Request $request, $id_typeConge)
{
    // Validation des données
    $validatedData = $request->validate([
        'typeConge' => 'required|string|max:255|unique:typeconger,typeConge,' . $id_typeConge . ',id_typeConge', // Vérifie l'unicité en ignorant l'enregistrement en cours
    ], [
        'typeConge.unique' => 'Ce type de congé est déjà enregistré.', // Message d'erreur personnalisé
    ]);

    // Rechercher le type de congé avec la clé primaire personnalisée
    $typeConger = TypeConger::where('id_typeConge', $id_typeConge)->firstOrFail();

    // Mettre à jour l'enregistrement
    $typeConger->update($validatedData);

    // Redirection avec un message de succès
    return redirect()->route('TypeConger.index')->with('success', 'Type de congé mis à jour avec succès.');
}


    public function destroy($id)
    {
        $typeConger = TypeConger::findOrFail($id);
        $typeConger->delete();
        return redirect()->route('TypeConger.index')->with('danger', 'Type de congé supprimé avec succès.');
    }
}
