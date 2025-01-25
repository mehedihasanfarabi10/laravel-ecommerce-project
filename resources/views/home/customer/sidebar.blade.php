<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        /* Sidebar styles */
        .dashboard-container {
            display: flex;
            {{--  Fixed height . WIthout height it can be responsive  --}} {{--  height: 100vh;   --}}
        }

        .sidebar {
            width: 250px;
            background-color: #ffffff;
            color: rgb(6, 6, 6);
            padding-top: 20px;
            flex-shrink: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin: 0;
            padding: 10px 20px;
            border-bottom: 1px solid #000000;
            cursor: pointer;
        }

        .sidebar ul li:hover {
            background-color: #a4c4e4;

        }

        .sidebar ul li.active {
            background-color: #d0d3d6;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        /* Content styles */
        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .content h2 {
            margin-bottom: 10px;
            color: #161718;
        }

        .content p {
            color: #34373a;
        }

        .logout {
            text-align: center;
            margin-top: auto;
            padding: 10px 20px;
            background-color: #dc3545;
            cursor: pointer;
        }

        .logout:hover {
            background-color: #25e22b;
        }

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

        {{--  Address Box End --}} {{--  Modal  --}} .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-content h2 {
            margin-top: 0;
            color: #333;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }


        {{--  Modal End  --}}

        {{--  Wishlist  --}}

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
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        /* Card body */
        .card-body {
            text-align: center;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 4px;
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
        {{--  Wishlist End --}}
    </style>
</head>

<body>

    <div class="dashboard-container responsive">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li class="active" onclick="showSection('dashboard')">Dashboard</li>
                <li onclick="showSection('orders')">Orders</li>
                <li onclick="showSection('downloads')">Downloads</li>
                <li onclick="showSection('addresses')">Addresses</li>
                <li onclick="showSection('account-details')">Account Details</li>
                <li onclick="showSection('wishlist')">Wishlist</li>
            </ul>
            <div class="logout" onclick="logout()">Logout</div>
        </div>

        <!-- Content -->
        <div class="content">
            <div id="dashboard" class="content-section">
                <h2>Welcome to Your Dashboard :: {{ Auth::user()->name }} Sir</h2>

                @include('home.customer.dashboardcard')

            </div>
            <div id="orders" class="content-section" style="display: none;">
                <h2>Your Orders</h2>
                <p>Track your current orders and view your order history.</p>

                <h2 class="order-title">My Orders</h2>
                <table class="order-table">
                    <thead>
                        <tr>

                            <th>Product</th>
                            <th>Order Number</th>
                            <th>Total Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            {{--  <th>Size </th>
                            <th>Color </th>  --}}
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
                                <td>{{ $order->order_number ?? 'N/A' }}</td>
                                <td>${{ number_format($order->price * $order->quantity, 2) }}</td>
                                <td>{{ $order->quantity ?? 'N/A' }}</td>
                                <td>
                                    <img src="/products/{{ $order->product->image ?? '' }}"
                                        alt="{{ $order->product->title ?? '' }}" class="product-image">
                                </td>
                                {{--  <td>{{ $order->size }}
                                </td> <!-- Display size name -->
                                <td>{{ $order->color }}  --}}
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


            {{--  Downloads  --}}
            <div id="downloads" class="content-section" style="display: none;">
                <h2>Your Downloads</h2>
                <p>Access your purchased files and downloadable content here.</p>
            </div>

            {{--  Address  --}}
            <div id="addresses" class="content-section" style="display: none;">
                <div class="address-header">

                    {{--  <a href="{{ route('customer.address.create') }}" class="edit-button"> Add Address <i class="fa-solid fa-plus"></i></a>  --}}
                </div>




                @if (!$address)
                    <!-- Show the shipping form -->
                    <div class="shipping-form">
                        {{--  <h2>Add Shipping Address</h2>  --}}
                        @include('home.customer.shipping') <!-- Include your shipping form here -->
                    </div>
                @else
                    <!-- Show the saved address -->
                    <span style="color: #000000!important;">The following addresses will be used on the checkout page by
                        default.</span>
                    <div class="address-box">
                        <h3>Billing Address</h3>
                        <p>
                            <strong>{{ $address->first_name }} {{ $address->last_name }}</strong><br>
                            {{ $address->street_address }}<br>
                            {{ $address->district }} City<br>
                            {{ $address->country }}<br>
                            {{ $address->postcode ?? 'N/A' }}<br>
                        </p>
                        <a href="#" class="edit-button" onclick="openEditModal()">Edit Address</a>
                    </div>

                    <!-- Modal for editing address -->
                    <div id="editAddressModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeEditModal()">&times;</span>
                            <h2>Edit Address</h2>
                            <form action="{{ route('customer.address.update', $address->id) }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name"
                                        value="{{ $address->first_name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name"
                                        value="{{ $address->last_name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="street_address">Street Address</label>
                                    <textarea id="street_address" name="street_address" rows="3" required>{{ $address->street_address }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="town_city">Town / City</label>
                                    <input type="text" id="town_city" name="town_city"
                                        value="{{ $address->district }}" readonly>
                                    <label for="district">Select District</label>
                                    <select id="district" name="district" required>
                                        <option value="" disabled selected>Select a district</option>
                                        <option value="Dhaka" {{ $address->district == 'Dhaka' ? 'selected' : '' }}>
                                            Dhaka</option>
                                        <option value="Rangpur"
                                            {{ $address->district == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                                        <option value="Rajshahi"
                                            {{ $address->district == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                                        <option value="Chittagong"
                                            {{ $address->district == 'Chittagong' ? 'selected' : '' }}>Chittagong
                                        </option>
                                        <option value="Khulna" {{ $address->district == 'Khulna' ? 'selected' : '' }}>
                                            Khulna</option>
                                        <option value="Sylhet" {{ $address->district == 'Sylhet' ? 'selected' : '' }}>
                                            Sylhet</option>
                                        <option value="Barisal"
                                            {{ $address->district == 'Barisal' ? 'selected' : '' }}>Barisal</option>
                                        <option value="Mymensingh"
                                            {{ $address->district == 'Mymensingh' ? 'selected' : '' }}>Mymensingh
                                        </option>
                                        <!-- Add remaining districts here -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="state">County</label>
                                    <input type="text" id="state" name="country" value="{{ $address->country }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="postcode">Postcode / ZIP</label>
                                    <input type="text" id="postcode" name="postcode"
                                        value="{{ $address->postcode }}">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" id="phone" name="phone"
                                        value="{{ $address->phone }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ $address->email }}" required>
                                </div>

                                <button type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>
                @endif


            </div>
            <div id="account-details" class="content-section" style="display: none;">
                <h2>Account Details</h2>
                <p>Update your personal information and password.</p>

                <form action="{{route('user.update')}}" method="POST">
                    @csrf
                    <label for="user_name">Name : </label>
                    <input type="text" name="user_name" value="{{Auth::user()->name}}" required></input>
                    <label for="user_email">Email : </label>
                    <input type="text" style="background-color: #a9adb0;" name="user_email" value="{{Auth::user()->email}}" readonly></input>
                    <label for="user_phone">Phone : </label>
                    <input type="text" name="user_phone" value="{{Auth::user()->phone}}" required></input>
                    <label for="user_address">Address : </label>
                    <textarea type="text" name="user_address" value="{{Auth::user()->address}}" required>{{Auth::user()->address}}</textarea>
                   <div  style="align-items: center; justify-content:center;">
                    <input type="submit"  class="btn btn-info mt-2" value="Update Info"></input>
                   </div>
                </form>
                <div class="flex items-center justify-between mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('Reset your password?') }}
                        </a>
    
                    
                </div>
            </div>
            <div id="wishlist" class="content-section" style="display: none;">
                <h2>Your Wishlist</h2>
                <p>Save your favorite products for later.</p>
                <div class="row" >
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
            </div>
        </div>
    </div>

    <script>
        // Function to handle showing the correct content section
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }

            // Update the active state in the sidebar
            const menuItems = document.querySelectorAll('.sidebar ul li');
            menuItems.forEach(item => item.classList.remove('active'));
            event.target.classList.add('active');
        }

        // Function to handle logout
        function logout() {
            alert('You have been logged out.');
            window.location.href = '/login'; // Redirect to logout URL
        }
    </script>

    <script>
        function openEditModal() {
            document.getElementById('editAddressModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editAddressModal').style.display = 'none';
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('editAddressModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        };
    </script>


</body>

</html>
