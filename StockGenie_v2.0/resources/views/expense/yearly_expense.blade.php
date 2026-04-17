@extends('layouts.layout')
@section('main')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">{{$date = date("Y");}} Expense</h3>
				@php
				$date = date("Y");
				$total = DB::table('expenses')->where('year',$date)->sum('amount');
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

									</tr>
								</thead>
								@foreach($yearly as $row)
								<tr>
									<td>{{$row->details}}</td>
									<td>{{$row->amount}}</td>

								</tr>
								@endforeach

								<tbody>
								</tbody>
								<tfoot>
									<tr>
										<td>Total</td>
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