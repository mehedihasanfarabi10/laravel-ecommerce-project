@extends('admin.layout.app')
<style>
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

    tr{
        border: 1px solid black;
    }

    table td {
        background-color: #fafafa;
        color: #000000;
        border: 2px solid rgb(61, 226, 43);
        padding: 10px;
        text-align: center;
    }

    table tbody tr:hover {
        background-color: #e9ecef;
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
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
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
                                    Subcategory
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
                                        {!! Str::limit($data->description, 20) !!}
                                        <!-- {!! Str::words($data->description, 5) !!} -->
                                        <!-- {{ $data->description }} -->
                                    </td>
                                    <td>
                                        {{ $data->price }}
                                    </td>
                                    <td>
                                        {{ $data->categories->category_name }}
                                    </td>
                                    <td>
                                        {{ $data->subcategory->subcategory_name }}
                                    </td>
                                    <td>
                                        {{ $data->quantity }}
                                    </td>
                                    <td>
                                        <img height="70" width="80" src="products/{{ $data->image }}">
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="{{ url('edit_product', $data->id) }}"> <i class="fas fa-edit"></i></a>
                                        <a onclick="confirmation(event)" class="btn btn-danger"
                                            href="{{ url('delete_product', $data->id) }}"> <i class="fa fa-trash"></i></a>
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
