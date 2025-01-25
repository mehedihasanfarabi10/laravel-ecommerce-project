<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .invoice-container {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            color: #007bff;
        }

        .header p {
            margin: 5px 0 0;
            color: #666;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .details .left,
        .details .right {
            width: 48%;
        }

        .details h4 {
            margin-bottom: 10px;
            color: #007bff;
            text-transform: uppercase;
        }

        .details p {
            margin: 5px 0;
            font-size: 0.9rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        table thead {
            background-color: #007bff;
            color: #fff;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            text-transform: uppercase;
            font-weight: 600;
        }

        td img {
            display: block;
            max-height: 100px;
            max-width: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .cod-image {
            max-height: 100px;
            max-width: 100px;
            object-fit: cover;
            border: 1px solid #f65555;
            border-radius: 4px;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 0.85rem;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <h2>Invoice</h2>
            <p>Order ID: {{ $order->order_number }}</p>
            <p>Date: {{ date('d M Y') }}</p>
        </div>

        <!-- Customer and Store Details -->
        <div class="details">
            <div class="left">
                <h4>Customer Information</h4>
                <p><strong>Name:</strong> {{ $order->user->name }}</p>
                <p><strong>Address:</strong> {{ $order->user->address }}</p>
                <p><strong>Phone:</strong> {{ $order->user->phone }}</p>
            </div>
            <div class="right">
                <h4>Store Information</h4>
                <p><strong>Store:</strong> Mehedi Store</p>
                <p><strong>Shop Address:</strong> Rangpur, Dhaka, Bangladesh</p>
                <p><strong>Contact:</strong> 01302124986</p>
            </div>
        </div>

        <!-- Order Table -->
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Payment Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->product->title }}</td>
                    <td>${{ number_format($order->product->price, 2) }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td><img src="products/{{ $order->product->image }}" alt="{{ $order->product->title }}"></td>
                    <td>
                        @if ($order->payment_status == 'cash on delivery')
                            <img class="cod-image" src="images/cod.png" alt="Cash on Delivery">
                        @else
                            {{ ucfirst($order->payment_status) }}
                        @endif
                    </td>
                    <td>${{ number_format($order->product->price * $order->quantity, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="total">
            <p>Grand Total: ${{ number_format($order->product->price * $order->quantity, 2) }}</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for shopping with us!</p>
            <p>If you have any questions, contact us at support@example.com</p>
        </div>
    </div>
</body>

</html>
