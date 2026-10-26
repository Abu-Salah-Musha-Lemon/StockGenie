@extends('layouts.layout')
@section('main')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info">

			<div class="panel-heading" style="display: flex;justify-content: space-between;">
				<div>
					<h3 class="panel-title">All Pending Sales</h3>
				</div>
			</div>

			<div class="panel-body">
				<div class="table-responsive">
					<table id="dataTable" class="table table-striped table-bordered">

						<thead>
							<tr>
								<th>Sale Date</th>
								<th>Total Items</th>
								<th>Payment Status</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							@foreach($pending->reverse() as $row)

							@php
								$totalItems = DB::table('sales_items')
									->where('sale_id', $row->id)
									->sum('qty');
							@endphp

							<tr>
								<td>{{ $row->sale_date }}</td>
								<td>{{ $totalItems }}</td>

								<td>
									<span class="label label-warning">
										{{ $row->payment_status }}
									</span>
								</td>

								<td>
									<a href="{{ URL::to('/view-order/'.$row->id) }}"
										class="btn btn-info btn-sm">
										View
									</a>
								</td>
							</tr>

							@endforeach
						</tbody>

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
		'Sale Date',
		'Total Items',
		'Payment Status',
		'Action'
	]);
});
</script>
@endsection