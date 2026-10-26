@extends('layouts.layout')
@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success text-info">

            <div class="panel-heading" style="display: flex; justify-content: space-between;">
                <div>
                    <h3 class="panel-title text-white">{{ $date = date("Y") }} Sales Report</h3>
                    <h3 class="btn btn-info"><a class="panel-title fs-4" href="{{ route('reports.sales.today') }}">Today Sales Reports</a></h3>
                    <h3 class="btn btn-warning"><a class="panel-title fs-4" href="{{ route('reports.sales.monthly') }}">Monthly Sales Reports</a></h3>
                    <h3 class="btn btn-danger"><a class="panel-title fs-4" href="{{ route('reports.sales.yearly') }}">Yearly Sales Reports</a></h3>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
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
                                    @php
                                        $sl = 1;
                                    @endphp

                                    @foreach($yearlySales as $row)
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

                                <!-- Footer with total sums -->
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><b>Total Products:</b> {{ $totalProducts }}</td>
                                        <td><b>Sub Total:</b> {{ $subTotal }}</td>
                                        <td><b>Total:</b> {{ $total }}</td>
                                        <td><b>Total Paid:</b> {{ $paid }}</td>
                                        <td><b>Total Due:</b> {{ $due }}</td>
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

@section('script')
<script>
    $(document).ready(function () {
        initializeDataTable([
            '#', 'Date', 'Invoice', 'Discount', 'Tax', 'Total'
        ]);
    });
</script>
@endsection

@endsection