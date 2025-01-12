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
        z-index: 1;
    }

    .order-table td {
        background-color: #fcfcfc;
        color: black!important;
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

    .div_design {
        font-size: 24px;
        font-weight: bold;
    }

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

    /* Input Field Styling */
    input[type='search'] {
        width: 400px;
        height: 40px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
    }

    .btn-primary {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Buttons Styling */
    .btn {
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-warning {
        background-color: #ffc107;
        color: white;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
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
                    <input type="search" name="search" placeholder="Search Orders">
                    <input type="submit" class="btn btn-primary" value="Search">
                </form>

                <div class="table-responsive">
                    <table class="table table-striped order-table">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Product Title</th>
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
                                    <td>${{ number_format($order->product->price, 2) }}</td>
                                    <td>
                                        <img src="/products/{{ $order->product->image }}" alt="{{ $order->product->title }}">
                                    </td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>
                                        <button class="btn">
                                            @if ($order->status == 'in progress')
                                                <span style="color: rgb(240, 22, 192); background-color: rgb(20, 239, 255);">{{ $order->status }}</span>
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
                                        <a href="{{ url('on_the_way', $order->id) }}" class="btn btn-info">On The Way</a>
                                        <a href="{{ url('delievered', $order->id) }}" class="btn btn-success">Delivered</a>
                                        <a href="{{ url('cancelled', $order->id) }}" class="btn btn-warning">Cancelled</a>
                                    </td>

                                    <td>
                                        <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-info">Print</a>
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
