@extends('admin.layout.app')

@section('title', 'Edit Category')

<style>
    /* Input field styling */
    input[type='text'] {
        width: 100%;
        height: 50px;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    /* Form Container Styling */
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
        margin-top: 10px;
    }

    .form-container input[type='submit'] {
        width: 100%;
        padding: 10px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .form-container input[type='submit']:hover {
        background: #0056b3;
    }

    .page-content {
        min-height: calc(100vh - 100px);
        padding-bottom: 50px;
    }

    footer {
        margin-top: 20px;
        position: relative;
    }

    /* Header Section */
    .page-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .div_design {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
</style>

@section('content')
    <div class="page-header">
        <h3 style="color:crimson;" class="div_design">Update Category</h3>
    </div>
    
    <div class="container-fluid">
        <div class="form-container">
            <form action="{{ url('update_category', $olddata->id) }}" method="post">
                @csrf
                <input type="text" name="category_new_name" value="{{ $olddata->category_name }}" placeholder="Enter new category name">
                <input type="submit" class="btn btn-primary" value="Update Category">
            </form>
        </div>
    </div>
@endsection
