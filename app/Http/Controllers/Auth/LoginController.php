<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   protected function authenticated(Request $request, $user)
{
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/client/dashboard');
    }
}
}
