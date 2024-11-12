@extends('layouts.layout')
@section('main')

<style>
	label {
		width: auto;
	}
</style>

<!-- modal -->
<div id="finalInvoice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
	style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="invoice" style="display: flex; justify-content: space-between;">
					<h4 class="modal-title text-info">Final Invoice </span></h4>
					<h4 class="modal-title text-info">Total: {{ number_format(Cart::total(), 0) }}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> <br>
				</div>

				<form role="form" action="{{ URL::to('/final-invoice/') }}" method="GET">
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
									<option value="HandCase">HandCase</option>
									<option value="Bank">Bank</option>
									<option value="Check">Check</option>
								</select>
								<span class='text-danger fs-bolder'>@error('payment_status'){{ $message }} @enderror</span>
							</div>
							<div class="col-md-4">
								<label for="pay">Cash</label>
								<input type="number" name="pay" id="pay" class="form-control" step="0.01">
								<span class='text-danger fs-bolder'>@error('pay'){{ $message }} @enderror</span>
							</div>
							<div class="col-md-4">
								<label for="cashDue">Cash Due</label>
								<input type="number" id="due" name="due" class="form-control" step="0.01" readonly>
								<span class="text-danger fs-bolder">@error('due'){{ $message }} @enderror</span>
							</div>
							<div class="col-md-4">
								<label for="returnAmount">Return Amount</label>
								<input type="number" id="returnAmount" name="returnAmount" class="form-control" step="0.01" readonly>
							</div>
						</div>
					</div>

					<input type="hidden" name="order_date" value="{{ date('d-m-y') }}" step="1">
					<input type="hidden" name="order_month" value="{{ date('F') }}" step="1">
					<input type="hidden" name="order_year" value="{{ date('Y') }}" step="1">
					<input type="hidden" name="order_status" value="pending">

					<input type="hidden" name="total_products" value="{{ Cart::count() }}" step="1">
					<input type="hidden" name="sub_total" value="{{ number_format(Cart::subtotal(), 0) }}" step="1">
					<input type="hidden" name="vat" value="{{ number_format(Cart::tax(), 0) }}" step="1">
					<input type="hidden" name="total" value="{{ number_format(Cart::total(), 0) }}" step="1">
					<div class="modal-footer">
						<button type="button" class="btn btn-danger w-md waves-effect waves-light w-sm"
							data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary w-md waves-effect waves-light w-sm">Print Invoice</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<!-- /.modal -->

<script>
	function calculateCashDue() {
		let paymentAmount = parseFloat(document.getElementById('pay').value) || 0;
		let totalAmount = parseFloat('{{ Cart::total() }}'.replace(/,/g, '')) || 0;
		let cashDue = totalAmount - paymentAmount;
		let returnAmount = 0.00;

		if (cashDue < 0) {
			returnAmount = Math.abs(cashDue);
			cashDue = 0.00;
		}

		document.getElementById('due').value = cashDue.toFixed(2);
		document.getElementById('returnAmount').value = returnAmount.toFixed(2);
	}

	document.getElementById('pay').addEventListener('input', calculateCashDue);

	calculateCashDue();
</script>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body" id='invoice'>
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-right"><img src="{{asset('images/logo/StockGenie.png')}}" alt="Stock Genie"
								style="width: 70px; height: 70px; padding: 6px;"></h4>
					</div>
					<div class="pull-right">
						<h4>Invoice <br>
							<strong>{{ date('d D M Y') }}</strong>
						</h4>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="pull-left m-t-30">
							<address>
								<!-- Customer address here -->
							</address>
						</div>
						<div class="pull-right m-t-30">
							<p><strong>Order Date: </strong>{{ date('d M Y') }}</p>
							<p class="m-t-10"><strong>Order Status: </strong> <span class="label label-pink">Pending</span></p>
							<p class="m-t-10"><strong>Order ID: </strong> #123456</p>
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
									@php
									$sl = 1;
									@endphp
									@foreach($cart as $row)
									<tr>
										<td>{{ $sl++ }}</td>
										<td>{{ $row->name }}</td>
										<td>{{ $row->qty }}</td>
										<td>{{ $row->price }}</td>
										<td>{{ $row->price * $row->qty }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row" style="border-radius: 0px;">
					<div class="col-md-3 col-md-offset-9">
						<p class="text-right"><b>Sub-total:</b> {{ number_format(Cart::subtotal(), 0) }} ৳</p>
						<p class="text-right">Total Qty: {{ Cart::count() }}</p>
						<p class="text-right">VAT: {{ number_format(Cart::tax(), 0) }}</p>
						<hr>
						<h3 class="text-right">Total : {{ number_format(Cart::total(), 0) }}</h3>
					</div>
				</div>
				<hr>
				<div class="hidden-print">
					<div class="pull-right">
						<a href="#" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
							data-target="#finalInvoice">Submit</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
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

	document.getElementById('printPi').addEventListener('click', function () {
		printElement('invoice');
	});
</script>

@endsection