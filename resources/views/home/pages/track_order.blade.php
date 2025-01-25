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
    <div>
        <h2 class="order-title text-center mb-4">Track Order</h2>
    </div>

    <!-- Search Form -->
    <form class="text-center mb-4" action="{{ route('track_order') }}" method="get">
        @csrf
        <input style="height: 6%; width: 23%; border-radius: 5px;" type="search" name="search"
            placeholder="Order Number / Phone" value="{{ request('search') }}">
        <input type="submit" class="btn btn-primary" value="Search">
    </form>

    <!-- Display Table Only if Orders Exist -->
    @if (!empty($orders) && $orders->isNotEmpty())
        <div class="container">
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Order Number</th>
                        <th>Total Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Payment Status</th>
                        <th>Status</th>
                        <th>Print</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->product->title ?? 'N/A' }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>${{ number_format($order->price * $order->quantity, 2) }}</td>
                            <td>{{ $order->quantity ?? 'N/A' }}</td>
                            <td>
                                <img src="/products/{{ $order->product->image ?? '' }}" 
                                     alt="{{ $order->product->title ?? '' }}" class="product-image">
                            </td>
                            <td>{{ $order->size }}</td>
                            <td>{{ $order->color }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>
                                <a href="{{ url('print_pdf_user', $order->id) }}" class="btn btn-danger">Print</a>
                            </td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    @else
        <!-- Show Message if No Search Results -->
        <div class="text-center">
            @if (request('search'))
                <p class="text-muted">No orders found for "<strong>{{ request('search') }}</strong>". Please try again.</p>
            @endif
        </div>
    @endif
@endsection
