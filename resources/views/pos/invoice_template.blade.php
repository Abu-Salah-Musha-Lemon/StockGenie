<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

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
            border-bottom: 1px solid #000;
            text-align: center;
            padding: 2px;
        }

        th {
            background: #f2f2f2;
        }

        .invoice-footer {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="invoice-header">
    <img src="{{ public_path('images/logo/StockGenie.png') }}" alt="Logo">
    <p>BILLING INFORMATION</p>
</div>

<table>
    <tr>
        <td style="text-align:left;">
            <p>ASML Ltd.</p>
            <p>312 Madison Ave.</p>
            <p>Dhaka -1204 Bangladesh</p>
        </td>

        <td style="text-align:right;">
            <p>INVOICE</p>
            <p>SALE #{{ $sale->id }}</p>

            @php
                $date = \Carbon\Carbon::parse($sale->sale_date)->format('F d Y');
            @endphp

            <p>{{ $date }}</p>
            <p>STATUS: {{ $sale->payment_status }}</p>
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach($saleItems as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->product_name }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ number_format($item->sale_price, 2) }}</td>
            <td>{{ number_format($item->total, 2) }}</td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="4" style="text-align:right;">Subtotal:</td>
            <td>{{ number_format($sale->subtotal, 2) }}</td>
        </tr>

        @if($sale->discount > 0)
        <tr>
            <td colspan="4" style="text-align:right;">Discount:</td>
            <td>{{ number_format($sale->discount, 2) }}</td>
        </tr>
        @endif

        @if($sale->tax > 0)
        <tr>
            <td colspan="4" style="text-align:right;">Tax:</td>
            <td>{{ number_format($sale->tax, 2) }}</td>
        </tr>
        @endif

        <tr>
            <td colspan="4" style="text-align:right;">Grand Total:</td>
            <td>{{ number_format($sale->grand_total, 2) }}</td>
        </tr>
    </tfoot>
</table>

<div class="invoice-footer">
    Thank you for shopping at Stock Genie.
</div>

</body>
</html>