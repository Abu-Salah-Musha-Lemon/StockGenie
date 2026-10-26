<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Bengali', Arial, sans-serif;
            width: 60mm;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        .invoice-header {
            text-align: center;
        }
        .invoice-header img {
            max-width: 60px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border-bottom: 1px solid black;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        th {
            background-color: #f2f2f2;
        }
        .invoice-footer {
            text-align: center;
        }
        table, th, td,p {
        margin: 0;
        padding: 0;
        border-collapse: collapse; /* Optional: to remove space between borders */
         }

    </style>
</head>

<body>
    <div class="invoice-header">
        <img src="{{ public_path('images/logo/StockGenie.png') }}" alt="Stock Genie Logo">
        <p>BILLING INFORMATION</p>
    </div>
    <table>
        <tr>
            <td style="text-align: left;">
                <p>ASML Lts.</p>
                <p>312 Madison Ave.</p>
                <p>Dhaka -1204 Bangladesh</p>
            </td>
            <td style="text-align: right; ">
                <p>Invoice</p>
                <p>ORDER #{{ $order->id }}</p>
                <?php
                    $order_date = DateTime::createFromFormat('d-m-y', $order->order_date);
                    $formatted_date = $order_date->format('F d Y');
                ?>
                <p>{{ $formatted_date }}</p>
                <p>PAYMENT STATUS: {{ $order->payment_status }}</p>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Unit Cost</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderDetails as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row->product_name }}</td>
                <td>{{ $row->quantity }}</td>
                <td>{{ $row->unitCost }}</td>
                <td>{{ $row->quantity * $row->unitCost }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align:right;">SUBTOTAL:</td>
                <td>{{ $order->sub_total }}</td>
            </tr>
            @if($order->vat > 0)
            <tr>
                <td colspan="4" style="text-align:right;">TAX (10%):</td>
                <td>{{ $order->vat }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="4" style="text-align:right;">GRAND TOTAL:</td>
                <td>{{ $order->total }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;">Payment:</td>
                <td>{{ $order->pay }}</td>
            </tr>
            @if($order->due > 0)
            <tr>
                <td colspan="4" style="text-align:right;">Due:</td>
                <td>{{ $order->due }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="4" style="text-align:right;">Change Amount:</td>
                <td>{{ $order->returnAmount }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="invoice-footer">
        Thank you for shopping at Stock Genie.
    </div>
</body>

</html>
