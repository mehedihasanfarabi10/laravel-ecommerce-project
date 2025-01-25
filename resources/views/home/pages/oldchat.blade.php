@extends('home.layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    </head>

    <body>
        <div class="container mt-5">
            <div class="row">
                <!-- User List -->
                <div class="col-md-4">
                    <ul class="list-group">
                        @foreach ($users as $user)
                            <li class="list-group-item">
                                <a href="#" class="user-link" data-id="{{ $user->id }}">{{ $user->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Chat Box -->
                <div class="col-md-8">
                    <div id="chat-box" class="border rounded p-3 mb-3" style="height: 400px; overflow-y: scroll;">
                        <!-- Messages will be appended here -->
                    </div>
                    <form id="chat-form" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="receiver_id" id="receiver_id" >
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

        <script>
            $(document).ready(function() {
                let chatBox = $('#chat-box');
            
                // Load messages when a user is clicked
                $('.user-link').on('click', function(e) {
                    e.preventDefault();
                    
                    let userId = $(this).data('id');
                    console.log('User clicked:', userId); // Debugging log
            
                    // Update receiver_id in the hidden input field
                    $('#receiver_id').val(userId);
            
                    // Load messages for the selected user
                    $.get(`/chat/messages/${userId}`, function(messages) {
                        chatBox.html(''); // Clear the chat box
                        messages.forEach(function(msg) {
                            let content = msg.message ? `<p>${msg.message}</p>` : '';
                            if (msg.image_path) {
                                content += `<img src="/storage/${msg.image_path}" class="img-fluid" alt="Image">`;
                            }
                            chatBox.append(
                                `<div><strong>${msg.sender_id === {{ Auth::id() }} ? 'You' : 'Other'}:</strong> ${content}</div>`
                            );
                        });
                    }).fail(function() {
                        alert('Failed to load messages. Please try again.');
                    });
                });
            
                // Send a new message
                $('#chat-form').on('submit', function(e) {
                    e.preventDefault();
            
                    let receiverId = $('#receiver_id').val(); // Fetch receiver_id
                    console.log('Receiver ID:', receiverId); // Debugging log
            
                    if (!receiverId) {
                        alert('No receiver selected!');
                        return; // Exit if no receiver is selected
                    }
            
                    let formData = new FormData(this);
            
                    $.ajax({
                        url: "{{ route('chat.send') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            let content = response.message ? `<p>${response.message}</p>` : '';
                            if (response.image_path) {
                                content += `<img src="/storage/${response.image_path}" class="img-fluid" alt="Image">`;
                            }
                            chatBox.append(`<div><strong>You:</strong> ${content}</div>`);
                            $('#message').val(''); // Clear the message input
                            $('#image').val('');   // Clear the file input
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr.responseJSON);
                            alert('Message sending failed. Check console for details.');
                        }
                    });
                });
            });
            

            
        </script>
    </body>

    </html>
@endsection
