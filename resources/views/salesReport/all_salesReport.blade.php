@extends('layouts.layout')
@section('main')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success text-info">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<div class="div">
					<h3 class="panel-title text-white">All Sales Reports </h3>
					<h3 class="btn btn-info"><a class="panel-title fs-4" href="{{URL::to('/today-sales-report')}}"
							value="Today">Today Sales Reports </a></h3>
					<h3 class="btn btn-warning"><a class="panel-title fs-4" href="{{URL::to('/monthly-sales-report')}}"
							value="Today">Monthly Sales Reports </a></h3>
					<h3 class="btn btn-danger"><a class="panel-title fs-4" href="{{route('yearly-Sales-Reports')}}"
							value="Today">Yearly Sales Reports </a></h3>
				</div>

			</div>

			<div class="panel-body">
				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">

							<table id="dataTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Paid Amount </th>
										<th>Paid Status </th>
										<th>Order Date</th>
										<th>Order Month</th>
										<th>Order Year</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($allReport as $row)
									<tr>

										<td>{{$row->pay}}</td>
										<td>
											@if($row->order_status=='success')
											<span
												class="label label-success waves-effect waves-light text-bolder">{{$row->order_status}}</span>
											@else
											<span
												class="label label-danger waves-effect waves-light text-bolder">{{$row->order_status}}</span>
											@endif
										</td>
										<td>{{$row->order_date}}</td>
										<td>{{$row->order_month}}</td>
										<td>{{$row->order_year}}</td>
										<td>
											<a href="{{URL::to('view-order/'.$row->id)}}" class="btn btn-sm btn-primary">view</a>
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

	</div>
</div>
@section('script')
<script>
    $(document).ready(function () {
        initializeDataTable([	
					'Paid Amount', 'Order Date',	'Order Month',	'Order Year']);
    });
    </script>
@endsection

@endsection