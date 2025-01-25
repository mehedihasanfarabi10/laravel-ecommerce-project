@extends('admin.layout.app')

@section('content')
    <div class="container mt-5">
        <h2>Chat with {{ $user->name }}</h2>
        <div id="chat-box" class="border rounded p-3 mb-3" style="height: 400px; overflow-y: scroll;">
            <!-- Messages will appear here -->
            @foreach ($messages as $message)
                <div class="{{ $message->sender_id == Auth::id() ? 'text-end' : 'text-start' }} mb-3">
                    <div class="{{ $message->sender_id == Auth::id() ? 'bg-primary' : 'bg-secondary' }} text-white p-2 rounded d-inline-block">
                        {{ $message->message }}
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('admin.chat.reply') }}" method="POST">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $user->id }}">
            <textarea name="message" rows="3" class="form-control" placeholder="Type your reply..."></textarea>
            <button type="submit" class="btn btn-primary mt-3">Send Reply</button>
        </form>
    </div>
@endsection
