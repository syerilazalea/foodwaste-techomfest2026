<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class DashboardChatController extends Controller
{
    public function index(Request $request)
    {
        $targetUser = null;
        if ($request->has('start_chat')) {
            $targetUser = User::find($request->start_chat);
            if ($targetUser) {
                $targetUser = [
                    'id' => $targetUser->id,
                    'name' => $targetUser->name,
                    'thumb' => asset('img/profile/profile-1.webp'),
                    'last' => '',
                    'status' => 'Online',
                    'unread' => 0,
                    'messages' => []
                ];
            }
        }
        return view('dashboard.chat.index', compact('targetUser'));
    }

    public function getContacts()
    {
        $userId = Auth::id();
        
        // Get users who have chatted with current user (sent or received)
        // This is a simplified query. For production, use distinct and join.
        $messages = Message::where('user_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $contactIds = $messages->map(function ($msg) use ($userId) {
            return $msg->user_id == $userId ? $msg->receiver_id : $msg->user_id;
        })->unique()->filter()->values();

        $contacts = User::whereIn('id', $contactIds)->get()->map(function ($contact) use ($userId) {
            $lastMsg = Message::where(function ($q) use ($userId, $contact) {
                $q->where('user_id', $userId)->where('receiver_id', $contact->id);
            })->orWhere(function ($q) use ($userId, $contact) {
                $q->where('user_id', $contact->id)->where('receiver_id', $userId);
            })->orderBy('created_at', 'desc')->first();

            return [
                'id' => $contact->id,
                'name' => $contact->name,
                'thumb' => asset('img/profile/profile-1.webp'), // Placeholder or real image
                'last' => $lastMsg ? $lastMsg->created_at->diffForHumans() : '',
                'status' => 'Online', // You might want to implement real status later
                'unread' => 0, // Implement unread count logic if needed
                'messages' => [] // We will load this on demand or pre-fill if needed
            ];
        });

        return response()->json($contacts);
    }

    public function getMessages($id)
    {
        $userId = Auth::id();
        $messages = Message::where(function ($q) use ($userId, $id) {
            $q->where('user_id', $userId)->where('receiver_id', $id);
        })->orWhere(function ($q) use ($userId, $id) {
            $q->where('user_id', $id)->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc')->get();

        $formattedMessages = $messages->map(function ($msg) use ($userId) {
            return [
                'type' => $msg->user_id == $userId ? 'message' : 'response',
                'text' => $msg->message,
                'time' => $msg->created_at->format('H:i'),
                'attachments' => []
            ];
        });

        return response()->json($formattedMessages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent(Auth::user(), $message))->toOthers();

        return response()->json([
            'status' => 'Message Sent!',
            'message' => $message
        ]);
    }

    public function triggerPage()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('dashboard.chat.trigger', compact('users'));
    }
}
