<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileEmployerController extends Controller
{
    public function show()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est un employé (ajuste selon ta structure)
        $employe = \App\Models\Employer::where('mail', $user->email)->first();

        if (!$employe) {
            abort(404, "Employé non trouvé");
        }
        $Profile = [
        'nom' => $employe->NomEmp,
        'prenom' => $employe->Prenom,
        'Photo' => $employe->Photo,
        'email' => $employe->mail,
        'service' => $employe->Service,
        'SoldeConger' => $employe ->SoldeConger,
        'DateDeNaissance' => $employe ->DatedeNaissance,
        'Genre' => $employe ->Genre,
        'telephone' => $employe->Telephone,
        'adresse' => $employe->Adresse,
        'SalaireDeBase' => $employe->SalaireDeBase,
        'DateD_embauche	' => $employe->DateD_embauche	,
    ];
        return view('ProfileEmployer.profile', compact('Profile'));
    }
}
