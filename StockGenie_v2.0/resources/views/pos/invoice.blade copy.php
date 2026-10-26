@extends('layouts.layout')

@section('main')

<style>
	label { width: auto; }
</style>

<!-- ================= FINAL INVOICE MODAL ================= -->
<div id="finalInvoice" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<div style="display:flex; justify-content:space-between; width:100%;">
					<h4 class="modal-title text-info">Final Invoice</h4>
					<h4 class="modal-title text-info">
						Total: {{ number_format(Cart::total(), 2) }}
					</h4>
				</div>
			</div>

			<form action="{{ URL::to('/final-invoice') }}" method="POST">
				@csrf

				<div class="modal-body">
					<div class="row">

						<!-- Payment Method -->
						<div class="col-md-4">
							<label>Payment Method</label>
							<select name="payment_status" class="form-control">
								<option value="cash">Cash</option>
								<option value="bank">Bank</option>
								<option value="check">Check</option>
							</select>
						</div>

						<!-- Paid Amount -->
						<div class="col-md-4">
							<label>Paid Amount</label>
							<input type="number" name="paid_amount" id="pay" class="form-control" step="0.01">
						</div>

						<!-- Due -->
						<div class="col-md-4">
							<label>Due</label>
							<input type="number" name="due" id="due" class="form-control" readonly>
						</div>

						<!-- Return -->
						<div class="col-md-4">
							<label>Return</label>
							<input type="number" name="return_amount" id="returnAmount" class="form-control" readonly>
						</div>

					</div>
				</div>

				<!-- ================= NEW SALES TABLE FIELDS ================= -->
				<input type="hidden" name="sale_date" value="{{ now() }}">
				<input type="hidden" name="subtotal" value="{{ Cart::subtotal() }}">
				<input type="hidden" name="tax" value="{{ Cart::tax() }}">
				<input type="hidden" name="grand_total" value="{{ Cart::total() }}">
				<input type="hidden" name="total_items" value="{{ Cart::count() }}">

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Confirm Sale</button>
				</div>

			</form>

		</div>
	</div>
</div>

<!-- ================= INVOICE VIEW ================= -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">

			<div class="panel-body" id="invoice">

				<div class="clearfix">
					<div class="pull-left">
						<img src="{{ asset('images/logo/StockGenie.png') }}" style="width:70px;">
					</div>
					<div class="pull-right">
						<h4>Invoice</h4>
						<strong>{{ date('d M Y') }}</strong>
					</div>
				</div>

				<hr>

				<!-- ================= ITEMS TABLE ================= -->
				<div class="table-responsive">
					<table class="table">

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
							@php $sl = 1; @endphp

							@foreach(Cart::content() as $row)
							<tr>
								<td>{{ $sl++ }}</td>
								<td>{{ $row->name }}</td>
								<td>{{ $row->qty }}</td>
								<td>{{ number_format($row->price, 2) }}</td>
								<td>{{ number_format($row->price * $row->qty, 2) }}</td>
							</tr>
							@endforeach
						</tbody>

					</table>
				</div>

				<!-- ================= TOTAL SUMMARY ================= -->
				<div style="text-align:right; margin-top:20px;">

					<p>Subtotal: {{ number_format(Cart::subtotal(), 2) }}</p>
					<p>Tax: {{ number_format(Cart::tax(), 2) }}</p>
					<p>Total Items: {{ Cart::count() }}</p>

					<hr>

					<h3>Total: {{ number_format(Cart::total(), 2) }}</h3>

				</div>

				<!-- ================= ACTION BUTTON ================= -->
				<div style="text-align:right; margin-top:20px;">
					<button class="btn btn-primary" data-toggle="modal" data-target="#finalInvoice">
						Submit Sale
					</button>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- ================= CASH CALCULATION SCRIPT ================= -->
<script>
function calculateCash() {
	let paid = parseFloat(document.getElementById('pay').value) || 0;
	let total = parseFloat('{{ Cart::total() }}'.replace(/,/g, '')) || 0;

	let due = total - paid;
	let returnAmount = 0;

	if (due < 0) {
		returnAmount = Math.abs(due);
		due = 0;
	}

	document.getElementById('due').value = due.toFixed(2);
	document.getElementById('returnAmount').value = returnAmount.toFixed(2);
}

document.getElementById('pay').addEventListener('input', calculateCash);
</script>

@endsection