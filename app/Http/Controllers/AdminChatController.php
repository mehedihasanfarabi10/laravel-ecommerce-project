<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminChatController extends Controller
{
    // Display all users' chats (admin page)
    public function index()
    {
        $users = User::where('usertype', 'user')->get(); // Get all users for admin to select
        return view('admin.chat.index', compact('users'));
    }

    // Show messages for a specific user
    public function showUserMessages($userId)
    {
        $user = User::findOrFail($userId);
        $messages = Message::where(function($query) use ($userId) {
            $query->where('sender_id', $userId)->where('receiver_id', Auth::id());
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $userId);
        })->get();

        return view('admin.chat.messages', compact('user', 'messages'));
    }

    // Send a reply to the user
    public function sendReply(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        // Save the reply in the database
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $validated['receiver_id'],
            'message' => $validated['message'],
            'image_path' => null,
        ]);

        return back()->with('success', 'Reply sent successfully');
    }
}
