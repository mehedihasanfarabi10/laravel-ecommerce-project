@extends('admin.layout.app')

<style>
    /* Styling for the container holding Edit Subcategory and Search */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    /* Form container for Edit Subcategory */
    .edit-subcategory-form {
        width: 60%;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Styling for input fields */
    .edit-subcategory-form select,
    .edit-subcategory-form input[type='text'],
    .edit-subcategory-form input[type='submit'] {
        width: 100%;
        margin: 10px 0;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .edit-subcategory-form input[type='submit'] {
        background: #007bff;
        color: white;
        cursor: pointer;
        transition: background 0.3s;
    }

    .edit-subcategory-form input[type='submit']:hover {
        background: #0056b3;
    }

    /* Search container */
    .search-container {
        width: 35%;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .search-container input[type='search'] {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .search-container input[type='submit'] {
        background: #28a745;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .search-container input[type='submit']:hover {
        background: #218838;
    }
</style>
@section('content')
   

    <div class="container-fluid">
        <!-- Header Section -->
        <div class="header-section">
            <!-- Edit Contact Form -->
            <div class="edit-subcategory-form">
                <form action="{{ route('customer.contact.update', $contact->id) }}" method="post">
                    @csrf
                  
                    <div>
                        <label>Customer Name:</label>
                        <input type="text" name="name" value="{{ $contact->name }}" required>
                    </div>
                    
                    <div>
                        <label>Email:</label>
                        <input type="text" name="email" value="{{ $contact->email }}" placeholder="Email" />
                    </div>
                    <div>
                        <label>Phone:</label>
                        <input type="text" name="phone" value="{{ $contact->phone }}" placeholder="Phone" />
                    </div>
                    <div>
                        <label>Message:</label>
                        <input type="text" name="message" class="message-box" value="{{ $contact->message }}" placeholder="Message" />
                    </div>
                    <input type="submit" value="Update Contact">
                </form>
            </div>
    
            {{--  <!-- Search Form -->
            <div class="search-container">
                <form action="{{ url('category_search') }}" method="get">
                    @csrf
                    <input type="search" name="search" placeholder="Search categories">
                    <input type="submit" value="Search">
                </form>
            </div>  --}}
        </div>
    </div>
    
@endsection
