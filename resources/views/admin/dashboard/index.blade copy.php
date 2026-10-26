@extends('layouts.layout')
@section('main')

<style>
	label {
		width: auto;
	}
</style>

@php
$day = date("d-m-y");
$month = date("M");
$year = date("Y");
@endphp
@if(auth()->user()->role === 0)
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

<!-- Today Total Financial Statement  -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-border panel-purple widget-s-1">
			<div class="panel-heading">
				<h3 class="panel-title">Today Total Financial Statement</h3>
			</div>
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
							<table id="todayTotalFinancialTable" class="table table-striped table-bordered">
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

<!-- Financial Statement Table -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-border panel-purple">
			<div class="panel-heading">
				<h3 class="panel-title">Financial Statement</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table id="financialStatementTable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Description</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Total Sales (yearly)</td>
								<td>{{$totalYearlySale}}</td>
							</tr>
							<tr>
								<td>Total VAT (yearly)</td>
								<td>{{$totalYearlyVat}}</td>
							</tr>
							<tr>
								<td>Annual Profit (yearly)</td>
								<td>{{$totalYearlySale - $totalYearlyVat}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<!-- Stock details  -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-border panel-danger widget-s-1">
            <div class="panel-heading">
                <h3 class="panel-title">Low Stock alert</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    @php
                    // Filter products with quantity less than 10 and paginate
                    $lowStockProducts = DB::table('products')
                        ->where('product_qty', '<', 10)
                        ->get();
                    @endphp
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="lowStockTable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $s = 1; @endphp
                                    @foreach($lowStockProducts as $row)
                                    <tr>
                                        <td>{{ $s++ }}</td>
                                        <td>{{ $row->product_name }}</td>
                                        <td>{{ $row->product_code }}</td>
                                        <td><span class='badge badge-danger'>{{ $row->product_qty }}</span></td>
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

    <div class="col-lg-6">
        <div class="panel panel-border panel-success widget-s-1">
            <div class="panel-heading">
                <h3 class="panel-title">New Product Alert</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    @php
                    $date = date("Y-m-d");
                    // Fetch all products
                    $newProducts = DB::table('products')->get();
                    @endphp
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="newProductTable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $s = 1; @endphp
                                    @foreach($newProducts as $row)
                                    @if(explode(' ', $row->updated_at)[0] == $date)
                                    <tr>
                                        <td>{{ $s++ }}</td>
                                        <td>{{ $row->product_name }}</td>
                                        <td>{{ $row->product_code }}</td>
                                        <td><span class='badge badge-success'>{{ $row->product_qty }}</span></td>
                                        <td>{{ $row->selling_price }} ৳</td>
                                    </tr>
                                    @endif
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
        // Initialize specific tables with their IDs
        initializeDataTable(['Date', 'Total Products', 'Sub Total', 'Total'], '#todayTotalFinancialTable');
        initializeDataTable(['Description', 'Amount'], '#financialStatementTable');
        initializeDataTable(['SL', 'Product Name', 'Product Code', 'Quantity'], '#lowStockTable');
        initializeDataTable(['SL', 'Product Name', 'Product Code', 'Quantity', 'Price'], '#newProductTable');
        
        // Initialize default table with only column names
        initializeDataTable(['Column1', 'Column2']); // This will initialize #dataTable
    });
</script>
@endsection

@endsection