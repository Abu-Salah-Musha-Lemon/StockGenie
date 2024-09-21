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

<!-- Financial Statement Table -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-border panel-purple">
            <div class="panel-heading">
                <h3 class="panel-title">Financial Statement</h3>
            </div>
            <div class="panel-body">
						<div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered">
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

<!-- Chart Containers -->
<div class="row">
    <div class="col-lg-4">
        <canvas id="pieChart"></canvas>
    </div>
    <div class="col-lg-4">
        <canvas id="barChart"></canvas>
    </div>
    <div class="col-lg-4">
        <canvas id="lineChart"></canvas>
    </div>
</div>

<!-- Today's Sales Chart Container -->
<div class="row">
    <div class="col-lg-12">
        <canvas id="todaySalesChart"></canvas>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctxPie = document.getElementById('pieChart').getContext('2d');
    var ctxBar = document.getElementById('barChart').getContext('2d');
    var ctxLine = document.getElementById('lineChart').getContext('2d');
    var ctxToday = document.getElementById('todaySalesChart').getContext('2d');

    var pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Total Sales', 'Total VAT', 'Annual Profit'],
            datasets: [{
                data: [{{$totalYearlySale}}, {{$totalYearlyVat}}, {{$totalYearlySale - $totalYearlyVat}}],
                backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56']
            }]
        },
				
    });

    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: [
                'January', 'February', 'March', 'April', 'May', 'June', 'July', 
                'August', 'September', 'October', 'November', 'December'
            ],
            datasets: [{
                label: 'Monthly Sales',
                data: [
                    @foreach($monthlySales as $monthlySale)
                        {{$monthlySale->total_sales}},
                    @endforeach
                ],
                backgroundColor: '#36A2EB'
            }]
        },
				options: {
        responsive: true,
        maintainAspectRatio: false
    }
    });

    var lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: [
                'January', 'February', 'March', 'April', 'May', 'June', 'July', 
                'August', 'September', 'October', 'November', 'December'
            ],
            datasets: [{
                label: 'Monthly Sales',
                data: [
                    @foreach($monthlySales as $monthlySale)
                        {{$monthlySale->total_sales}},
                    @endforeach
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },options: {
        responsive: true,
        maintainAspectRatio: false
    }
				
    });

    var todaySalesChart = new Chart(ctxToday, {
        type: 'line',
        data: {
            labels: [
                @for ($i = 0; $i < 24; $i++) 
                    {{$i}}, 
                @endfor
            ],
            datasets: [{
                label: 'Today\'s Sales',
                data: [
                    @foreach($todaySales as $hourSale)
                        {{$hourSale->total_sales}},
                    @endforeach
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
				options: {
        responsive: true,
        maintainAspectRatio: false
    }
    });
</script>
@section('script')
<script>
    $(document).ready(function () {
        initializeDataTable([	
					'Date',	'Total Products',	'Sub Total',	'Total']);
    });
    $(document).ready(function () {
        initializeDataTable([	
					'Description',	'Amount']);
    });
    </script>
@endsection

@endsection
