@extends('layouts.layout')

@section('main')

<div class="row">
	<div class="col-md-12">

		<div class="panel panel-success">

			<div class="panel-heading" style="display:flex; justify-content:space-between; align-items:center;">

				<h3 class="panel-title">Today Expense</h3>

				<div style="display:flex; gap:10px;">

					<a class="btn btn-info" href="{{ URL::to('/today-paid') }}">
						Today Paid Details
					</a>

					<a class="btn btn-warning" href="{{ URL::to('/monthly-paid') }}">
						Monthly Paid Details
					</a>

					<a class="btn btn-danger" href="{{ URL::to('/yearly-paid') }}">
						Yearly Paid Details
					</a>

				</div>

				<a href="{{ URL::to('/add-expense') }}">
					<i class="bi bi-bag-plus-fill" style="font-size:24px;color:white;"></i>
				</a>

			</div>

			<div class="panel-body">

				<div class="table-responsive">

					<table id="dataTable" class="table table-striped table-bordered">

						<thead>
							<tr>
								<th>Expense Details</th>
								<th>Expense Amount</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							@foreach($today as $row)
							<tr>
								<td>{{ $row->details }}</td>
								<td>{{ number_format($row->amount, 2) }}</td>

								<td>
									<a href="{{ URL::to('/edit-expense/'.$row->id) }}" class="btn btn-sm btn-info">
										Edit
									</a>

									<a href="{{ URL::to('/delete-expense/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">
										Delete
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>

						<tfoot>
							<tr>
								<td><strong>Total:</strong></td>
								<td>
									<strong>{{ number_format($total, 2) }}</strong>
								</td>
								<td></td>
							</tr>
						</tfoot>

					</table>

				</div>

			</div>

		</div>

	</div>
</div>

@endsection