<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        header {
            display: flex;
            justify-content: space-between;
            background-color: #ffffff;
            color: #fff;
            text-align: center;
            padding: 15px 20px;
        }

        h1 {
            color: #fff;
            margin: 0;
            font-size: 20px;
            flex-grow: 1;
            text-align: right;
        }

        h2,
        h3 {
            color: #333;
        }

        p {
            color: #555;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #E2C094;
            color: #fff;
        }

        .total {
            margin-top: 20px;
            text-align: right;
            font-size: 1.2em;
            color: #333;
        }

        .addresses {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            border-bottom: 2px solid #ddd;
        }

        .address {
            flex-basis: 48%;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <header>
            <div>
                <img style="width: 200px;" src="{{ asset('assets/img/logo/lgo.png') }}" alt="logo">
            </div>
            <div>
                <h1>Invoice</h1>
            </div>
        </header>
        <div class="addresses">
            <div class="address">
                <h3>Bill From:</h3>
                <p>Naattu The Native Food company Private Limited 53</p>
                <p>
                    Nehru Colony
                    Mahalingapuram Pollachi
                   </p>
                <p> Coimbatore Tamilnadu -642109</p>
            </div>
            <div class="address">
                <h3>Bill To:</h3>
                <p> {{ $order->billing_first_name }}</p>
                <p>{{ $order->billing_address }}</p>
                <p>{{ $order->billing_postcode }}</p>
                <p>Phone : {{ $order->billing_phone }}</p>
            </div>
        </div>
        <div style="padding: 20px;">
            <p>Order ID: {{ $order->id }}</p>
            <p>Date: {{ $order->created_at->format('Y-m-d') }}</p>
            <h2>Products</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $qty[$key] }}</td>
                            <td>&#x20B9;{{ $product->price }}</td>
                            <td>&#x20B9;{{ $result[$key] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total">Total: &#x20B9;
                {{ number_format($order->subtotal, 2, '.', ',') }}
            </div>
        </div>
    </div>
</body>

</html>
