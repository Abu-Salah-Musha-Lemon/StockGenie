@extends('layouts.layout')
@section('main')



<div class="row">
	<div class="col-md-12">
		<div>
			<a href="{{route('JanuaryExpense')}}" class="btn btn-primary" style="margin-bottom:2px;">January</a>
			<a href="{{route('FebruaryExpense')}}" class="btn btn-secondary" style="margin-bottom:2px;">February</a>
			<a href="{{route('MarchExpense')}}" class="btn btn-info" style="margin-bottom:2px;">March</a>
			<a href="{{route('AprilExpense')}}" class="btn btn-danger" style="margin-bottom:2px;">April</a>
			<a href="{{route('MayExpense')}}" class="btn btn-warning" style="margin-bottom:2px;">May</a>
			<a href="{{route('JuneExpense')}}" class="btn btn-purple" style="margin-bottom:2px;">June</a>
			<a href="{{route('JulyExpense')}}" class="btn btn-pink" style="margin-bottom:2px;">July</a>
			<a href="{{route('AugustExpense')}}" class="btn btn-primary" style="margin-bottom:2px;">August</a>
			<a href="{{route('SeptemberExpense')}}" class="btn btn-default" style="margin-bottom:2px;">September</a>
			<a href="{{route('OctoberExpense')}}" class="btn btn-danger" style="margin-bottom:2px;">October</a>
			<a href="{{route('NovemberExpense')}}" class="btn btn-success" style="margin-bottom:2px;">November</a>
			<a href="{{route('DecemberExpense')}}" class="btn btn-inverse" style="margin-bottom:2px;">December</a>
		</div>
		<div class="panel panel-success">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title">{{$date = date("F");}} Monthly Expense</h3>
				@php
				$date = date("F");
				$total = DB::table('expenses')->where('month',$date)->sum('amount');
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
								<tbody>
									@foreach($monthly as $row)
									<tr>
										<td>{{$row->details}}</td>
										<td>{{$row->amount}}</td>

									</tr>
									@endforeach

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