<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   protected function authenticated(Request $request, $user)
{
    // Mettre à jour le statut dans la base de données
    $user->status = 'online';
    $user->save();

    // Mettre à jour la session
    session(['user_status' => 'online']);
    session()->save();

    // Rediriger vers le bon tableau de bord
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'client') {
        return redirect('/client/dashboard');
    }

    return redirect('/'); // Redirection par défaut
}
// app/Http/Controllers/Auth/LoginController.php
public function logout(Request $request): RedirectResponse
{
    $user = Auth::user(); // Vérifie si l'utilisateur est bien récupéré
    
    if ($user) {
        Log::info('🔍 Utilisateur trouvé avant déconnexion : ' . $user->id);
        
        $user->status = 'offline';
        $user->save();
        
        Log::info('✅ Statut mis à jour en OFFLINE dans la base pour l’utilisateur ID: ' . $user->id);
    } else {
        Log::error('❌ Aucun utilisateur récupéré avant la déconnexion.');
    }

    Auth::logout(); // Déconnecter l'utilisateur

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
}


}
