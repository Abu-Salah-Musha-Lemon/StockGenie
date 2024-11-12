<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&display=swap" rel="stylesheet">
    <style>
				.noto-serif-bengali {
					font-family: "Noto Serif Bengali", serif;
					font-optical-sizing: auto;
					font-weight: <weight>;
					font-style: normal;
					font-variation-settings:
						"wdth" 100;
				}
        body {
            font-family: 'Noto Serif Bengali';
            width: var(--table-width);
						
        }
				.container, table{
					width: 80mm !important;
					margin: 0 !important;
					padding: 0 !important;
					font-size:12px;
				}
				p{
					margin: 0 !important;
					padding: 0 !important;
				}
        .invoice-header img {
            max-width: 60px;
        }

        .table thead th,tr,td{
            border-bottom: 1px solid black;
						margin: 0 !important;
						padding: 0 !important;
						text-decoration:none;
						font-size:12px;
        }
      
        .invoice-header ,.invoice-body, .invoice-footer {
          width: 80mm;
        }
        .invoice-footer {
            text-align: center;
        }

        /* @media print {
            @page {
                size: A4;
                margin: 20mm;
            }

            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            .print-hide {
                display: none;
            }

            .container {
                width: 100%;
                padding: 0;
            }
        } */
    </style>
</head>

<body>
	<div class="container">

		<div class="invoice-header">
				<div style="text-align:center">
					<img src="{{ public_path('images/logo/StockGenie.png') }}" alt="Stock Genie Logo">
					<p>BILLING INFORMATION</p>
				</div>
				<table>
						<tr>
								<td>
										<div class="billing-info">
												<p>ASML Lts.<br>312 Madison Ave.<br>Dhaka -1204<br>Bangladesh</p>
										</div>
								</td>
								<td>
										<div style="text-align:right;">
												<p>Invoice</p>
												<p>ORDER #{{ $order->id }}</p>
												<?php
														$order_date = DateTime::createFromFormat('d-m-y', $order->order_date);
														$formatted_date = $order_date->format('F d Y');
												?>
												<p>{{ $formatted_date }}</p>
												<p>PAYMENT INFORMATION</p>
												<p>{{ $order->payment_status }}</p>
										</div>
								</td>
						</tr>
				</table>
		</div>

		<div class="invoice-body" >
				<table>
						<thead>
								<tr class="text-center">
										<th>#</th>
										<th>Item Name</th>
										<th>Quantity</th>
										<th>Unit Cost</th>
										<th>Total</th>
								</tr>
						</thead>
						<tbody>
								@foreach($orderDetails as $index => $row)
								<tr class="text-center">
										<td>{{ $index + 1 }}</td>
										<td style="font-size:14px">{{ $row->product_name }}</td>
										<td>{{ $row->quantity }}</td>
										<td>{{ $row->unitCost }}</td>
										<td class="text-left">{{ $row->quantity * $row->unitCost }}</td>
								</tr>
								@endforeach
						</tbody>
						<tfoot>
								<tr>
										<td colspan="4" class="text-right">SUBTOTAL : </td>
										<td class="text-left">{{ $order->sub_total }}</td>
								</tr>
								<tr>
										<td colspan="4" class="text-right">Qty : </td>
										<td class="text-left">{{ $order->total_products }}</td>
								</tr>
								@if($order->vat > 0)
								<tr>
										<td colspan="4" class="text-right">TAX (10%) : </td>
										<td class="text-left">{{ $order->vat }}</td>
								</tr>
								@endif
								<tr>
										<td colspan="4" class="text-right">Grand TOTAL : </td>
										<td class="text-left">{{ $order->total }}</td>
								</tr>
								<tr>
										<td colspan="4" class="text-right">Payment : </td>
										<td class="text-left">{{ $order->pay }}</td>
								</tr>
								@if($order->due > 0)
								<tr>
										<td colspan="4" class="text-right">Due : </td>
										<td class="text-left">{{ $order->due}}</td>
								</tr>
								@php exit;@endphp
								@endif
								<tr>
										<td colspan="4" class="text-right">Change Amount : </td>
										<td class="text-left">{{ $order->returnAmount }}</td>
								</tr>
						</tfoot>
				</table>
		</div>

		<div class="invoice-footer">
				Thank you for shopping at Stock Genie.
		</div>
	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
