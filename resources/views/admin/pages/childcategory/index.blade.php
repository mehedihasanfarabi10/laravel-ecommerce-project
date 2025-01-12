@extends('admin.layout.app')

@section('title', 'Childcategory Management')

<style>
    /* General Page Styling */
    .page-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .page-header h3 {
        color: crimson;
        font-weight: bold;
    }

     /* Styling for the container holding Add Subcategory and Search */
     .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    /* Form container for Add Subcategory */
    .add-subcategory-form {
        width: 60%;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Styling for input fields */
    .add-subcategory-form select,
    .add-subcategory-form input[type='text'],
    .add-subcategory-form input[type='submit'] {
        width: 100%;
        margin: 10px 0;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .add-subcategory-form input[type='submit'] {
        background: #007bff;
        color: white;
        cursor: pointer;
        transition: background 0.3s;
    }

    .add-subcategory-form input[type='submit']:hover {
        background: #0056b3;
    }

    /* Search container */
    .search-container {
        width: 35%;
        display: flex;
        flex-direction: row;
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

    .form-container {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 50px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .form-container label {
        font-weight: bold;
        color: #0c0c0c;
    }

    .form-container select,
    .form-container input[type='text'],
    .form-container input[type='search'] {
        width: 100%;
        height: 40px;
        padding: 8px 12px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-container .btn {
        width: 100%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th {
        background-color: #007bff;
        color: white;
        padding: 10px;
        text-align: center;
    }

    table td {
        background-color: #f8f9fa;
        color: #555;
        padding: 10px;
        text-align: center;
    }

    table tbody tr:hover {
        background-color: #e9ecef;
    }

    .action-buttons .btn {
        margin: 0 5px;
    }

    .action-buttons .btn-danger {
        color: white;
        background-color: #dc3545;
        border: none;
    }

    .action-buttons .btn-light {
        color: #007bff;
        background-color: #e9ecef;
        border: none;
    }

    .action-buttons .btn-light:hover {
        color: #0056b3;
    }
</style>

@section('content')
    <div class="d-flex flex-column">
        <!-- Main Content Area -->

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="container-fluid">
            <div class="header-section">
                <div class="add-subcategory-form">
                    <form action="{{ route('childcategory.store') }}" method="post">
                        @csrf
                        <div>
                            <label>Select Category:</label>
                            <select name="category_id" id="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Select Subcategory:</label>
                            <select name="subcategory_id" id="subcategory_id" required>
                                <option value="">Select Subcategory</option>
                                @foreach ($subcategory as $sub)
                                    <option value="{{ $sub->id }}">{{ $sub->subcategory_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label>Enter Child Category Name:</label>
                            <input type="text" name="childcategory_name" required
                                placeholder="Enter child category name">
                        </div>

                        <input type="submit" value="Add Child Category">
                    </form>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Child Category</th>
                        <th>Child Category Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        @foreach ($category->subcategories as $subcategory)
                            @foreach ($subcategory->childCategories as $childCategory)
                                <tr>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $subcategory->subcategory_name }}</td>
                                    <td>{{ $childCategory->childcategory_name }}</td>
                                    <td>{{ $childCategory->childcategory_slug }}</td>
                                    <td class="action-buttons">
                                        <a class="btn btn-light" href="{{ route('childcategory.edit', $childCategory->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger" onclick="confirmation(event)" href="{{ route('childcategory.delete', $childCategory->id) }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>
@endsection


@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="text/javascript">
        $(document).ready(function() {
            console.log('jQuery version:', $.fn.jquery);
            console.log('DataTables loaded:', !!$.fn.DataTable);

            try {
                var table = $('.datatable-making').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('childcategory.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'childcategory_name',
                            name: 'childcategory_name'
                        },
                        {
                            data: 'category_name',
                            name: 'category_name'
                        },
                        {
                            data: 'subcategory_name',
                            name: 'subcategory_name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            } catch (e) {
                console.error('Error initializing DataTables:', e);
            }
        });
    </script>

    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;

            fetch(`/get-subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    const subcategoryDropdown = document.getElementById('subcategory_id');
                    subcategoryDropdown.innerHTML = '<option value="">Select Subcategory</option>';

                    data.subcategories.forEach(subcategory => {
                        subcategoryDropdown.innerHTML += `
                            <option value="${subcategory.id}">${subcategory.subcategory_name}</option>
                        `;
                    });
                });
        });
    </script>





@endsection
