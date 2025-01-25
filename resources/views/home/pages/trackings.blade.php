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

    
@endsection
