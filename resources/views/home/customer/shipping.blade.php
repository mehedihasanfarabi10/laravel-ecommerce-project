<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Address Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #343a40;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            resize: none;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .optional {
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>

<body>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="form-container">
        <h2>Shipping Address</h2>
        <form action="{{ route('customer.shippingaddress.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required>
            </div>
            <div class="form-group">
                <label for="country">Country / Region</label>
                <select id="country" name="country" required>
                    <option value="Bangladesh" selected>Bangladesh</option>
                    <!-- Add more countries if necessary -->
                </select>
            </div>
            <div class="form-group">
                <label for="street_address">Street Address</label>
                <textarea id="street_address" name="street_address" rows="3" placeholder="Enter your street address" required></textarea>
            </div>
            <div class="form-group">
                <label for="district">Select District</label>
                <select id="district" name="district" required>
                    <option value="" disabled selected>Select a district</option>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Rangpur">Rangpur</option>
                    <option value="Rajshahi">Rajshahi</option>
                    <option value="Chittagong">Chittagong</option>
                    <option value="Khulna">Khulna</option>
                    <option value="Sylhet">Sylhet</option>
                    <option value="Barisal">Barisal</option>
                    <option value="Mymensingh">Mymensingh</option>
                    <!-- Add remaining 56 districts -->
                </select>
            </div>
            <div class="form-group">
                <label for="postcode">Postcode / ZIP <span class="optional">(optional)</span></label>
                <input type="text" id="postcode" name="postcode" placeholder="Enter your postcode or ZIP">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <button type="submit">Save Address</button>
        </form>
    </div>

</body>

</html>
