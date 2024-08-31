<!-- Modal -->
<div id="finalInvoice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
	style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="invoice" style="display: flex;justify-content: space-between; align-items: center;">
					<h4 class="modal-title text-info">Final Invoice </h4>
					<h4 class="modal-title text-info">Total: {{ Cart::total() }}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				</div>
				@if(Cart::total()==0)
				<span class="text-danger fs-2 ">Add Product for Create Invoice</span>
				@else
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
									<option value="Cash">Cash</option>
									<option value="Bank">Bank</option>
								</select>
								<span class='text-danger fs-bolder'>@error('payment_status'){{ $message }} @enderror</span>
							</div>
							<div class="col-md-4">
								<label for="pay">Cash</label>
								<input type="number" name="pay" id="pay" value="0" class="form-control" step="0.01">
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

					<input type="hidden" name="order_date" value="{{ date('d-m-y') }}">
					<input type="hidden" name="order_month" value="{{ date('F') }}">
					<input type="hidden" name="order_year" value="{{ date('Y') }}">
					<input type="hidden" name="order_status" value="success">

					<input type="hidden" name="total_products" value="{{ Cart::count() }}">
					<input type="hidden" name="sub_total" value="{{ Cart::subtotal() }}">
					<input type="hidden" name="vat" value="{{ Cart::tax() }}">
					<input type="hidden" name="total" id='total' value="{{ Cart::total() }}">
					<div class="modal-footer">
						<button type="button" class="btn btn-danger  waves-effect waves-light " data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary  waves-effect waves-light ">Print Invoice</button>
					</div>
				</form>
				@endif
			</div>
		</div>
	</div>
</div>

<script>
	function calculateCashDue() {
		let paymentAmount = parseFloat(document.getElementById('pay').value) || 0;
		let totalAmount = parseFloat(document.getElementById('total').value.replace(/,/g, '')) || 0;
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