@extends('home.layouts.app')

<body>


    <style>
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .product-image {
            flex: 1;
            min-width: 250px;
            position: relative;
            overflow: hidden;
            /* Hide overflow for zoom effect */
            border-radius: 10px;
            cursor: pointer;
        }

        .product-image img {
            width: 100%;
            height: 250px;
            transition: transform 1s ease;
            cursor: zoom-in;

        }

        .product-image:hover img {
            transform: scale(2.5);
        }


        .product-image img:hover {
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Modal styles */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            /* Hide overflow */
            background-color: rgba(0, 0, 0, 0.7);
            padding-top: 60px;
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            cursor: move;
            /* Show move cursor */
            position: absolute;
            /* Allow absolute positioning */
        }

        /* Optional: Style for the close button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }


        .product-details {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .product-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .product-price {
            font-size: 24px;
            color: #d9534f;
        }

        .product-category {
            font-size: 18px;
            color: #5bc0de;
        }

        .product-description {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }

        .quantity-section {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quantity-section input {
            width: 60px;
            padding: 5px;
            text-align: center;
        }

        .add-to-cart-btn {
            padding: 10px 20px;
            font-size: 18px;
            color: white;
            background-color: #5cb85c;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .add-to-cart-btn:hover {
            background-color: #f71491;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* 4 images per row */
            gap: 10px;
            /* Space between images */
            margin-top: 10px;
        }

        .gallery-image {
            width: 100px;
            /* Set image width */
            height: 100px;
            /* Set image height */
            object-fit: cover;
            /* Maintain aspect ratio */
            border: 2px solid #3fbfd9;
            cursor: pointer;
            transition: transform 0.2s ease;
            /* Smooth hover effect */
        }

        .gallery-image:hover {
            transform: scale(1.1);
            /* Enlarge image on hover */
            border-color: #007bff;
            /* Change border color on hover */
        }

        .review-handle {
            margin: 20px;

        }

        /* General Styling */
        .review-handle {
            gap: 20px;
        }

        .review-section {
            border: 1px solid #ddd;
            margin-left: 50px;
        }

        /* Review Form */
        .review-section h2 {
            font-size: 1.5rem;
            font-weight: bold;
            border-bottom: 2px solid #007bff;
            display: inline-block;
            padding-bottom: 5px;
        }

        /* Reviews List */
        .existing-reviews h2 {
            font-size: 1.5rem;
            font-weight: bold;
            border-bottom: 2px solid #007bff;
            display: inline-block;
            padding-bottom: 5px;
        }

        .review-item {
            border: 1px solid #ddd;
            position: relative;
        }

        .review-item .rating-stars {
            font-size: 1.2rem;
            color: #f5c518;
            /* Amazon's yellow star color */
        }

        .review-item .rating-stars .star {
            color: #ccc;
            /* Default star color */
        }

        .review-item .rating-stars .star.filled {
            color: #f5c518;
        }

        .review-item strong {
            font-size: 1rem;
            color: #333;
        }

        .review-item p {
            margin: 5px 0;
        }

        .review-item:hover {
            background-color: #f9f9f9;
            transition: background-color 0.3s;
        }
    </style>
</body>

@section('content')
    <div class="product-container">
        <div direction="column">
            <!-- Main Product Image -->
            <div class="product-image" id="myModal">
                <span class="close" onclick="closeModal()">&times;</span>
                <img class="modal-content" id="productImage" src="{{ asset('products/' . $product->image) }}"
                    alt="{{ $product->title }}" style="width: 100%; max-width: 400px;">
            </div>

            <!-- Gallery Images -->
            <div class="img-box">
                <table class="mt-3">
                    <thead>Product Gallery</thead>
                </table>
                <div class="gallery-grid">
                    <!-- Include Main Product Image in the Gallery -->
                    <img src="{{ asset('products/' . $product->image) }}" alt="Main Product Image" class="gallery-image"
                        onclick="changeMainImage('{{ asset('products/' . $product->image) }}')">

                    @if (is_array($product->gallery_images) && !empty($product->gallery_images))
                        @foreach ($product->gallery_images as $image)
                            <img src="{{ asset('products/new/' . $image) }}" alt="Gallery Image" class="gallery-image"
                                onclick="changeMainImage('{{ asset('products/new/' . $image) }}')">
                        @endforeach
                    @else
                        <p>No images available</p>
                    @endif
                </div>
            </div>
        </div>


        <!-- Product Details -->
        <div class="product-details">
            <div class="product-title">{{ $product->title }}</div>
            <div class="product-price">${{ number_format($product->price, 2) }}</div>
            <div class="product-category">Category: {{ $product->category }}</div>
            <div class="product-description">Description: {{ $product->description }}</div>
            <div class="product-description">Quantity: {{ $product->quantity }}</div>

            {{--  Form  --}}

            <form action="{{ route('add.cart', $product->id) }}" method="GET" style="width: 50%">
                @csrf

                <div class="quantity-section mb-3">
                    <label for="quantity">Quantity:</label>
                    <div class="d-flex align-items-center">
                        <button type="button" id="decrease" class="btn btn-danger">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                            max="{{ $product->quantity }}" required class="form-control mx-2"
                            style="width: 60px;padding:10px;">
                        <button type="button" id="increase" class="btn btn-danger">+</button>
                    </div>
                    {{--  <small class="text-muted">Available: {{ $product->quantity }}</small>  --}}
                </div>

                <!-- Product Size -->
                <div class="form-group mb-3">
                    <label for="color">Select Size:</label>
                    <select name="size" id="size" class="form-control mb-3">
                        @php
                            $sizes = is_string($product->size) ? json_decode($product->size, true) : $product->size;
                        @endphp
                        @if (is_array($sizes) && !empty($sizes))
                            @foreach ($sizes as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        @else
                            <option value="">No sizes available</option>
                        @endif
                    </select>

                </div>


                <!-- Product Color -->


                {{--  Color  --}}

                <div class="form-group mb-3">
                    <label for="color">Select Color:</label>
                    <select name="color" id="color" class="form-control">
                        @php
                            $colors = is_string($product->color) ? json_decode($product->color, true) : $product->color;
                        @endphp

                        @if (is_array($colors) && !empty($colors))
                            @foreach ($colors as $color)
                                <option value="{{ $color }}">{{ $color }}</option>
                            @endforeach
                        @else
                            <option value="">No colors available</option>
                        @endif
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="total">Total Price:</label>
                    <input type="text" id="total" class="form-control" value="{{ $product->price }}" readonly>
                </div>

                <div class="form-group">
                    <button type="submit" class="add-to-cart-btn ">Add To Cart</button>
                </div>
            </form>




            {{--  Form End --}}

        </div>

    </div>




    <div class="review-handle d-flex flex-wrap">
        <!-- Review Form Section -->
        <div class="review-section mt-5 p-4 bg-light rounded shadow-sm" style="flex: 1; max-width: 500px;">
            <h2 class="mb-4 text-primary">Leave a Review</h2>
            <form action="{{ route('product.review', $product->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name"
                        required>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating:</label>
                    <select id="rating" name="rating" class="form-select" required>
                        <option value="">Select Rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label for="review" class="form-label">Review:</label>
                    <textarea id="review" name="review" class="form-control" rows="4" placeholder="Write your review here..."
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit Review</button>
            </form>
        </div>

        <!-- Existing Reviews Section -->
        <div class="existing-reviews mt-5 ms-4" style="flex: 2;">
            <h2 class="mb-4 text-primary">Customer Reviews</h2>
            @if ($product->reviews->count())
                <div class="review-list">
                    @foreach ($product->reviews as $review)
                        <div class="review-item p-3 mb-4 bg-white rounded shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong class="text-dark">{{ $review->name }}</strong>
                                <div class="rating-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                    @endfor
                                </div>
                            </div>
                            <p class="mb-1 text-muted">{{ $review->created_at->format('F j, Y') }}</p>
                            <p class="mb-0">{{ $review->review }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No reviews yet. Be the first to review!</p>
            @endif
        </div>
    </div>


@endsection

@section('script')
    <script>
        function changeMainImage(imageUrl) {
            // Set the clicked image as the main product image
            document.getElementById('productImage').src = imageUrl;
        }

        function closeModal() {
            // Example: Hide modal logic (if needed)
            document.getElementById('myModal').style.display = 'none';
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const decreaseButton = document.getElementById('decrease');
            const increaseButton = document.getElementById('increase');
            const totalInput = document.getElementById('total');
            const pricePerItem = {{ $product->price }}; // Assuming $product->price is the price of a single item.

            // Update total price
            function updateTotal() {
                const quantity = parseInt(quantityInput.value);
                totalInput.value = (quantity * pricePerItem).toFixed(2);
            }

            // Decrease quantity
            decreaseButton.addEventListener('click', function() {
                let quantity = parseInt(quantityInput.value);
                if (quantity > 1) {
                    quantity--;
                    quantityInput.value = quantity;
                    updateTotal();
                }
            });

            // Increase quantity
            increaseButton.addEventListener('click', function() {
                let quantity = parseInt(quantityInput.value);
                const maxQuantity = parseInt(quantityInput.max);
                if (quantity < maxQuantity) {
                    quantity++;
                    quantityInput.value = quantity;
                    updateTotal();
                }
            });

            // Listen to manual input
            quantityInput.addEventListener('input', function() {
                let quantity = parseInt(quantityInput.value);
                const maxQuantity = parseInt(quantityInput.max);
                if (isNaN(quantity) || quantity < 1) {
                    quantity = 1;
                } else if (quantity > maxQuantity) {
                    quantity = maxQuantity;
                }
                quantityInput.value = quantity;
                updateTotal();
            });
        });
    </script>


    <script>
        // Toggle options visibility when clicking on the select button
        document.querySelector('.selected-option').addEventListener('click', function() {
            document.querySelector('.custom-select').classList.toggle('active');
        });

        // Set the selected value and update the hidden input
        document.querySelectorAll('.option').forEach(function(option) {
            option.addEventListener('click', function() {
                var selectedValue = option.textContent;
                document.querySelector('.selected-option').textContent = selectedValue;
                document.getElementById('size').value = option.getAttribute('data-value');
                document.querySelector('.custom-select').classList.remove('active');
            });
        });

        // Close the dropdown when clicking outside of it
        window.addEventListener('click', function(event) {
            if (!event.target.closest('.custom-select-wrapper')) {
                document.querySelector('.custom-select').classList.remove('active');
            }
        });
    </script>



    <script>
        let isDragging = false;
        let offsetX = 0;
        let offsetY = 0;
        let modalImage = document.getElementById('modalImage');

        // Function to open the modal and display the clicked image
        function openModal() {
            var img = document.getElementById('productImage');
            var modal = document.getElementById('myModal');
            modal.style.display = "block";
            modalImage.src = img.src; // Set the modal image source to the clicked image

            // Reset image position in modal (important for dragging)
            modalImage.style.left = '0';
            modalImage.style.top = '0';
        }

        // Function to close the modal
        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = "none";
        }

        // Allow dragging of the zoomed image
        modalImage.onmousedown = function(e) {
            isDragging = true;
            offsetX = e.clientX - modalImage.offsetLeft;
            offsetY = e.clientY - modalImage.offsetTop;
            document.onmousemove = function(e) {
                if (isDragging) {
                    let x = e.clientX - offsetX;
                    let y = e.clientY - offsetY;

                    // Optional: Constrain image movement within the modal (to prevent it from going outside)
                    let modal = document.getElementById('myModal');
                    let maxX = modal.clientWidth - modalImage.width;
                    let maxY = modal.clientHeight - modalImage.height;

                    x = Math.min(Math.max(0, x), maxX);
                    y = Math.min(Math.max(0, y), maxY);

                    modalImage.style.left = x + 'px';
                    modalImage.style.top = y + 'px';
                }
            };

            document.onmouseup = function() {
                isDragging = false;
                document.onmousemove = null;
                document.onmouseup = null;
            };
        };

        // Close modal if clicked outside the image
        window.onclick = function(event) {
            var modal = document.getElementById('myModal');
            if (event.target == modal) {
                modal.style.display = "block";
            }
        };
    </script>
@endsection
