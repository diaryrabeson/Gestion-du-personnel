<?php
namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;

class MessageController extends Controller
{
   public function sendMessage(Request $request)
{
    $request->validate([
        'destinataire_id' => 'required|exists:users,id',
        'contenu' => 'required|string|max:255',
    ]);

    // Créer le message
    $message = Message::create([
        'expediteur_id' => $request->user()->id,
        'destinataire_id' => $request->destinataire_id,
        'contenu' => $request->contenu,
    ]);

    // Diffuser l'événement (si WebSockets est utilisé)
    broadcast(new MessageSent($message, $request->user()))->toOthers();

    // Retourner une réponse JSON pour l'AJAX
    return response()->json([
        'message' => [
            'expediteur' => $request->user()->name,
            'contenu' => $message->contenu,
            'created_at' => $message->created_at->format('H:i'),
        ]
    ]);
}



    public function index()
    {
        $messages = Message::with(['expediteur', 'destinataire'])->get();
        $users = User::where('id', '!=', auth()->id())->get(); // Récupère tous les utilisateurs sauf l'utilisateur connecté

        return view('Messages.index', compact('messages', 'users'));
    }

    public function showUsers()
{
    $userList = User::where('id', '!=', auth()->id())->get();
    return view('Messages.Listing', compact('userList'));
}

public function showMessages($userId)
{
    $user = User::findOrFail($userId);
    $messages = Message::where(function ($query) use ($userId) {
            $query->where('expediteur_id', auth()->id())->where('destinataire_id', $userId);
        })
        ->orWhere(function ($query) use ($userId) {
            $query->where('expediteur_id', $userId)->where('destinataire_id', auth()->id());
        })
        ->orderBy('created_at', 'asc')
        ->get();

    $users = User::where('id', '!=', auth()->id())->get();

    return view('Messages.index', compact('messages', 'user', 'users'));
}

public function getMessages($destinataire_id)
{
    $messages = Message::where(function ($query) use ($destinataire_id) {
            $query->where('expediteur_id', auth()->id())
                  ->where('destinataire_id', $destinataire_id);
        })
        ->orWhere(function ($query) use ($destinataire_id) {
            $query->where('expediteur_id', $destinataire_id)
                  ->where('destinataire_id', auth()->id());
        })
        ->orderBy('created_at', 'asc')
        ->get();

    return response()->json($messages);
}

}
