<head>
    <style>
        .product-container {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            gap: 30px;
            margin: 20px auto;
            padding: 20px;
            max-width: 1200px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            flex: 1;
            width: 200px;
            height: 200px;
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .product-image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .gallery-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s ease, border-color 0.2s;
        }

        .gallery-image:hover {
            transform: scale(1.1);
            border-color: #007bff;
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

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .add-to-cart-btn {
            padding: 12px 20px;
            font-size: 18px;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-to-cart-btn:hover {
            background-color: #218838;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
                padding: 10px;
            }

            .product-image {
                width: 100%;
                min-height: 200px;
            }

            .product-details {
                width: 100%;
            }
        }
    </style>



</head>

<div class="product-container">
    <!-- Product Image and Gallery -->
    <div>
        <!-- Main Product Image -->
        <div class="product-image" id="myModal">
            <span class="close" onclick="closeModal()">&times;</span>
            <img class="modal-content" id="productImage" src="{{ asset('products/' . $product->image) }}"
                alt="{{ $product->title }}" style="width: 100%; max-width: 400px;">
        </div>
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

    <!-- Product Details -->
    <div class="product-details">
        <h2 class="product-title">{{ $product->title }}</h2>
        <div class="product-price">${{ number_format($product->price, 2) }}</div>
        <div class="product-category">
            Category: {{ $product->categories->category_name ?? 'Uncategorized' }}
        </div>
        <div class="product-description">{{ $product->description }}</div>

        <!-- Form -->
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

    </div>
</div>


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
