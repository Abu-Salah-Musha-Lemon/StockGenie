@extends('layouts.layout')
@section('main')


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title">Today Expense</h3>
				<h3 class="btn btn-info"><a class="panel-title fs-4" href="{{URL::to('/today-paid')}}" value="Today">Today Paid
						Details</h3>
				<h3 class="btn btn-warning"><a class="panel-title fs-4" href="{{URL::to('/monthly-paid')}}"
						value="monthly">Monthly Paid Details</h3>
				<h3 class="btn btn-danger"><a class="panel-title fs-4" href="{{URL::to('/yearly-paid')}}" value="">Yearly Paid
						Details</h3>

				@php
				$date = date("d/m/y");
				$total = DB::table('orders')->where('date',$date)->sum('total');
				@endphp

				<a class="panel-title fs-4" href="{{URL::to('/add-expense')}}">
					<i class="bi bi-bag-plus-fill" style="font-size:24px;color:white;font-weight:800;"></i>
				</a>
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
										<!-- <th>Expense Date</th>
                                                <th>Expense Month</th>
                                                <th>Expense Year</th>-->
										<th>Action</th>
									</tr>
								</thead>


								<tbody>
									@foreach($today as $row)
									<tr>
										<td>{{$row->details}}</td>
										<td>{{$row->amount}}</td>
									<!-- <td>{{$row->date}}</td>
											<td>{{$row->month}}</td>
											<td>{{$row->year}}</td> -->
										<td>
											<a href="{{URL::to('/edit-expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
											<a href="{{URL::to('/delete-expense/'.$row->id)}}" class="btn btn-sm btn-danger"
												id="delete">Delete</a>
											<!-- <a href="{{URL::to('/view-expense/'.$row->id)}}" class="btn btn-sm btn-primary">view</a> -->
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
</div>

@endsection