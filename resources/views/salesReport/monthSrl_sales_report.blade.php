@extends('layouts.layout')

@section('main')

<div class="row">
    <div class="col-md-12">

        <!-- MONTH FILTER -->
        <div style="margin-bottom:10px;">
            <a href="{{ route('JanuarySalesReport') }}" class="btn btn-primary">January</a>
            <a href="{{ route('FebruarySalesReport') }}" class="btn btn-secondary">February</a>
            <a href="{{ route('MarchSalesReport') }}" class="btn btn-info">March</a>
            <a href="{{ route('AprilSalesReport') }}" class="btn btn-danger">April</a>
            <a href="{{ route('MaySalesReport') }}" class="btn btn-warning">May</a>
            <a href="{{ route('JuneSalesReport') }}" class="btn btn-dark">June</a>
            <a href="{{ route('JulySalesReport') }}" class="btn btn-pink">July</a>
            <a href="{{ route('AugustSalesReport') }}" class="btn btn-primary">August</a>
            <a href="{{ route('SeptemberSalesReport') }}" class="btn btn-default">September</a>
            <a href="{{ route('OctoberSalesReport') }}" class="btn btn-danger">October</a>
            <a href="{{ route('NovemberSalesReport') }}" class="btn btn-success">November</a>
            <a href="{{ route('DecemberSalesReport') }}" class="btn btn-dark">December</a>
            <a href="{{ route('yearlySalesReport') }}" class="btn btn-purple">Yearly</a>
        </div>

        @php
            $month = date("m");
            $year = date("Y");

            $total = DB::table('sales')
                ->whereMonth('sale_date', $month)
                ->whereYear('sale_date', $year)
                ->sum('grand_total');

            $discount = DB::table('sales')
                ->whereMonth('sale_date', $month)
                ->whereYear('sale_date', $year)
                ->sum('discount');

            $tax = DB::table('sales')
                ->whereMonth('sale_date', $month)
                ->whereYear('sale_date', $year)
                ->sum('tax');
        @endphp

        <!-- PANEL -->
        <div class="panel panel-success">

            <div class="panel-heading" style="display:flex; justify-content:space-between;">
                <h3 class="panel-title text-white">
                    {{ date("F") }} Monthly Sales Report
                </h3>
            </div>

            <div class="panel-body">

                <div class="table-responsive">

                    <table id="dataTable" class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Invoice</th>
                                <th>Discount</th>
                                <th>Tax</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($monthly as $row)
                            <tr>
                                <td>{{ $row->sale_date }}</td>
                                <td>{{ $row->invoice_no }}</td>
                                <td>{{ $row->discount }}</td>
                                <td>{{ $row->tax }}</td>
                                <td>{{ $row->grand_total }}</td>

                                <td>
                                    @if($row->payment_status == 'paid')
                                        <span class="label label-success">Paid</span>
                                    @else
                                        <span class="label label-danger">
                                            {{ $row->payment_status }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                        <!-- FOOTER -->
                        <tfoot>
                            <tr>
                                <td colspan="2"><b>Total</b></td>
                                <td><b>{{ $discount }}</b></td>
                                <td><b>{{ $tax }}</b></td>
                                <td><b>{{ $total }}</b></td>
                                <td></td>
                            </tr>
                        </tfoot>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection


@section('script')
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>
@endsection