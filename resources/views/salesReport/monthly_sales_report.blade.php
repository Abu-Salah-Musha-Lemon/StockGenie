@extends('layouts.layout')

@section('main')

<div class="row">
    <div class="col-md-12">

        <!-- MONTH FILTER BUTTONS -->
        <div style="margin-bottom:10px;">

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
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Discount</th>
                                <th>Tax</th>
                                <th>Grand Total</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($monthlySales as $row)
                            <tr>
                                <td>{{ $row->invoice_no }}</td>
                                <td>{{ $row->sale_date }}</td>
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

                        <!-- FOOTER TOTAL -->
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