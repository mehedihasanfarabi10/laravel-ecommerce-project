@extends('admin.layout.app')

@section('title', 'Order Management')

<style>
    .order-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .order-table th,
    .order-table td {
        padding: 15px;
        text-align: center;
        color: white !important;
        border: 1px solid #ddd;
        position: relative;
        /* Ensure table cells are not overlapped */
        z-index: 1;
    }

    .order-table td {
        position: relative;
        /* Ensure table cells are not overlapped */
        z-index: 1;
        /* Bring them to the top */
        background-color: #2f3c44;
    }



    .order-table th {
        background-color: #22c916;
        font-weight: bold;
    }

    .order-table img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }

    .page-content {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .container-fluid {
        padding: 0;
    }

    .row {
        width: 100%;
    }

    .div_design {
        font-size: 24px;
        font-weight: bold;
    }

    /* Adjusting the content section */
    .content-area {
        flex-grow: 1;
        padding: 20px;
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
    {{-- Body --}}
    <div class="d-flex align-items-stretch">
        {{-- Sidebar and Main Content Area --}}
        <div class="d-flex align-items-stretch" style="width: 100%;">

            

            {{-- Main Content --}}
            <div class="content-area">
                <div class="page-header">
                    <h3 style="color:crimson" class="div_design">Order Management</h3>
                </div>

                <form action="{{ url('order_search') }}" method="get">
                    @csrf
                    <input width="400px" height="60px" style="margin-bottom: 39px;" type="search" name="search">
                    <input type="submit" class="btn btn-primary" value="search">
                </form>

                <div class="table-responsive">
                    <table class="table table-striped order-table">

                        {{--  New Thead  --}}

                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Product Title</th>
                                {{--  <th>Size</th> <!-- Add size column -->
                                <th>Color</th> <!-- Add color column -->  --}}
                                <th>Price</th>
                                <th>Product Image</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Change Status</th>
                                <th>Print PDF</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->user->email }}</td>
                                    <td>{{ $order->rec_address }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->product->title }}</td>
                                    {{--  <td>{{ $orderItem->size->name ?? 'N/A' }}</td>
                                    <td>{{ $orderItem->color->name ?? 'N/A' }}</td>  --}}

                                    <td>${{ number_format($order->product->price, 2) }}</td>
                                    <td>
                                        <img src="/products/{{ $order->product->image }}" alt="{{ $order->product->title }}">
                                    </td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>
                                        <button class="btn">
                                            @if ($order->status == 'in progress')
                                                <span
                                                    style="color: rgb(240, 22, 192); background-color: rgb(20, 239, 255);">{{ $order->status }}</span>
                                            @elseif($order->status == 'On The Way')
                                                <span style="color: rgb(20, 239, 255);">{{ $order->status }}</span>
                                            @elseif($order->status == 'Delivered')
                                                <span style="color: rgb(58, 235, 52)">{{ $order->status }}</span>
                                            @elseif($order->status == 'Cancelled')
                                                <span style="color: rgb(255, 0, 0)">{{ $order->status }}</span>
                                            @endif
                                        </button>
                                    </td>

                                    <td>
                                        <a href="{{ url('on_the_way', $order->id) }}" class="btn btn-info"> On The Way </a>
                                        <a href="{{ url('delievered', $order->id) }}" class="btn btn-success">Delivered</a>
                                        <a href="{{ url('cancelled', $order->id) }}" class="btn btn-warning">Cancelled</a>
                                    </td>


                                    <td>
                                        <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-info">Print </a>
                                    </td>
                                    <td>
                                        <form action="{{ url('delete_order', $order->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            {{-- Main Content End --}}
        </div>
    </div>
    {{-- Body End --}}
@endsection


