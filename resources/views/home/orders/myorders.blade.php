@extends('home.layouts.app')

<style>
    .order-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .order-table th,
    .order-table td {
        padding: 15px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .order-table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .order-title {
        font-size: 24px;
        font-weight: bold;
        color: crimson;
        margin-bottom: 20px;
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }
</style>

@section('content')
    <div class="container">
        <h2 class="order-title">My Orders</h2>
        <table class="order-table">
            <thead>
                <tr>

                    <th>Product</th>
                    <th>Order Number</th>
                    <th>Total Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Size  </th>
                    <th>Color  </th>
                    <th>Payment Status</th>
                    <th>Status</th>
                    <th>Print</th>
                    <th>Order Date</th>

                </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->product->title ?? 'N/A' }}</td>
                        <td>${{ number_format($order->price * $order->quantity, 2) }}</td>
                        <td>{{ $order->quantity ?? 'N/A' }}</td>
                        <td>
                            <img src="/products/{{ $order->product->image ?? '' }}" alt="{{ $order->product->title ?? '' }}"
                                class="product-image">
                        </td>
                        <td>{{ $order->size  }}
                            </td> <!-- Display size name -->
                        <td>{{ $order->color }}
                            </td> <!-- Display color name -->
                       
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        
                        <td>
                            <a href="{{ url('print_pdf_user', $order->id) }}" class="btn btn-danger">Print </a>
                        </td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>



            </tbody>
        </table>
    </div>
@endsection
