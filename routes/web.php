<?php
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplementaireController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TypeCongerController;  
use App\Http\Controllers\CongerController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FicheDePayeController;
use App\Http\Controllers\ProfileEmployerController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------- 
| Web Routes 
|--------------------------------------------------------------------------- 
| 
| Here is where you can register web routes for your application. These 
| routes are loaded by the RouteServiceProvider and all of them will be 
| assigned to the "web" middleware group. Make something great! 
| 
*/
Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
    // Autres routes...

    // Route pour la liste des employés

});


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Routes pour les utilisateurs non authentifiés
Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
    // Routes pour la connexion et l'inscription
    require __DIR__ . '/auth.php';

    Route::get('/login', function () {
        if (auth()->check()) {
            // Redirection vers le tableau de bord en fonction du rôle
            return redirect(auth()->user()->role === 'admin' ? '/admin/dashboard' : '/client/dashboard');
        }
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        if (auth()->check()) {
            return redirect(auth()->user()->role === 'admin' ? '/admin/dashboard' : '/client/dashboard');
        }
        return view('auth.register');
    })->name('register');
});

// Routes pour les utilisateurs authentifiés
Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
    // Routes pour les rôles spécifiques
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    Route::middleware('role:client')->group(function () {
        Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    });

    // Routes communes à tous les utilisateurs authentifiés
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les services
  
});

// Route de déconnexion - exclue de PreventBackHistory
Route::post('/logout', function () {
    auth()->logout(); // Déconnexion de l'utilisateur
    return redirect('/login'); // Redirection vers la page de connexion après déconnexion
})->name('logout');

// Routes publiques accessibles uniquement pour les invités
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
});


Route::resource('services', ServiceController::class);

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::get('/services/{id_service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::put('/services/{id_service}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/services/{id_service}', [ServiceController::class, 'destroy'])->name('services.destroy');



// La route 'resource' génère automatiquement les routes pour les méthodes CRUD (index, create, store, etc.)
Route::controller(EmployeeController::class)->group(function () {
    Route::get('/liste-des-employers', 'index')->name('employers.index');
    Route::get('/employers/create', 'create')->name('employers.create');
    Route::post('/employers', 'store')->name('employers.store');
    Route::get('/employers/{id_Employe}/edit', 'edit')->name('employers.edit');
    Route::put('/employers/{id_Employe}', 'update')->name('employers.update');
    Route::get('/employers/search', 'search')->name('employers.search');
    Route::delete('/employers/{id_Employe}', 'destroy')->name('employers.destroy');
});


//ceci est le route pour type conger

Route::controller(TypeCongerController::class)->group(function () {
    Route::get('/listes-de-type-conger', 'index')->name('TypeConger.index');
    Route::get('/TypeConger/create', 'create')->name('TypeConger.create');
    Route::post('/TypeConger', 'store')->name('TypeConger.store');
    Route::get('TypeConger/{id_typeConge}/edit', 'edit')->name('TypeConger.edit');
    Route::put('/TypeConger/{id_typeConge}', [TypeCongerController::class, 'update'])->name('TypeConger.update');

    Route::delete('TypeConger/{id_typeConge}', 'destroy')->name('TypeConger.destroy');
});



Route::controller(CongerController::class)->group(function () {
    Route::get('/Conger/create', 'create')->name('Conger.create');
    Route::get('/Conger', 'index')->name('Conger.index');
    Route::post('/Conger', 'store')->name('Conger.store');
    
    Route::get('/Conger/pending', [CongerController::class, 'pending'])->name('Conger.pending');
    Route::patch('/Conger/{id}/valider', [CongerController::class, 'valider'])->name('Conger.valider');
    Route::patch('/Conger/{id}/refuser', [CongerController::class, 'refuser'])->name('Conger.refuser');
    
});


Route::get('/presence', [PresenceController::class, 'index'])->name('presence.index');
Route::post('/presence', [PresenceController::class, 'pointer'])->name('presence.pointer');
Route::get('/presence/list', [PresenceController::class, 'list'])->name('presence.list');





Route::controller(SupplementaireController::class)->group(function () {
    Route::get('/supplementaires/create', 'create')->name('supplementaires.create');
    Route::get('/supplementaires', 'index')->name('supplementaires.index');
    Route::post('/supplementaires', 'store')->name('supplementaire.store');
    Route::get('supplementaires/{id_supplementaire}/edit', 'edit')->name('supplementaire.edit');
    Route::put('/supplementaires/{id_supplementaire}', [SupplementaireController::class, 'update'])->name('supplementaire.update');



    Route::delete('supplementaires/{id_supplementaire}', 'destroy')->name('supplementaire.destroy');
   
});


//cecie est pour l'affichage de conger valider dans un calendrier
Route::get('/conges-valides', [CongerController::class, 'getCongesValides']);



// Route::get('layouts/navigation', [EmployeeController::class, 'showDashboard'])->name('dashboard');
Route::get('admin/dashboard', [EmployeeController::class, 'showDashboard'])->name('admin.dashboard');

Route::post('/update-status', [AuthenticatedSessionController::class, 'updateStatus'])->name('update.status');


//ceci est pour l'affichage de fiche de paye
Route::middleware(['auth'])->group(function () {
    Route::get('/ficheDePaye', [FicheDePayeController::class, 'index'])->name('ficheDePaye.index');
    Route::get('/ficheDePaye/create', [FicheDePayeController::class, 'create'])->name('ficheDePaye.create');
    Route::post('/ficheDePaye/store', [FicheDePayeController::class, 'store'])->name('ficheDePaye.store');
    Route::get('/ficheDePaye/{id}', [FicheDePayeController::class, 'show'])->name('ficheDePaye.show');
   Route::get('/fiche-de-paye/pdf', [FicheDePayeController::class, 'genererPDF'])->name('fiche-pdf');

});


Route::middleware(['auth'])->get('/ProfileEmployer/profile', [ProfileEmployerController::class, 'show'])->name('ProfileEmployer.profile');

Route::get('/admin/dashboard', [SupplementaireController::class, 'countSupplementaires'])->name('admin.dashboard');
Route::get('/admin/dashboard', [EmployeeController::class, 'showDashboard'])->name('admin.dashboard');





Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [MessageController::class, 'index'])->name('Messages.index');
  Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('sendMessage');
  Route::get('/utilisateurs', [MessageController::class, 'showUsers'])->name('Messages.Listing');
  Route::get('/messages/{userId}', [MessageController::class, 'showMessages'])->name('Messages.index');
Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('sendMessage');
Route::get('/messages/get/{destinataire_id}', [MessageController::class, 'getMessages'])->name('getMessages');


});


Route::get('/client/dashboard', [EmployeeController::class, 'ShowSoldConge'])
    ->name('client.dashboard')
    ->middleware('auth'); 


Route::get('/admin/notifications', [CongerController::class, 'showNotis'])->name('admin.notifications');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

