@extends('admin.layout.app')

@section('title', 'Category Management')

<style>
    .page-content {
        min-height: calc(100vh - 100px);
        /* Adjust the content area to fill available space */
        padding-bottom: 50px;
        /* Adjust the bottom padding as needed */
    }

    footer {
        margin-top: auto;
        /* Ensure footer stays at the bottom */
    }

    input[type='text'] {
        width: 400px;
        height: 50px;
    }


    th {
        background-color: skyblue;
        border: 7px;
        color: white;
    }

    td {
        background-color: yellowgreen;
        border: 4px;
        color: white;
    }

    tr {

        border: 4px;
        color: white;
    }
</style>

@section('content')
<div class="d-flex flex-column" >
                                <!-- Main Content Area -->
        <div class=" container-fluid">

    <form action="{{ url('category_search') }}" method="get">
        @csrf
        <input width="400px" height="60px" style="margin-bottom: 39px;" type="search" name="search">
        <input type="submit" class="btn btn-primary" value="search">
    </form>

    <div class="page-header">
        <h3 style="color:crimson" class="div_design">Add Category</h3>
    </div>

    <div class="div_design">
        <form action="{{ url('add_category') }}" method="post">
            @csrf
            <input type="text" name="category" id="category" class="category_name" required placeholder="Enter category name">
            <input type="hidden" name="id" id="id" class="category_id" required >
            <input type="submit" class="btn btn-primary" value="Add Category">
        </form>
    </div>

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
                    <a class="edit btn btn-success" data-id="{{$category->id}}" href="{{ url('edit_category', $category->id) }}">Edit</a>
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


</div>
@endsection


@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $('body').on('click','.edit',function(){
        let cat_id = $(this).data('id');

        $.get('edit_category'+cat_id,function (data){
                $('#category').val(data.category)
                $('#id').val(data.id)
        })
    })
</script>
@endsection