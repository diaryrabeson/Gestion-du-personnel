<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\employer;


class AuthController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        if (Auth::check()) {
            // Redirige en fonction du rôle de l'utilisateur
            return redirect()->route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'client.dashboard');
        }

        return view('auth.login'); // Si l'utilisateur n'est pas connecté, affiche le formulaire de connexion
    }

   
}

