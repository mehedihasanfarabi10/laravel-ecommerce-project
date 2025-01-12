@extends('admin.layout.app')

@section('title', 'Category Management')

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
        <div class="search-container">
            <form action="{{ url('category_search') }}" method="get">
                @csrf
                <input type="search" name="search" placeholder="Search category...">
                <input type="submit" class="btn btn-primary" value="Search">
            </form>
        </div>

        <!-- Add or Edit Category Section -->
        <div class="add-category-form">
            <form action="{{ url('add_category') }}" method="post" id="category-form">
                @csrf
                <h3 style="color: crimson;">Add or Edit Category</h3>
                <input type="text" name="category" id="category" class="category_name" required
                    placeholder="Enter category name">
                <input type="hidden" name="id" id="id" class="category_id">
                <input type="submit" class="btn btn-primary" value="Submit Category">
            </form>
        </div>

        <!-- Category Table Section -->
        <table class="table">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->category_slug }}</td>
                        <td>
                            <a class="edit btn btn-success" data-id="{{ $category->id }}"
                                href="{{ route('edit_category', $category->id) }}">Edit</a>

                        </td>
                        <td>
                            <a class="btn btn-danger" onclick="confirmation(event)"
                                href="{{ url('delete_category', $category->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('script')

    <script>
        $('body').on('click', '.edit', function() {
            let cat_id = $(this).data('id');

            $.ajax({
                url: '/edit_category/' + cat_id, // Fixed URL
                type: 'GET',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        // Populate the form with the fetched data
                        $('#category-form').attr('action', '/update_category/' + data.id);
                        $('#category').val(data.category_name);
                        $('#id').val(data.id);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                    alert('There was an error fetching category data.');
                }
            });
        });
    </script>






@endsection
