@extends('layouts.layout')

@section('main')

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-success text-info">

            <!-- HEADER -->
            <div class="panel-heading" style="display:flex; justify-content:space-between;">

                <div>
                    <h3 class="panel-title text-white">Today Sales Report</h3>

                     <a href="{{ route('reports.sales.monthly') }}" class="btn btn-secondary">Monthly Sales</a>
            					<a href="{{ route('reports.sales.yearly') }}" class="btn btn-success">Yearly Sales</a>
                </div>

            </div>

            @php
                $date = date("Y-m-d");

                $total = DB::table('sales')
                    ->whereDate('sale_date', $date)
                    ->sum('grand_total');

                $discount = DB::table('sales')
                    ->whereDate('sale_date', $date)
                    ->sum('discount');

                $tax = DB::table('sales')
                    ->whereDate('sale_date', $date)
                    ->sum('tax');
            @endphp

            <div class="panel-body">

                <div class="table-responsive">

                    <table id="dataTable" class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Invoice</th>
                                <th>Discount</th>
                                <th>Tax</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php $sl = 1; @endphp

                            @foreach($todaySales->reverse() as $row)
                            <tr>
                                <td>{{ $sl++ }}</td>
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
                                <td colspan="3"><b>Totals</b></td>
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