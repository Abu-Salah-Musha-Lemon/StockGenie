@extends('layouts.layout')

@section('main')

<style>
    label { width: auto; }
</style>

@if(auth()->user()->role === 0)

{{-- ===================== STATS CARDS ===================== --}}
<div class="row">

    <div class="col-md-6 col-lg-3">
        <div class="mini-stat bx-shadow">
            <span class="mini-stat-icon bg-info"><i class="ion-social-usd"></i></span>
            <div class="mini-stat-info text-right text-muted">
                <span class="counter">{{ number_format($stats['today_sales'], 2) }}</span>
                Today Sales
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="mini-stat bx-shadow">
            <span class="mini-stat-icon bg-success"><i class="bi bi-calendar-check"></i></span>
            <div class="mini-stat-info text-right text-muted">
                <span class="counter">{{ number_format($stats['month_sales'], 2) }}</span>
                Monthly Sales
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="mini-stat bx-shadow">
            <span class="mini-stat-icon bg-warning"><i class="ion-social-usd"></i></span>
            <div class="mini-stat-info text-right text-muted">
                <span class="counter">{{ number_format($stats['today_profit'], 2) }}</span>
                Today Profit
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="mini-stat bx-shadow">
            <span class="mini-stat-icon bg-danger"><i class="bi bi-cash"></i></span>
            <div class="mini-stat-info text-right text-muted">
                <span class="counter">{{ number_format($stats['total_due'], 2) }}</span>
                Total Due
            </div>
        </div>
    </div>

</div>

{{-- ===================== RECENT SALES ===================== --}}
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-border panel-purple">
            <div class="panel-heading">
                <h3 class="panel-title">Recent Sales</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="recentSalesTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSales as $sale)
                                <tr>
                                    <td>{{ $sale->invoice_no }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y') }}</td>
                                    <td>{{ number_format($sale->grand_total, 2) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $sale->payment_status === 'paid' ? 'success' : 'danger' }}">
                                            {{ ucfirst($sale->payment_status) }}
                                        </span>
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

@endif

{{-- ===================== LOW STOCK ===================== --}}
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-border panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Low Stock Alert</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="lowStockTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowStocks as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <span class="badge badge-danger">
                                            {{ $product->qty }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">
                                        No low stock items 🎉
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@section('script')
<script>
    $(document).ready(function () {
        initializeDataTable(['Invoice', 'Date', 'Total', 'Status'], '#recentSalesTable');
        initializeDataTable(['Product', 'Quantity'], '#lowStockTable');
    });
</script>
@endsection
@endsection
