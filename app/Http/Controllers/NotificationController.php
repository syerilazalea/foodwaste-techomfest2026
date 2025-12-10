<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public static function unreadMessages()
    {
        if (!Auth::check()) {
            return 0;
        }

        return Message::where('receiver_id', Auth::id())
            ->where('is_read', 0)
            ->count();
    }
}
