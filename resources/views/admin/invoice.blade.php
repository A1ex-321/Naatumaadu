<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Bootstrap CSS link -->
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            background-color: #FFFFFF;
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
            background-color: #FFFFFF;
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
            background-color: #5E210D;
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

        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            height: 1000px;
            /* Adjust the height as needed */
        }

        .reduce-padding {
            padding: 2px;
            /* Adjust this value to your preference */
        }

        /* tr, td {
        padding: 0;
    } */
    </style>
</head>

<body>
    <div class="invoice-container">
        <header>
            <div>
                <img style="width: 200px;" src="{{ asset('assets/img/logo/lgo.png') }}" alt="logo">
            </div>
            <div>
                <h5>Invoice</h5>
            </div>
        </header>
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%;">
                    <h6 style="font-weight:bold;">Bill From:</h6>
                    <p>Naattu The Native Food company Private Limited 53</p>
                    <p>Nehru Colony Mahalingapuram Pollachi</p>
                    <p>Coimbatore Tamilnadu -642109</p>
                </td>
                <td style="width: 50%; margin-left:20%;">
                    <h6 style="font-weight:bold;">Bill To:</h6>
                    <p>{{ $order->billing_first_name }}</p>
                    <p>{{ $order->billing_address }}</p>
                    <p>{{ $order->billing_postcode }}</p>
                    <p>Phone: {{ $order->billing_phone }}</p>
                </td>
            </tr>
        </table>
        <table style="width: 100%;border-spacing:0px;border:none;">
            <tr>
                <td style="width: 50%;padding:0.5">
                    <p>Order ID: {{ $order->id }}</p>
                </td>
                <td style="width: 50%; margin-left:20%;">
                    <p>Date: {{ $order->created_at->format('Y-m-d') }}</p>
                </td>
            </tr>
        </table>
        <div style="padding: 1px;">
            <h5 style="font-weight:bold;">Products</h5>
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="display: table-header-group;">
                    <tr>
                        <th style="border: none; padding: 5px;">Product</th>
                        <th style="border: none; padding: 5px;">Quantity</th>
                        <th style="border: none; padding: 5px;">Price</th>
                        <th style="border: none; padding: 5px;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                    <tr>
                        <td style="border: none; padding: 5px;">{{ $product->name }}</td>
                        <td style="border: none; padding: 5px;">{{ $qty[$key] }}</td>
                        <td style="border: none; padding: 5px;">&#x20B9;{{ $product->price }}</td>
                        <td style="border: none; padding: 5px;">&#x20B9;{{ $result[$key] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total">Total: &#x20B9;
                {{ number_format($order->subtotal, 2, '.', ',') }}
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and Popper.js scripts are required -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>