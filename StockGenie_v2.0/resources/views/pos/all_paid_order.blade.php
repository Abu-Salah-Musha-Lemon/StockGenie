@extends('layouts.layout')
@section('main')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success text-info">

			<div class="panel-heading" style="display: flex;justify-content: space-between;">
				<div>
					<h3 class="panel-title">All Paid Sales</h3>
				</div>

				<a class="fs-4" href="{{ URL::to('/pos') }}">
					<i class="bi bi-bag-plus-fill" style="font-size:24px;color:white;font-weight:800;"></i>
				</a>
			</div>

			<div class="panel-body">
				<div class="table-responsive">
					<table id="dataTable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>SL</th>
								<th>Sale ID</th>
								<th>Sale Date</th>
								<th>Total Items</th>
								<th>Grand Total</th>
								<th>Payment Status</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							@php $sl = 1; @endphp

							@foreach($success->reverse() as $row)

							@php
								$totalItems = DB::table('sales_items')
									->where('sale_id', $row->id)
									->sum('qty');
							@endphp

							<tr>
								<td>{{ $sl++ }}</td>
								<td>{{ $row->id }}</td>
								<td>{{ $row->sale_date }}</td>
								<td>{{ $totalItems }}</td>
								<td>{{ number_format($row->grand_total, 2) }}</td>
								<td>
									<span class="label label-success">
										{{ $row->payment_status }}
									</span>
								</td>

								<td>
									<a href="{{ URL::to('/view-order/'.$row->id) }}"
										class="btn btn-info">
										<i class="bi bi-eye"></i>
									</a>

									<a href="{{ URL::to('/download-invoice/'.$row->id) }}"
										class="btn btn-success">
										<i class="bi bi-printer"></i>
									</a>
								</td>
							</tr>

							@endforeach
						</tbody>

						<tfoot>
							<tr>
								<td colspan="4">Total Sales:</td>
								<td>
									@php
										$total = DB::table('sales')->sum('grand_total');
										echo number_format($total, 2);
									@endphp
								</td>
								<td colspan="2"></td>
							</tr>
						</tfoot>

					</table>
				</div>
			</div>

		</div>
	</div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function () {
	initializeDataTable([
		'Sale ID',
		'Sale Date',
		'Total Items',
		'Grand Total'
	]);
});
</script>
@endsection