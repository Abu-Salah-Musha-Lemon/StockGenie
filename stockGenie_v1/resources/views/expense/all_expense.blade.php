@extends('layouts.layout')
@section('main')

		<div class="row">
				<div class="col-md-12">
						<div class="panel panel-success text-info">
								
						<div class="panel-heading " style="display: flex;justify-content: space-between;">
										<div class="div">
										<h3 class="panel-title">All Expense</h3>
										<h3 class="btn btn-info"><a class="panel-title fs-4" href="{{URL::to('/today-expense')}}" value="Today">Today Expense</h3>
										<h3 class="btn btn-warning"><a class="panel-title fs-4" href="{{URL::to('/today-expense')}}" value="Today">Monthly Expense</h3>
										<h3 class="btn btn-danger"><a class="panel-title fs-4" href="{{route('yearlyExpense')}}" value="Today">Yearly Expense</h3>
										
										
										</div>
										<a class=" fs-4" href="{{URL::to('/add-expense')}}" value="This Month">
												<i class="bi bi-bag-plus-fill"style="font-size:24px;color:white;font-weight:800;"></i>
										</a>
						</div>
								<div class="panel-body">
										<div class="row">

												<div class="col-md-12 col-sm-12 col-xs-12">
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
																						<a href="{{URL::to('/edit-expense/'.$row->id)}}" class="btn btn-sm btn-info">Edit</a>
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


@endsection