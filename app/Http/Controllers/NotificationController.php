<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
        public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
                                     ->orderBy('created_at', 'desc')
                                     ->get();

        // Marquer toutes les notifications comme lues
        Notification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->update(['is_read' => true]);

        return view('notifications.index', compact('notifications'));
    }

}
