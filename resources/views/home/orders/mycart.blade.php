@extends('home.layouts.app')
@include('home.partials.head')

<style>
    .cart-container {
        margin: 50px auto;
        max-width: 1000px;
    }

    .cart-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: crimson;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart-table th,
    .cart-table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .cart-table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .cart-table img {
        width: 80px;
        height: 80px;
        border-radius: 5px;
    }

    .cart-actions {
        margin-top: 20px;
        text-align: right;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        padding: 10px 20px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Remove extra space below the textarea */
    .order-form-container .form-control {
        margin-bottom: 15px;
        /* Adjust this margin as needed */
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        display: block;
        /* Ensure it doesn't add extra space due to display */
    }

    /* Specific styling for textarea */
    /* Ensure there's no extra margin around form controls */
    .order-form-container .form-control {
        margin-bottom: 0 !important;
        /* Remove margin below */
        padding: 10px;
        /* Adjust padding if needed */
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        /* Ensure padding doesn't affect width/height */
        display: block;
        /* Ensures form elements behave as block elements */
        height: auto;
        /* Prevent height expansion */
    }

    /* Apply consistent margin-bottom for all form fields */
    .order-form-container .mb-3 {
        margin-bottom: 10px;
        /* Adjust margin space between fields */
    }

    /* Target the textarea directly to avoid extra space */
    textarea.form-control {
        margin-bottom: 0 !important;
        /* Prevent any margin */
        height: auto;
        /* Adjust height to content */
    }

    /* Prevent collapsing margins in form layout */
    .order-form-container .form-group,
    .order-form-container .form-label {
        margin-bottom: 0;
    }

    /* Clear float or reset any layout interference */
    .order-form-container::after {
        content: "";
        display: table;
        clear: both;
    }

    /* Remove any bottom padding or margins in the container */
    .container.mt-5 {
        padding-bottom: 0 !important;
    }

    /* Ensure no extra padding or margin in the form wrapper */
    .order-form-container {
        padding-bottom: 0;
        /* Ensure no extra padding below the form */
    }


    .order-form-container .form-control {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .order-form-container .btn {
        width: 100%;
        padding: 12px;
        background-color: #28a745;
        /* Green color */
        border: none;
        color: white;
        border-radius: 5px;
        font-size: 16px;
    }

    .order-form-container .btn:hover {
        background-color: #218838;
        /* Darker green on hover */
    }

    .order-form-container h2 {
        text-align: center;
        color: crimson;
    }

    .order-form-container .form-label {
        font-size: 16px;
    }

    .container {
        margin-bottom: 0;
        /* Ensure no extra margin below the form */
    }

    /* Remove any extra space below the textarea */
    textarea.form-control {
        margin-bottom: 0 !important;
        /* Remove margin */
        padding: 10px;
        /* Adjust padding if needed */
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        /* Ensures padding does not affect layout */
        height: auto;
        /* Ensure height is set correctly */
    }

    /* Remove space around the form elements */
    .container.mt-5 {
        padding-bottom: 0;
        /* Remove padding around the form container */
    }

    /* Adjust margin for all form controls */
    .form-control {
        margin-bottom: 10px !important;
        /* Consistent spacing between form fields */
    }

    /* Remove default margin of the textarea */
    textarea {
        margin-bottom: 0 !important;
        /* Prevent extra space under the textarea */
    }


    .total-price {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .d-grid {
        display: grid;
        gap: 10px;
    }

    {{--  Address Box  --}} .address-box {
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 8px;
        background-color: #f9f9f9;
        max-width: 400px;
        margin: 20px auto;
    }

    .address-box h3 {
        margin-bottom: 10px;
        font-size: 18px;
        color: #333;
    }

    .address-box p {
        margin: 0 0 15px;
        line-height: 1.6;
        color: #555;
    }

    .address-box a.edit-button {
        display: inline-block;
        padding: 8px 12px;
        font-size: 14px;
        color: #fff;
        background-color: #007bff;
        text-decoration: none;
        border-radius: 4px;
    }

    .address-box a.edit-button:hover {
        background-color: #0056b3;
    }

    .address-header {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        padding: 0 10px;
    }

    .address-header h2 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    .edit-button {
        padding: 8px 16px;
        font-size: 14px;
        color: #fff;
        background-color: #28a745;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    {{--  Address Box End --}}
</style>

@section('content')
    <!-- Cart Section -->
    <div class="cart-container">

        <h2 class="cart-title">My Cart</h2>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalValue = 0; ?>
                @foreach ($cart as $cartItem)
                    <tr data-id="{{ $cartItem->id }}">
                        <td>
                            <img src="/products/{{ $cartItem->product->image }}" alt="{{ $cartItem->product->title }}">
                        </td>
                        <td>{{ $cartItem->product->title }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-danger btn-decrease p-2 mr-2">-</button>
                                <input type="number" class="form-control mt-2  cart-quantity"
                                    value="{{ $cartItem->quantity }}" min="1"
                                    max="{{ $cartItem->product->quantity }}" data-id="{{ $cartItem->id }}"
                                    style="width: 60px;padding:10px;">
                                <button type="button" class="btn btn-danger btn-increase p-2 ml-2">+</button>
                            </div>
                        </td>
                        <td class="cart-price">${{ number_format($cartItem->product->price, 2) }}</td>
                        <td class="cart-total">${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                        <td>
                            <form action="{{ url('remove_from_cart', $cartItem->id) }}" method="POST">
                                @csrf
                                <button class="btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                    <?php $totalValue += $cartItem->product->price * $cartItem->quantity; ?>
                @endforeach
            </tbody>
        </table>

        <div class="cart-actions">
            <div class="total-price">
                <h4>Total: $<span id="cart-total">{{ number_format($totalValue, 2) }}</span></h4>
            </div>
        </div>

        <!-- Order Form -->
        <div class="order-form-container">
            <!-- Address Box -->

            <h2>Place Your Order</h2>
            <form action="{{ url('place_order') }}" method="POST">
                @csrf
                <div class="address-box">
                    <h3>Shipping Address</h3>

                    @if ($address)
                        <!-- Checkbox to select the address -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="use_address" name="use_address"
                                value="1" checked>
                            <label class="form-check-label" for="use_address">
                                Use this shipping address
                            </label>
                        </div>
                        <p>
                            <strong>{{ $address->first_name }} {{ $address->last_name }}</strong><br>
                            {{ $address->street_address }}<br>
                            {{ $address->district }} City<br>
                            {{ $address->country }}<br>
                            {{ $address->postcode ?? 'N/A' }}<br>
                        </p>



                        <!-- Hidden inputs to pass address data -->
                        <input type="hidden" name="shipping_address[first_name]" value="{{ $address->first_name }}">
                        <input type="hidden" name="shipping_address[last_name]" value="{{ $address->last_name }}">
                        <input type="hidden" name="shipping_address[street_address]"
                            value="{{ $address->street_address }}">
                        <input type="hidden" name="shipping_address[district]" value="{{ $address->district }}">
                        <input type="hidden" name="shipping_address[country]" value="{{ $address->country }}">
                        <input type="hidden" name="shipping_address[postcode]" value="{{ $address->postcode ?? 'N/A' }}">

                        <a href="#" class="edit-button" onclick="openEditModal()">Edit Address</a>
                    @else
                        <p>You have not added a shipping address yet.</p>
                        <a href="{{ route('user.profile') }}" class="edit-button">Add Address</a>
                    @endif
                </div>
                <!-- Receiver Name -->
                <div class="mb-3">
                    <label for="receiverName" class="form-label">Receiver Name</label>
                    <input type="text" class="form-control" id="receiverName" name="receiver_name"
                        placeholder="Enter receiver's name" value="{{ Auth::user()->name }}" required>
                </div>
                <!-- Receiver Address -->
                <div class="mb-3">
                    <label for="receiverAddress" class="form-label">Receiver Address</label>
                    <input type="text" class="form-control" id="receiver_address" name="receiver_address"
                        placeholder="Enter receiver's address" value="{{ Auth::user()->address }}" required>
                </div>
                <!-- Phone -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone"
                        placeholder="Enter phone number" value="{{ Auth::user()->phone }}" required>
                </div>
                <!-- Total Price -->
                {{--  <div class="cart-actions">
                    <div class="total-price">
                        <h4>Total: $<span id="cart-total">{{ number_format($totalValue, 2) }}</span></h4>
                    </div>
                </div>  --}}
                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Cash On Delivery</button>
                    <a type="button" class="btn btn-success" href="{{ url('stripe', $totalValue) }}">Pay With Card</a>
                </div>
            </form>
        </div>

    </div>
@endsection





@section('script')
    <script>
        document.querySelectorAll('.cart-quantity').forEach(input => {
            input.addEventListener('change', function() {
                const cartId = this.getAttribute('data-id');
                const newQuantity = this.value;

                fetch(`/update-cart/${cartId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            quantity: newQuantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const cartRow = this.closest('tr');
                            const priceCell = cartRow.querySelector('.cart-price').textContent.replace(
                                '$', '');
                            const newTotal = (parseFloat(priceCell) * newQuantity).toFixed(2);
                            cartRow.querySelector('.cart-total').textContent = `$${newTotal}`;

                            // Update the total cart price
                            updateCartTotal();
                        } else {
                            alert(data.message);
                        }
                    });
            });
        });

        function updateCartTotal() {
            let total = 0;
            document.querySelectorAll('.cart-total').forEach(totalCell => {
                total += parseFloat(totalCell.textContent.replace('$', ''));
            });
            document.getElementById('cart-total').textContent = total.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const cartRows = document.querySelectorAll('.cart-table tbody tr');
            const cartTotalDisplay = document.getElementById('cart-total');

            function updateRowTotal(row) {
                const quantityInput = row.querySelector('.cart-quantity');
                const priceCell = row.querySelector('.cart-price');
                const totalCell = row.querySelector('.cart-total');

                const quantity = parseInt(quantityInput.value);
                const price = parseFloat(priceCell.textContent.replace('$', ''));
                const rowTotal = (quantity * price).toFixed(2);

                totalCell.textContent = `$${rowTotal}`;
            }

            function updateCartTotal() {
                let total = 0;
                cartRows.forEach(row => {
                    const totalCell = row.querySelector('.cart-total');
                    const rowTotal = parseFloat(totalCell.textContent.replace('$', ''));
                    total += rowTotal;
                });
                cartTotalDisplay.textContent = total.toFixed(2);
            }

            cartRows.forEach(row => {
                const decreaseButton = row.querySelector('.btn-decrease');
                const increaseButton = row.querySelector('.btn-increase');
                const quantityInput = row.querySelector('.cart-quantity');

                decreaseButton.addEventListener('click', function() {
                    let quantity = parseInt(quantityInput.value);
                    if (quantity > 1) {
                        quantity--;
                        quantityInput.value = quantity;
                        updateRowTotal(row);
                        updateCartTotal();
                    }
                });

                increaseButton.addEventListener('click', function() {
                    let quantity = parseInt(quantityInput.value);
                    const maxQuantity = parseInt(quantityInput.max);
                    if (quantity < maxQuantity) {
                        quantity++;
                        quantityInput.value = quantity;
                        updateRowTotal(row);
                        updateCartTotal();
                    }
                });

                quantityInput.addEventListener('input', function() {
                    let quantity = parseInt(quantityInput.value);
                    const maxQuantity = parseInt(quantityInput.max);
                    if (isNaN(quantity) || quantity < 1) {
                        quantity = 1;
                    } else if (quantity > maxQuantity) {
                        quantity = maxQuantity;
                    }
                    quantityInput.value = quantity;
                    updateRowTotal(row);
                    updateCartTotal();
                });
            });
        });
    </script>
@endsection
