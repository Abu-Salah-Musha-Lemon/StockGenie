@extends('layouts.layout')
@section('main')

<style>
	label {
		width: auto;
	}
</style>


@php
$day=date("d-m-y");
$month=date("M");
$year=date("Y");
$totalTodaySale = DB::table('orders')->where('order_date',$day)->sum('pay');
$totalMonthSale = DB::table('orders')->where('order_month',$month)->sum('pay');
$totalYearlySale = DB::table('orders')->where('order_year',$year)->sum('pay');
$totalTodayVat = DB::table('orders')->where('order_date',$day)->sum('vat');
$totalMonthVat = DB::table('orders')->where('order_month',$month)->sum('vat');
$totalYearlyVat = DB::table('orders')->where('order_year',$year)->sum('vat');
$totalOrder = DB::table('orders')->sum('total_products');
$totalProductUnitcost = DB::table('order_details')->sum('unitcost');
$totalProduct = DB::table('order_details')->sum('unitcost');

@endphp





<div class="row">

	<div class="col-md-6 col-sm-6 col-lg-3">
		<div class="mini-stat clearfix bx-shadow">
			<span class="mini-stat-icon bg-info"><i class="ion-social-usd"></i></span>
			<div class="mini-stat-info text-right text-muted">
				<span class="counter">{{$totalTodaySale}}</span>
				Total Sales
			</div>
			<div class="tiles-progress">
				<div class="m-t-20">
					<h5 class="text-uppercase">Todays Sales</h5>
					<div class="progress progress-sm m-0">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0"
							aria-valuemax="100" style="width: 100%;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6 col-lg-3">
		<div class="mini-stat clearfix bx-shadow">
			<span class="mini-stat-icon bg-info"><i class="bi bi-calendar-check"></i></span>
			<div class="mini-stat-info text-right text-muted">
				<span class="counter">{{$totalMonthSale}}</span>
				Monthly Total Sales
			</div>
			<div class="tiles-progress">
				<div class="m-t-20">
					<h5 class="text-uppercase">Monthly Sales</h5>
					<div class="progress progress-sm m-0">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0"
							aria-valuemax="100" style="width: 100%;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6 col-lg-3">
		<div class="mini-stat clearfix bx-shadow">
			<span class="mini-stat-icon bg-info"><i class="ion-social-usd"></i></span>
			<div class="mini-stat-info text-right text-muted">
				<span class="counter">{{$totalYearlySale}}</span>
				Annual Sales
			</div>
			<div class="tiles-progress">
				<div class="m-t-20">
					<h5 class="text-uppercase">Annual Sales</h5>
					<div class="progress progress-sm m-0">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0"
							aria-valuemax="100" style="width: 100%;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6 col-lg-3">
		<div class="mini-stat clearfix bx-shadow">
			<span class="mini-stat-icon bg-info"><i class="ion-social-usd"></i></span>
			<div class="mini-stat-info text-right text-muted">
				<span class="counter">{{$totalYearlySale -$totalYearlyVat}}</span>
				Annual Sales Profit
			</div>
			<div class="tiles-progress">
				<div class="m-t-20">
					<h5 class="text-uppercase">Annual Sales Profit</h5>
					<div class="progress progress-sm m-0">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0"
							aria-valuemax="100" style="width: 100%;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-md-6 col-sm-6 col-lg-3">
		<div class="mini-stat clearfix bx-shadow">
			<span class="mini-stat-icon bg-info"><i class="ion-social-usd"></i></span>
			<div class="mini-stat-info text-right text-muted">
				<span class="counter">{{$totalTodaySale -$totalTodayVat}}</span>
				Daily Sales Profit
			</div>
			<div class="tiles-progress">
				<div class="m-t-20">
					<h5 class="text-uppercase">Daily Sales Profit</h5>
					<div class="progress progress-sm m-0">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0"
							aria-valuemax="100" style="width: 100%;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-6 col-lg-3">
		<div class="mini-stat clearfix bx-shadow">
			<span class="mini-stat-icon bg-info"><i class="ion-social-usd"></i></span>
			<div class="mini-stat-info text-right text-muted">
				<span class="counter">{{$totalProductUnitcost}}</span>
				unit Cost
			</div>
			<div class="tiles-progress">
				<div class="m-t-20">
					<h5 class="text-uppercase">Sales</h5>
					<div class="progress progress-sm m-0">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0"
							aria-valuemax="100" style="width: 100%;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@php
	$totalProductStore = DB::table('products')->sum('product_qty');
	@endphp
	<div class="col-md-6 col-sm-6 col-lg-3">
		<div class="mini-stat clearfix bx-shadow">
			<span class="mini-stat-icon bg-danger"><i class="bi bi-cart2"></i></span>
			<div class="mini-stat-info text-right text-muted">
				<span class="counter">{{$totalProductStore}}</span>
				Store Total products
			</div>
			<div class="tiles-progress">
				<div class="m-t-20">
					<h5 class="text-uppercase">Store Total products</h5>
					<div class="progress progress-sm m-0">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0"
							aria-valuemax="100" style="width: 100%;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-border panel-purple widget-s-1">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <div class="row">
                    @php
                    $date = date("d-m-y");
                    $total = DB::table('orders')->where('order_date', $date)->sum('total');
                    $today = DB::table('orders')->where('order_date', $date)->get();
                    $sub_total = DB::table('orders')->where('order_date', $date)->sum('sub_total');
                    $pay = DB::table('orders')->where('order_date', $date)->sum('pay');
                    $due = DB::table('orders')->where('order_date', $date)->sum('due');
                    $total_product = DB::table('orders')->where('order_date', $date)->sum('total_products');
                    @endphp
                    <div class="col-12">
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
                                    @foreach($today->reverse() as $row)
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
                                    <tr>
                                        <td colspan="2">Total Products: {{$total_product}}</td>
                                        <td>Total Sub: {{$sub_total}}</td>
                                        <td>Total: {{$total}}</td>
                                        <td>Total Paid: {{$pay}}</td>
                                        <td>Total Due: {{$due}}</td>
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