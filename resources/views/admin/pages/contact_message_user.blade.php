@extends('admin.layout.app')

@section('title', 'User Message Seen')

<style>
    /* General Page Content Styling */
    .page-content {
        min-height: calc(100vh - 100px);
        padding-bottom: 50px;
        background-color: white;
    }

    footer {
        margin-top: auto;
    }

    /* Styling for Add Category Section */
    .add-category-form {
        width: 100%;
        margin-bottom: 20px;
        padding: 20px;
        background: #84bef9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .add-category-form input[type='text'],
    .add-category-form input[type='submit'] {
        width: 100%;
        margin: 10px 0;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .add-category-form input[type='submit'] {
        background: #007bff;
        color: white;
        cursor: pointer;
        transition: background 0.3s;
    }

    .add-category-form input[type='submit']:hover {
        background: #0056b3;
    }

    /* Search Bar Styling */
    .search-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .search-container input[type='search'] {
        width: 300px;
        padding: 10px 15px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .search-container input[type='submit'] {
        background: #28a745;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .search-container input[type='submit']:hover {
        background: #218838;
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th {
        background-color: #007bff;
        color: white;
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    td {
        background-color: #f1f1f1;
        color: #333;
        padding: 10px;
        border: 1px solid #ddd;
    }

    tr:hover td {
        background-color: #e0f7ff;
    }

    td a {
        text-decoration: none;
        color: white;
    }

    .btn-success {
        background: #28a745;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .btn-danger {
        background: #dc3545;
        padding: 5px 10px;
        border-radius: 4px;
    }
</style>

@section('content')
    <div class="container page-content" style="background-color: white;">
        <!-- Search Section -->
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('success-alert').style.display = 'none';
                }, 3000); // 3000ms = 3 seconds
            </script>
        @endif



        <!-- Category Table Section -->
        <table class="table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Mail</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($message as $msg)
                    <tr>
                        <td>{{ $msg->name }}</td>
                        <td>{{ $msg->email }}</td>
                        <td>{{ $msg->phone }}</td>
                        <td>{{ $msg->message }}</td>
                        <td>
                            <a class="edit btn btn-success" data-id="{{ $msg->id }}"
                                href="{{ route('customer.contact.edit', $msg->id) }}">Edit</a>


                            <a class="btn btn-danger" onclick="confirmation(event)"
                                href="{{ route('customer.contact.delete', $msg->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('script')








@endsection
