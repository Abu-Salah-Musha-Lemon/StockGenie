@extends('layouts.layout')
@section('main')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success">

			<div class="panel-heading ">

				<div class="top mx-2" style="display: flex;justify-content: space-between; align-items:center">
					<h3 class="panel-title text-white">Today Expense</h3>
					<a class="panel-title fs- btn btn-purple" href="{{URL::to('/add-expense')}}">
						<i class="bi bi-bag-plus-fill" style="font-size:24px;color:white;font-weight:800;"></i>
					</a>
				</div>

				<div class="div" style="display: flex;justify-content: space-between; align-items:center">

					<a class="panel-title fs-4 btn btn-primary" href="{{URL::to('/today-expense')}}" value="Today">Today
						Expense</a>
					<a class="panel-title fs-4 btn btn-warning" href="{{URL::to('/monthly-expense')}}" value="Monthly">Monthly
						Expense</a>
					<a class="panel-title fs-4 btn btn-info" href="{{route('yearlyExpense')}}" value="Yearly">Yearly
						Expense</a>



				</div>

			</div>
			<div class="panel-body">
				<div class="row">
				@php
								$date = date("d/m/y");
								$total = DB::table('expenses')->where('date',$date)->sum('amount');
								@endphp
					<div class="col-md-12 col-sm-12 col-xs-12">
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
										<td>{{$row->details}}</td>
										<td>{{$row->amount}}</td>
										<td>
											<a href="{{URL::to('/edit-expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
											<a href="{{URL::to('/delete-expense/'.$row->id)}}" class="btn btn-sm btn-danger"
												id="delete">Delete</a>
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<td>Total:</td>
										<td>Total: {{$total}}</td>
									</tr>
								</tfoot>
							</table>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	@endsection