@extends('admin.layout.app')


@section('title', 'Brand Management')

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
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .form-container label {
        font-weight: bold;
        color: #000000;
    }

     label{
        color: #000000;
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

    table img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }

    .image-preview{
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }
</style>

@section('content')
    <div class="container-fluid">


        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="header-section">
            <!-- Add Brand Form -->
            <div class="add-subcategory-form">
                <form action="{{route('brand.update',$branddata->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div>
                        <label style="color: #000000!important;">Enter Brand Name:</label>
                        <input type="text" name="brand_name" required value="{{$branddata->name}}" placeholder="Enter brand name">
                    </div>
                    <!-- Product Description -->
                    <label style="color: #000000!important;">Product Description:</label>
                    <div>
                        
                        <input style="width:100%;margin-bottom:10px;" name="description" rows="4" value="{{$branddata->description}}" placeholder="Enter product description" required></input>
                    </div>
                    <div >
                        <label style="color: #000000!important;">Upload Brand Logo :</label>
                        <input style="border: 1px solid #000; width:100%;" type="file" name="brandimage" >
                    </div>

                    <!-- Show current image -->
                    <label class="mt-3" style="color: #000000!important;">Previous Brand Logo :</label>
                    @if ($branddata->logo)
                        <div class="image-preview">
                            <img src="/brands/{{ $branddata->logo }}" alt="Brand Image" height="100" width="100">
                        </div>
                    @endif


                    <input type="submit" value="Update Brand">
                </form>
            </div>

            <!-- Search Form -->
            <div class="search-container">
                <form action="{{ url('category_search') }}" method="get">
                    @csrf
                    <input type="search" name="search" placeholder="Search brand">
                    <input type="submit" value="Search">
                </form>
            </div>
        </div>
    </div>

   
    </div>
@endsection