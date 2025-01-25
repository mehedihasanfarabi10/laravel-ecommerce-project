@extends('home.layouts.app')

@section('content')
    <style>
        /* Container for the product card */
        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            background-color: #fff;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* Product image */
        .card img {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }

        /* Card body */
        .card-body {
            padding: 15px;
            text-align: center;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .card-text {
            color: #ff5722;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Action buttons container */
        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
        }

        /* Add to Cart button */
        .btn-add-to-cart {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-add-to-cart:hover {
            background-color: #218838;
        }

        /* Remove button */
        .btn-remove {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-remove:hover {
            background-color: #c82333;
        }

        /* Empty wishlist styling */
        .empty-wishlist {
            text-align: center;
            margin-top: 50px;
        }

        .empty-wishlist p {
            color: #666;
            font-size: 16px;
        }

        .empty-wishlist .btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
        }

        .empty-wishlist .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container py-5">
        <h2 class="text-center mb-4" style="font-size: 28px; font-weight: bold;">My Wishlist</h2>

        @if ($wishlistItems->isEmpty())
            <div class="empty-wishlist">
                <p>Your wishlist is empty. Start adding your favorite products!</p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Browse Products</a>
            </div>
        @else
            <div class="row">
                @foreach ($wishlistItems as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <!-- Product Image -->
                            <img src="{{ asset('products/' . $item->product->image) }}" alt="{{ $item->product->title }}">

                            <!-- Product Info -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->product->title }}</h5>
                                <p class="card-text">${{ $item->product->price }}</p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="card-actions">
                                <!-- Add to Cart Button -->
                                <form action="{{ route('add.cart', $item->product->id) }}" method="GET" class="me-2">
                                    @csrf
                                    <button type="submit" class="btn-add-to-cart">Add to Cart</button>
                                </form>

                                <!-- Remove from Wishlist Button -->
                                <form action="{{ route('wishlist.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-remove">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
