@extends('admin.layout.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat</title>
        <!-- Include jQuery CDN -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>

    <div class="container mt-5">
        <div class="row">
            <!-- User List -->
            <div class="col-md-4 mb-4" style="alignt-items:center;justify-content:center;">
                <li class="list-group-item mb-2" style="background-color: #43d868;cursor:pointer;"> <a href="#" class="btn user-link mb-2" style="align-items: center;alignt-items:center;justify-content:center; margin-left: 140px;color:white!important; font-weight: 600;" >All Chats</a></li>
                <ul class="list-group">
                    @foreach ($users as $user)
                        <li class="list-group-item mb-2" style="background-color: #4262f2;cursor:pointer;">
                            <a href="#" class="btn user-link mb-2" style="align-items: center;alignt-items:center;justify-content:center; margin-left: 110px;color:white!important; font-weight: 600;" data-id="{{ $user->id }}">{{ $user->name }}</a>
                            
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Chat Box -->
            <div class="col-md-8">
                <div id="chat-box" class="border rounded p-3 mb-3" style="height: 400px; overflow-y: scroll;">
                    <!-- Messages will appear here -->
                    <span>Click chat to see message</span>
                </div>
                <form id="chat-form" enctype="multipart/form-data" method="POST" action="{{ route('chat.send') }}">
                    @csrf
                    <input type="hidden" name="receiver_id" id="receiver_id">
                    <div class="mb-3">
                        <textarea name="message" id="message" rows="3" class="form-control" placeholder="Type your message"></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        #chat-box {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .text-end .bg-primary {
            max-width: 70%;
        }

        .text-start .bg-secondary {
            max-width: 70%;
        }
    </style>
    <script>
        $(document).ready(function() {
            let chatBox = $('#chat-box');
    
            // Auto-select the first admin
            let firstAdmin = $('.user-link').first();
            if (firstAdmin.length) {
                let adminId = firstAdmin.data('id');
                $('#receiver_id').val(adminId);
                firstAdmin.trigger('click'); // Load messages for the first admin
            }
    
            // Load messages when an admin is clicked
            $('.user-link').on('click', function(e) {
                e.preventDefault();
    
                let userId = $(this).data('id');
                $('#receiver_id').val(userId); // Set receiver_id
    
                // Fetch messages from the server for the selected user
                $.get(`/chat/messages/${userId}`, function(messages) {
                    chatBox.html(''); // Clear the chat box
                    messages.forEach(function(msg) {
                        let content = msg.message ? `<p>${msg.message}</p>` : '';
                        if (msg.image_path) {
                            content += `<img src="/storage/${msg.image_path}" style="height:250px;width:300px; border-radius:12px;" class="img-fluid" alt="Image">`;
                        }
    
                        // Display message based on sender
                        if (msg.sender_id === {{ Auth::id() }}) {
                            // User's message (Right-aligned)
                            chatBox.append(
                                `<div class="text-end mb-3">
                                    <div class="bg-primary text-white p-2 rounded d-inline-block">${content}</div>
                                </div>`
                            );
                        } else {
                            // Admin's message (Left-aligned)
                            chatBox.append(
                                `<div class="text-start mb-3">
                                    <div class="bg-secondary text-white p-2 rounded d-inline-block">${content}</div>
                                </div>`
                            );
                        }
                    });
    
                    // Scroll to the bottom of the chat box
                    chatBox.scrollTop(chatBox.prop("scrollHeight"));
                });
            });
    
            // Send a message
            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
            
                let formData = new FormData(this);
            
                $.ajax({
                    url: "{{ route('chat.send') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Append the new message to the chat box
                        let content = response.message ? `<p>${response.message}</p>` : '';
                        if (response.image_path) {
                            content += `<img src="${response.image_path}" class="img-fluid" alt="Image">`;
                        }
                        $('#chat-box').append(
                            `<div class="text-end mb-3">
                                <div class="bg-primary text-white p-2 rounded d-inline-block">${content}</div>
                            </div>`
                        );
            
                        // Clear the input fields
                        $('#message').val('');
                        $('#image').val('');
                        chatBox.scrollTop(chatBox.prop("scrollHeight"));
                    },
                    error: function(xhr) {
                        console.error(xhr.responseJSON);
                        alert('Failed to send the message.');
                    }
                });
            });
        });
    </script>
    
@endsection
