<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        // Si l'utilisateur est déjà connecté, redirige vers le tableau de bord approprié
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'client') {
                return redirect()->route('client.dashboard');
            }
        }
        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(Request $request)
{
    // Si l'utilisateur est déjà connecté, redirige directement vers le tableau de bord
    if (Auth::check()) {
        $user = Auth::user();
        return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'client.dashboard');
    }

    // Validation des informations de connexion
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirection basée sur le rôle de l'utilisateur
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        } elseif ($user->role === 'client') {
            return redirect()->intended('/client/dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect the user based on their role after login.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'client') {
            return redirect('/client/dashboard');
        }

        return redirect('/'); // Fallback if no role matches
    }
}
