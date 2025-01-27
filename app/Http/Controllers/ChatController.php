<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    // Display chat interface
    public function index()
    {
        // Fetch only admins for the user to chat with
        $users = User::where('usertype', 'admin')->get();

        return view('home.pages.chat', compact('users'));
    }

    // Fetch messages between user and admin
    // ChatController.php
    public function fetchMessages($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $userId);
        })
            ->orWhere(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }


    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Save the message to the database
        $message = new Message();
        $message->sender_id = Auth::id();
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('chat_images', 'public');
            $message->image_path = $path;
        }

        $message->save();

        return response()->json([
            'message' => $message->message,
            'image_path' => $message->image_path ? asset('storage/' . $message->image_path) : null,
        ]);
    }
}
