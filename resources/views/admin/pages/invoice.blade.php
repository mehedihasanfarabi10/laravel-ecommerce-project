<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .invoice-container {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            color: #007bff;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #666;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .details div {
            width: 48%;
        }

        .details h4 {
            margin: 0;
            color: #007bff;
            text-transform: uppercase;
        }

        .details p {
            margin: 5px 0;
            font-size: 0.9rem;
        }

        .date-invoice {
            margin-bottom: 20px;
            border-top: 2px solid #007bff;
            border-bottom: 2px solid #007bff;
            padding: 10px 0;
            text-align: center;
        }

        .date-invoice p {
            margin: 0;
            font-size: 1rem;
            color: #333;
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

        .totals {
            margin-top: 20px;
            text-align: right;
        }

        .totals div {
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .totals div strong {
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.85rem;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header Section -->
        <div class="header">
            <h1>Amazon Pro</h1>
            <p>New York, USA</p>
        </div>

        <!-- Invoice Date and Number -->
        <div class="date-invoice">
            <p><strong>Date:</strong> {{ date('d M Y') }}</p>
            <p><strong>Invoice No.:</strong> {{ $order->order_number }}</p>
        </div>

        <!-- Billing and Shipping Information -->
        <div class="details">
            <div>
                <h4>Bill To</h4>
                <p><strong>Name:</strong> {{ $order->user->name }}</p>
                <p><strong>Company:</strong> {{ $order->user->name }} Company </p>
                <p><strong>Address:</strong> {{ $order->user->address }}</p>
                <p><strong>Phone:</strong> {{ $order->user->phone }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
            </div>
            <div>
                <h4>Ship To</h4>
                <p><strong>Name/Dept:</strong> {{ $order->user->name }}</p>
                <p><strong>Company:</strong> Amazon Pro </p>
                <p><strong>Address:</strong> {{ $order->user->address }}</p>
                <p><strong>Phone:</strong> {{ $order->user->phone }}</p>
            </div>
        </div>

        <!-- Order Details Table -->
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Payment Status</th>
                    <th>Total</th>
                </tr>>
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

        <!-- Totals Section -->
        <div class="totals">
            <div><strong>Subtotal:</strong> ${{ number_format($order->product->price * $order->quantity, 2) }}</div>
            <div><strong>Discount:</strong> $0.00</div>
            <div><strong>Subtotal Less Discount:</strong> ${{ number_format($order->product->price * $order->quantity, 2) }}</div>
            <div><strong>Tax Rate:</strong> 0.00%</div>
            <div><strong>Total Tax:</strong> $0.00</div>
            <div><strong>Shipping/Handling:</strong> $0.00</div>
            <div><strong>Balance Due:</strong> ${{ number_format($order->product->price * $order->quantity, 2) }}</div>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Remarks / Payment Instructions: Thank you for your business!</p>
            <p>If you have any questions, contact us at support@example.com</p>
        </div>
    </div>
</body>

</html>
