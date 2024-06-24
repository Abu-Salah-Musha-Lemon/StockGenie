<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invoice</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.invoice-title {
			margin-top: 20px;
		}

		.table>tbody>tr>.no-line {
			border-top: none;
		}

		.table>thead>tr>.no-line {
			border-bottom: none;
		}

		.table>tbody>tr {}

		.line {
			border-top: none;
			border-bottom: 1px solid;

		}
		@media print {
            @page {
                size: A4; /* Set page size to A4 */
                margin: 20mm; /* Adjust the margin as needed */
            }
            body {
                -webkit-print-color-adjust: exact; /* Chrome, Safari */
                color-adjust: exact; /* Firefox */
            }
            .print-hide {
                display: none; /* Hide elements with this class in print view */
            }
            .container {
                width: 100%;
                padding: 0;
            }
        }
	</style>
</head>

<body>
	<div class="container-fluid">
	<div class="container shadow my-2">
		<div class="row">
			<div class="col-12">
				<div class="invoice-title">
					<h2>Invoice</h2>
					<h3 class="pull-right">Order # {{ $order->id }}</h3>
				</div>
				<hr>
				<div class="row">
					<div class="col-6">
						<address>
							<strong>Billed To:</strong><br>
							Stock Genie<br>
							312 hazi lalmia ,<br>
							Dhaka - 1204<br>
							
						</address>
					</div>
					<!-- <div class="col-6 text-right">
						<address>
							<strong>Shipped To:</strong><br>
							Jane Smith<br>
							1234 Main<br>
							Apt. 4B<br>
							Springfield, ST 54321
						</address>
					</div> -->
				</div>
				<div class="row">
					<div class="col-6">
						<address>
							<strong>Payment Method: {{$order->payment_status}}</strong><br>
							
							<!-- johnsmith@email.com -->
						</address>
					</div>
					<div class="col-6 text-right">
						<address>
							<strong>Order Date:</strong><br>
							{{ $order->order_date }}<br><br>
						</address>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><strong>Order summary</strong></h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr class="text-center">
										<td><strong>#</strong></td>
										<td><strong>Item</strong></td>
										<td><strong>Price</strong></td>
										<td><strong>Quantity</strong></td>
										<td><strong>Totals</strong></td>
									</tr>
								</thead>
								<tbody>

									@php $sl=1; @endphp
									@foreach($orderDetails as $row)
									<tr class="text-center">
										<td>{{$sl++}}</td>
										<td>{{$row->product_name}}</td>
										<td>{{$row->unitCost}}</td>
										<td>{{$row->quantity}}</td>
										<td>
											{{$row->quantity*$row->unitCost}}
										</td>
									</tr>
									@endforeach



								</tbody>
								<tfoot border="none">
									<tr>

										<td colspan="3" class="no-line"></td>
										<td class="no-line text-right"><strong>Subtotal</strong></td>
										<td class="no-line text-center">{{ $order->sub_total }} ৳</td>
									</tr>
									<tr>

										<td colspan="3" class="no-line"></td>
										<td class="no-line text-right"><strong>Total Qty:</strong></td>
										<td class="no-line text-center">{{$order->total_products}}</td>
									</tr>
									<tr>

										<td colspan="3" class="no-line"></td>
										<td class="no-line text-right"><strong>Vat</strong></td>
										<td class="no-line text-center">{{ $order->vat }} ৳</td>
									</tr>
									<tr>

										<td colspan="3" class="no-line"></td>
										<td class="line text-right"><strong>Grand Total :</strong></td>
										<td class="line text-center">{{$order->total}} ৳</td>
									</tr>

			
									<tr>

										<td colspan="3" class="no-line"></td>
										<td class="no-line text-right"><strong>Payment:</strong></td>
										<td class="no-line text-center">{{$order->pay}} ৳ </td>
									</tr>
									<tr>

										<td colspan="3" class="no-line"></td>
										<td class="no-line text-right"><strong>Due:</strong></td>
										<td class="no-line text-center">{{$order->due}} ৳</td>
									</tr>
									<tr>

										<td colspan="3" class="no-line"></td>
										<td class="no-line text-right"><strong>Return Amount:</strong></td>
										<td class="no-line text-center">{{$order->returnAmount}} ৳</td>
									</tr>

								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

