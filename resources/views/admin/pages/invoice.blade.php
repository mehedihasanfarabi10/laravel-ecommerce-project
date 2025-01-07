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
            line-height: 1.6;
        }
        .invoice-container {
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
            color: crimson;
        }
        .details {
            margin-bottom: 20px;
        }
        .details h4 {
            margin: 0 0 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h2>Invoice</h2>
            <p>Order ID: {{ $order->id }}</p>
        </div>

        <div class="details">
            <h4>Customer Details:</h4>
            <p><strong>Name:</strong> {{ $order->user->name }}</p>
            <p><strong>Address:</strong> {{ $order->user->address }}</p>
            <p><strong>Phone:</strong> {{ $order->user->phone }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->product->title }}</td>
                    <td>${{ number_format($order->product->price, 2) }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td> <img height="200" width="200" src="products/{{$order->product->image}}"> </td>
                    <td>${{ number_format($order->product->price * $order->quantity, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            <p>Total: ${{ number_format($order->product->price * $order->quantity, 2) }}</p>
        </div>
    </div>
</body>
</html>
