@extends('layouts.layout')
@section('main')

<style>
	label {
		width: auto;
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
	}
</style>

<!-- modal -->
<div id="due" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
	style="display: none">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					X
				</button>
				<br />
				<h4 class="modal-title text-info">
					Due <span style="float: right">Due: {{$order->due}}</span>
				</h4>

			</div>
			<form role="form" action="{{ URL::to('/due-pay/'.$order->id) }}" method="HEAD">
				@csrf
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<label for="payment_status">Payment Method</label>
							@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
							<select name="payment_status" class="form-control">
								<!-- <option value="">Select</option> -->
								<option value="HandCase">HandCase</option>
								<option value="Bank">Bank</option>
								<option value="Check">Check</option>
							</select>
							<span class="text-danger fs-bolder">@error('payment_status'){{ $message }}
								@enderror</span>
						</div>
						<div class="col-md-4">
							<label for="pay">Case</label>
							<input type="number" name="pay" id="pay" class="form-control" step="0.01" />
							<span class="text-danger fs-bolder">@error('pay'){{ $message }} @enderror</span>
						</div>

						<div class="col-md-4">
							<label for="cashDue">Cash Due</label>
							<input type="number" id="dueNew" name="due" class="form-control" step="0.01" />
						</div>
						<div class="col-md-4">
							<label for="returnAmount">Return Amount</label>
							<input type="number" id="returnAmount" name="returnAmount" class="form-control" step="0.01" readonly />
						</div>
					</div>
				</div>
				<input type="hidden" name="" id="oldDue" value="{{$order->due}}" step="0.01" />
				<input type="hidden" name="id" id="id" value="{{$order->id}}" step="0.01" />
				<div class="modal-footer">
					<button type="reset" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">
						Close
					</button>
					<button type="submit" class="btn btn-success waves-effect waves-light">
						Submit
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal -->
<script>
	function calculateCashDue() {
		let paymentAmount =
			parseFloat(document.getElementById("pay").value) || 0;
		let totalAmount =
			parseFloat(
				document.getElementById("oldDue").value.replace(/,/g, "")
			) || 0;

		let cashDue = totalAmount - paymentAmount;
		let returnAmount = 0;

		if (cashDue < 0) {
			returnAmount = Math.abs(cashDue);
			cashDue = 0;
		}

		document.getElementById("dueNew").value = cashDue.toFixed(2);
		document.getElementById("returnAmount").value = returnAmount.toFixed(2);
	}

	document.getElementById("pay").addEventListener("input", calculateCashDue);

	calculateCashDue(); // This line should be placed after adding the event listener
</script>

<div class="row">
	<!-- Basic example -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-defautl">
			<div class="panel-heading ">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-right">
							<h4 class="text-right"><img src="{{asset('images/logo/StockGenie.png')}}" alt="Stock Genie"
									style="width: 70px; height: 70px; padding: 6px;"></h4>
						</h4>
					</div>

					<div class="pull-right">
						<h4>
							Invoice # <br />
							@if($order->order_status=='success')
							<strong>{{$order->order_date}}</strong>
							@else
							<strong>{{date('d D M Y')}}</strong>
							@endif
						</h4>
					</div>
				</div>
				<hr />
				
			</div>

			<div class="panel-body" id="invoice">

				<div class="row">
					<div class="col-md-12">
						<div style="display:flex;justify-content:space-between;align-item:center">
							<div class="pull-left m-t-30">

								<address>

								</address>
							</div>
							<div class="pull-center m-t-30">
								<h4 class="text-center"><img src="{{asset('images/logo/StockGenie.png')}}" alt="Stock Genie"
										style="width: 70px; height: 70px; padding: 6px;"></h4>
								</h4>
							</div>
							<div class="pull-right m-t-30">
								<p>
									<strong>Order Date: </strong>{{$order->order_date}}
								</p>
								<p class="m-t-10">
									<strong>Order Status: </strong>
									@if($order->order_status == 'success' && $order->due > 0)
									<span class="label label-success">Success</span>
									<span class="label label-warning">Due</span>
									@elseif($order->order_status == 'success' && $order->due == 0)
									<span class="label label-success">Success</span>
									@else
									<span class="label label-pink">Pending</span>
									@endif
								</p>
								<p class="m-t-10">
									<strong>Order ID: </strong> {{$order->id}}
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="m-h-50"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table m-t-30">
								<thead>
									<tr>
										<th>#</th>
										<th>Item</th>

										<th>Quantity</th>
										<th>Unit Cost</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									@php $sl=1; @endphp
									@foreach($orderDetails as $row)
									<tr>
										<td>{{$sl++}}</td>
										<td>{{$row->product_name}}</td>
										<td>{{$row->quantity}}</td>
										<td>{{$row->unitCost}} ৳</td>
										<td>
											{{$row->quantity*$row->unitCost}} ৳
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="row" style="border-radius: 0px">
					<div class="col-md-3"></div>
					<div class="col-md-3 col-md-offset-9">
						<p class="text-right">
							<b>Sub-total:</b> {{$order->sub_total}} ৳
						</p>
						<!-- <p class="text-right">Discout: 12.9%</p> -->
						<p class="text-right">
							Total Qty: {{$order->total_products}}
						</p>
						<p class="text-right">Tax: {{$order->vat}} ৳</p>
						<hr />
						<h4 class="text-right">
							Grand Total : {{$order->total}} ৳
						</h4>
						<hr />
						<p class="text-right">
							<b>Payment Method:</b> {{$order->payment_status}}
						</p>
						<p class="text-right">
							<b>Payment:</b> {{$order->pay}} ৳
						</p>
						<p class="text-right"><b>Due:</b> {{$order->due}} ৳</p>
						<hr />
						<h4 class="text-right">
							<b>Return :</b> {{$order->returnAmount}} ৳
						</h4>
					</div>
				</div>
				<hr />

				<div class="hidden-print">
					<div class="pull-right">

						@if($order->order_status == 'success' && $order->due >0.00)

						<a href="{{URL::to('/download-invoice/'.$order->id)}}"
								class="btn btn-success  waves-effect waves-light"><i class="bi bi-printer"></i>
						</a>

						<button type="submit" class="btn btn-inverse waves-effect waves-light" id="printPi">
							<i class="fa fa-print"></i>
						</button>

						<a href="#" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#due">Due</a>

						@elseif($order->order_status == 'success' && $order->due== 0.00)

						<a href="{{URL::to('/download-invoice/'.$order->id)}}"
								class="btn btn-success  waves-effect waves-light"><i class="bi bi-printer"></i>
						</a>

						<button type="submit" class="btn btn-inverse waves-effect waves-light" id="printPi">
							<i class="fa fa-print"></i>
						</button>

						@else
						<a href="#" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#due">Due</a>
						<a href="{{ URL::to('/paid/'.$order->id) }}" class="btn btn-primary waves-effect waves-light">Submit</a>
						@endif
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<style>
	@media print {
		@page {
			size: A4;
			/* Set page size to A4 */
			margin: 20mm;
			/* Adjust the margin as needed */
		}

		body * {
			visibility: hidden;
		}

		#invoice,
		#invoice * {
			visibility: visible;
		}

		#invoice {
			position: absolute;
			left: 0;
			top: 0;
			width: 210mm;
			/* Set the desired width (e.g., A4 size) */
			height: 297mm;
			/* Set the desired height (e.g., A4 size) */
			margin: 0;
			padding: 20mm;
			/* Add padding if needed */
			box-sizing: border-box;
		}
	}
</style>

<script>
	// Custom print function
	function printElement(elementId) {
		let element = document.getElementById(elementId);
		if (element) {
			let body = document.body.innerHTML;
			let content = element.innerHTML;
			document.body.innerHTML = content;
			window.print();
			document.body.innerHTML = body;
		} else {
			console.error("Element with ID '" + elementId + "' not found.");
		}
	}

	document.getElementById("printPi").addEventListener("click", function () {
		printElement("invoice"); // Change 'element1' to the ID of the element you want to print
	});
</script>

@endsection