@extends('admin.layout.app')
<style>
    th {
        background-color: skyblue;
        border: 2px solid blueviolet;
        color: white;
        padding: 10px;
    }

    td {
        background-color: yellowgreen;
        border: 2px solid red;
        color: white;
        padding: 10px;
    }

    table {
        border-spacing: 10px 5px;
        /* Space between columns and rows */
        width: 100%;
        /* Optional: Adjust table width */
    }

    tr {
        border: 1px solid white;
    }

    .styless {
        justify-content: center;
        align-items: center;
        display: flex;
        margin-top: 20px;
    }

    /* th {
        background-color: skyblue;
        border: 7px;
        color: white;
    }

    td {
        background-color: yellowgreen;
        border: 4px;
        border-color: blueviolet;
        color: white;
    }

    tr {

        border: 4px;
        color: white;

    } */
</style>

@section('content')
    {{-- Body  --}}


    {{--  <div class="page-content">  --}}
        <div class="page-header">
            <!-- <h3 style="color:crimson" class=" div_design">All Products</h3> -->
            <div class="container-fluid">
                <div class="container-fluid">

                    <form action="{{ url('product_search') }}" method="get">
                        @csrf
                        <input width="400px" height="60px" style="margin-bottom: 39px;" type="search" name="search">
                        <input type="submit" class="btn btn-primary" value="search">
                    </form>

                    <div>
                        <table class="table ">

                            <tr>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Category
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                    Image
                                </th>
                                <th>
                                    Action
                                </th>

                            </tr>
                            @foreach ($productData as $data)
                                <tr>
                                    <td>
                                        {{ $data->title }}
                                    </td>
                                    <td>
                                        {!! Str::limit($data->description, 5) !!}
                                        <!-- {!! Str::words($data->description, 5) !!} -->
                                        <!-- {{ $data->description }} -->
                                    </td>
                                    <td>
                                        {{ $data->price }}
                                    </td>
                                    <td>
                                        {{ $data->category }}
                                    </td>
                                    <td>
                                        {{ $data->quantity }}
                                    </td>
                                    <td>
                                        <img height="70" width="80" src="products/{{ $data->image }}">
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="{{ url('edit_product', $data->id) }}">Edit</a>
                                        <a onclick="confirmation(event)" class="btn btn-danger"
                                            href="{{ url('delete_product', $data->id) }}">Delete</a>
                                    </td>


                                </tr>
                            @endforeach


                        </table>


                    </div>

                    <div class="styless">
                        {{ $productData->onEachSide(1)->links() }}
                    </div>


                </div>
            </div>
        </div>



        {{-- Body End  --}}
    @endsection
