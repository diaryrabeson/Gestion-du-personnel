<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
{
    if (!auth::check()) {
        return redirect()->route('login');
    }

    return view('client.dashboard'); // Remplacez par votre vue de tableau de bord
}
}
