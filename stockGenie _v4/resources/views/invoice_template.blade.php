<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
         @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/DejaVuSans.ttf') }}') format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        
        .invoice-box table tr.payment td:nth-child(2) {
            font-style: italic;
        }
        
        .invoice-box .logo img {
            text-align: center;
            margin-bottom: 10px;
            width: 80px;
            height: 80px;
        }
        
        .status-due {
            color: red;
        }
        
        .status-paid {
            color: green;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="logo">
            
        </div>
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td colspan="3">
                                <h2>Invoice</h2>
                            </td>
                            <td colspan="3" style="text-align: right;">
                                Invoice #: <br>
                                Created: {{ $data['order_date'] }}<br>
                                Order Status: {{ $data['order_status'] }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td colspan="2">
                                ASMLab, Inc.<br>
                                12345 Sunny Road<br>
                                Sunnyville, TX 12345
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
           
            <tr class="heading">
                <td>Item</td>
                <td>Quantity</td>
                <td>Unit Cost</td>
                <td>Total</td>
            </tr>
            
            @foreach($contentsCart as $item)
            <tr class="item">
                <td>{{ $item->name }}</td>
                <td>{{ $item->qty }}</td>
                <td>৳{{ $item->price }}</td>
                <td>৳{{ $item->subtotal }}</td>
            </tr>
            @endforeach
            
            <tr class="subtotal">
                <td colspan="3"></td>
                <td>Subtotal: ৳{{ $data['sub_total'] }}</td>
            </tr>
            <tr class="tax">
                <td colspan="3"></td>
                <td>Total qty: {{ $data['total_products'] }}</td>
            </tr>
            <tr class="tax">
                <td colspan="3"></td>
                <td>VAT (10%): <span style="font-family: firefly, DejaVu Sans, sans-serif;">&#2547;</span> {{ $data['vat'] }}</td>
            </tr>
            
            <tr class="total">
                <td colspan="3"></td>
                <td>Grand Total: <span style="font-family: firefly, DejaVu Sans, sans-serif !impotent;">&#x9F3;</span> {{ $data['total'] }}</td>
            </tr>
            
            <tr class="payment">
                <td colspan="3">Payment Method:</td>
                <td>{{ $data['payment_status'] }}</td>
            </tr>
            <tr class="payment">
                <td colspan="3">Payment:</td>
                <td>৳{{ $data['pay'] }}</td>
            </tr>
            <tr class="payment">
                <td colspan="3">Due:</td>
                <td style="border-bottom: 2px solid lightgray;">৳{{ $data['due'] }}</td>
            </tr>
            <tr class="payment">
                <td colspan="3">Return Amount:</td>
                <td>৳{{ $data['returnAmount'] }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
