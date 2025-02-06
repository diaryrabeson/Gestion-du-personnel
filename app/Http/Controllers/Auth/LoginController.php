<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   protected function authenticated(Request $request, $user)
{

    // Mettre à jour le statut de l'utilisateur en 'online'
    $user->status = 'online';
    $user->save();

    // Sauvegarder dans la session
    session(['user_status' => 'online']);

    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/client/dashboard');
    }
}

// app/Http/Controllers/Auth/LoginController.php
public function logout(Request $request)
{
    $user = Auth::user();
    if ($user) {
        $user->status = 'offline';
        $user->save();
    }

    Auth::logout();
    session()->forget('user_status');
    session()->save();

    return redirect('/login');
}

}
