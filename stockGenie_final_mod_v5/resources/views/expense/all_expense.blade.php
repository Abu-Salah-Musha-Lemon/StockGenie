@extends('layouts.layout')
@section('main')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success text-info">

			<div class="panel-heading ">

				<div class="div" style="display: flex;justify-content: space-between;">

					<h3 class="panel-title">All Expense</h3>
					<a class="btn btn-info" href="{{URL::to('/add-expense')}}" value="This Month">
						<i class="md md-attach-money" style="font-size:24px;color:white;font-weight:800;"></i>
					</a>

				</div>

				<div class="div" style="display: flex;justify-content: space-between;">

					<h3 class="btn btn-info"><a class="panel-title fs-4" href="{{URL::to('/today-expense')}}" value="Today">Today
							Expense</h3>
					<h3 class="btn btn-warning"><a class="panel-title fs-4" href="{{URL::to('/today-expense')}}"
							value="Today">Monthly Expense</h3>
					<h3 class="btn btn-danger"><a class="panel-title fs-4" href="{{route('yearlyExpense')}}" value="Today">Yearly
							Expense</h3>
							
				</div>

			</div>
			<div class="panel-body">
				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="dataTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Expense Details</th>
										<th>Expense Amount</th>
										<th>Expense Date</th>
										<th>Expense Month</th>
										<th>Expense Year</th>
										<th>Action</th>
									</tr>
								</thead>
								@foreach($view as $row)
								<tr>
									<td>{{$row->details}}</td>
									<td>{{$row->amount}}</td>
									<td>{{$row->date}}</td>
									<td>{{$row->month}}</td>
									<td>{{$row->year}}</td>
									<td>
										<a href="{{URL::to('/edit-expense/'.$row->id)}}" class="btn btn-info btn-custom"><i
												class="fa fa-pencil-square-o fs-2"></i></a>
										<!-- <a href="{{URL::to('/delete-expense/'.$row->id)}}" class="btn btn-sm btn-danger"id="delete">Delete</a> -->
										<!-- <a href="{{URL::to('/view-expense/'.$row->id)}}" class="btn btn-sm btn-primary">view</a> -->
									</td>
								</tr>
								@endforeach

								<tbody>

								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
</div>


@endsection