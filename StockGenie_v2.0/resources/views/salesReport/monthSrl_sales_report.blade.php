@extends('layouts.layout')
@section('main')

<div class="row">
	<div class="col-md-12">
		<div>
			<a href="{{route('JanuarySalesReport')}}" class="btn btn-primary" style="margin-bottom:2px;">January</a>
			<a href="{{route('FebruarySalesReport')}}" class="btn btn-secondary" style="margin-bottom:2px;">February</a>
			<a href="{{route('MarchSalesReport')}}" class="btn btn-info" style="margin-bottom:2px;">March</a>
			<a href="{{route('AprilSalesReport')}}" class="btn btn-danger" style="margin-bottom:2px;">April</a>
			<a href="{{route('MaySalesReport')}}" class="btn btn-warning" style="margin-bottom:2px;">May</a>
			<a href="{{route('JuneSalesReport')}}" class="btn btn-purple" style="margin-bottom:2px;">June</a>
			<a href="{{route('JulySalesReport')}}" class="btn btn-pink" style="margin-bottom:2px;">July</a>
			<a href="{{route('AugustSalesReport')}}" class="btn btn-primary" style="margin-bottom:2px;">August</a>
			<a href="{{route('SeptemberSalesReport')}}" class="btn btn-default" style="margin-bottom:2px;">September</a>
			<a href="{{route('OctoberSalesReport')}}" class="btn btn-danger" style="margin-bottom:2px;">October</a>
			<a href="{{route('NovemberSalesReport')}}" class="btn btn-success" style="margin-bottom:2px;">November</a>
			<a href="{{route('DecemberSalesReport')}}" class="btn btn-inverse" style="margin-bottom:2px;">December</a>
			<a href="{{route('yearlySalesReport')}}" class="btn btn-purple" style="margin-bottom:2px;">Yearly</a>
		</div>
		<div class="panel panel-success">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white ">{{$date = date("F");}} Monthly Sales Report</h3>
				@php
				$date = date("F");
				$total = DB::table('orders')->where('order_month',$date)->sum('total');
				$sub_total = DB::table('orders')->where('order_month',$date)->sum('sub_total');
				$pay = DB::table('orders')->where('order_month',$date)->sum('pay');
				$due = DB::table('orders')->where('order_month',$date)->sum('due');
				$total_product = DB::table('orders')->where('order_month',$date)->sum('total_products');
				@endphp

				<a class="panel-title fs-4" href="{{URL::to('/add-SalesReport')}}">
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

										<th>Date</th>
										<th>Total Products</th>
										<th>Sub Total</th>
										<th>Total</th>
										<th>Paid</th>
										<th>Due</th>

									</tr>
								</thead>


								<tbody>

									@foreach($monthly as $row)
									<tr>

										<td>{{$row->order_date}}</td>
										<td>{{$row->total_products}}</td>
										<td>{{$row->sub_total}}</td>
										<td>{{$row->total}}</td>
										<td>{{$row->pay}}</td>
										<td>{{$row->due}}</td>


									</tr>
									@endforeach
								</tbody>
								<tfoot>
									@foreach($monthly as $row)
									@if($date = $row->order_month)
									<tr>
										<td colspan=2>Total Products: {{$total_product}}</td>
										<td>Sub Total : {{$sub_total}}</td>
										<td>Total: {{$total}}</td>
										<td>Total Paid: {{$pay}}</td>
										<td>Total Due:{{$due}}</td>

									</tr>
									@break
									@else
									@endif
									@endforeach
								</tfoot>
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
					
'Date',	'Total Products',	'Sub Total',	'Total',]);
    });
    </script>
@endsection

@endsection