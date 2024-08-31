<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invoice</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
		@font-face {
			font-family: 'Nikosh';
			src: url('{{ storage_path(' fonts/Nikosh.ttf') }}') format('truetype');
			src: url('{{ public_path(' fonts/Nikosh.ttf') }}') format('truetype');
			font-family: 'SolaimanLipi';
			src: url('{{ storage_path(' fonts/SolaimanLipi.ttf') }}') format('truetype');
			src: url('{{ public_path(' fonts/SolaimanLipi.ttf') }}') format('truetype');
		}

		body {
			font-family: 'Nikosh', sans-serif;
			font-family: 'SolaimanLipi', sans-serif;
		}

		body {
			margin: 10px;
			font-family: Arial, sans-serif;
		}

		.invoice-container {
			background: #fff;
			padding: 20px;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
		}

		/* .invoice-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
		} */

		.invoice-header img {
			max-width: 150px;
		}

		.invoice-header h2 {
			margin: 0;
			color: #007bff;
		}

		.invoice-header .order-details {
			text-align: right;
			font-size:12px;
		}

		.invoice-header .billing-info {
			text-align: left;
			font-size:12px;
		}

		.order-details h3,
		.order-details p {
			margin: 0;
		}

		.invoice-body {
			margin-top: 1px;
		}

		.invoice-body h5 {
			margin-bottom: 20px;
		}
		.invoice-body table thead {
			font-size:17px;
			font-weight: 100;
		}
		.invoice-body table tbody tr {
			font-size:14px;
		}

		.table thead th{
			border-bottom: 2px solid #dee2e6;
			font-weight: 100;
		}
		
		.invoice-footer {
			display: flex;
			justify-content: space-between;
			margin-top: 20px;
		}

		/* .invoice-footer .billing-info,
		.invoice-footer .payment-info {
			width: 30%;
		} */

		.invoice-footer h5 {
			margin-bottom: 10px;
		}

		@media print {
			@page {
				size: A4;
				/* Set page size to A4 */
				margin: 20mm;
				/* Adjust the margin as needed */
			}

			body {
				-webkit-print-color-adjust: exact;
				/* Chrome, Safari */
				color-adjust: exact;
				/* Firefox */
			}

			.print-hide {
				display: none;
				/* Hide elements with this class in print view */
			}

			.container {
				width: 100%;
				padding: 0;
			}
		}
	</style>
</head>

<body>
	<div class="container invoice-container shadow-sm">
		<div class="invoice-header shadow-sm">
			<table>
				<tr>
					<td style="width:45mm">
						<div class="billing-info">
							<img src="{{public_path('images/logo/StockGenie.png')}}" style="width: 70px; height: 70px; padding: 6px;aline-items:center;justify-content:center;">
							<p>Hello, Stock Genie.</p>
							<b>BILLING INFORMATION</b>
							<p>ASML Lts.<br>312 Madison Ave.<br>Dhaka -1204<br>Bangladesh</p>
						</div>

					</td>

					<td style="width:45mm">
						<div class="order-details">
							<h2>Invoice</h2>
							<h3>ORDER #{{ $order->id }}</h3>
							<?php
					// Original date string
					$order_date = $order->order_date;

					// Create a DateTime object from the original date string
					$date = DateTime::createFromFormat('d-m-y', $order_date);

					// Format the date to the desired output
					$formatted_date = $date->format(' F d Y');

					//echo $formatted_date; // Output:  June 24 2024
					?>
							<p>{{$formatted_date }}</p>

							<b>PAYMENT INFORMATION</b>
							<p>{{$order->payment_status}}<br>
						</div>
					</td>
				</tr>
			</table>

		</div>
		<div class="invoice-body">
			<table class="table table-sm" style="width:90mm">
				<thead>
					<tr class="text-center">
						<th>#</th>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Unit Cost</th>
						<th class="text-left">Total</th>
					</tr>
				</thead>
				<tbody>
					@php $sl=1; @endphp
					@foreach($orderDetails as $row)
					<tr class="text-center">
						<td>{{$sl++}}</td>
						<td>{{$row->product_name}}</td>
						<td>{{$row->quantity}}</td>
						<td>{{$row->unitCost}} </td>
						<td class="text-left">
							{{$row->quantity*$row->unitCost}}
						</td>
					</tr>
					@endforeach

				</tbody>
				<tfoot style="font-size: 12px; font-weight: 100;">
					<tr>
						<td colspan="4" class="text-right"><strong>SUBTOTAL</strong></td>
						<td class="text-left">{{$order->sub_total}} </td>
					</tr>
					<tr>
						<td colspan="4" class="text-right"><strong>Qty</strong></td>
						<td class="text-left">{{$order->total_products}}</td>
					</tr>
					@if($order->vat>0)
					<tr>
						<td colspan="4" class="text-right"><strong>TAX (10%)</strong></td>
						<td class="text-left">{{$order->vat}} </td>
					</tr>
					@endif
					<tr>
						<td colspan="4" class="text-right"><strong>Grand TOTAL</strong></td>
						<td class="text-left"><strong>{{$order->total}} </strong></td>
					</tr>
					<tr>
						<td colspan="4" class="text-right">Payment</td>
						<td class="text-left">{{$order->pay}} </td>
					</tr>
					@if($order->due > 0)
					<tr>
						<td colspan="4" class="text-right">Due</td>
						<td class="text-left">{{$order->due}} </td>
					</tr>
					@endif
					<tr>
						<td colspan="4" class="text-right"><strong>Change Amount</strong></td>
						<td class="text-left"><strong>{{$order->returnAmount}} </strong></td>
					</tr>
				</tfoot>
			</table>
		</div>

		<div class="invoice-footer">
			Thank for shopping at Stock Genie.
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>