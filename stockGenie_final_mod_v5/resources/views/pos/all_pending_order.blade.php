@extends('layouts.layout')
@section('main')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info ">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<div class="div">
					<h3 class="panel-title">All Pending Order </h3>

				</div>

			</div>
			<div class="panel-body">
				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="dataTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Order Date</th>
										<th>Total Products</th>
										<!-- <th>Quantity</th> -->
										<th>Payment Status</th>
										<th>Order Status</th>
										<th>Action</th>
									</tr>
								</thead>
								@foreach($pending->reverse() as $row)
								<tr>

									<td>{{$row->order_date}}</td>
									<td>{{$row->total_products}}</td>


									<td>{{$row->pay}}</td>
									<td><span class="label label-danger">{{$row->order_status}}</span></td>

									<td>
										<a href="{{URL::to('/view-order/'.$row->id)}}"
											class="btn btn-info btn-sm waves-effect waves-light w-sm m-b-5">view</a>
										<!-- <a href="{{URL::to('/delete-expense/'.$row->id)}}" class="btn btn-sm btn-danger"id="delete">Delete</a> -->
										<!-- <a href="{{URL::to('/view-expense/'.$row->id)}}" class="btn btn-sm btn-primary">view</a> -->
									</td>
								</tr>
								@endforeach

								<tbody>

								</tbody>
							</table>
							<div>
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
					'Order', 'Date',	'Total Products',	'Payment Status',	'Order Status',]);
    });
    </script>
@endsection

	@endsection