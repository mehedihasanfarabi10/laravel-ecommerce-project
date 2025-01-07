@extends('admin.layout.app')

<style>
    /* Input field styling */
    input[type='text'] {
        width: 100%;
        /* Make the input take full width of the parent container */
        height: 50px;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .div_design {
        display: flex;
        justify-content: center;
        {{--  margin-bottom: 20px;  --}}
    }

    /* Ensure page content fills the available height */
    .page-content {
        min-height: calc(100vh - 100px);
        /* Adjust to fill the screen minus header/footer */
        padding-bottom: 50px;
        /* Space at the bottom for footer */
    }

    footer {
        margin-top: 20px;
        /* Prevent footer overlap */
        position: relative;
    }

    /* Form container to center the form */
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
    }

    /* Table styling */
    th {
        background-color: skyblue;
        border: 2px solid #fff;
        color: white;
    }

    td {
        background-color: yellowgreen;
        border: 2px solid #fff;
        color: white;
    }

    tr {
        border: 2px solid #fff;
    }

    /* Set full width for the container */
    .container-fluid {
        width: 100%;
    }

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
    {{--  <div class="d-flex align-items-stretch">  --}}

    {{-- Body  --}}


    {{--  <div class="page-content">  --}}
        <div class="page-header">
            <h3 style="color:crimson" class=" div_design">Update Category</h3>
            <div class="container-fluid">
                <div class="div_design">

                    <form action="{{ url('update_category', $olddata->id) }}" method="post">
                        @csrf
                        <input type="text" name="category_new_name" value="{{ $olddata->category_name }}">
                        <input type="submit" class="btn btn-primary" value="Update Category">
                    </form>
                </div>

            </div>
        </div>
    {{--  </div>  --}}



    {{-- Body End  --}}
    {{--  </div>  --}}
@endsection
