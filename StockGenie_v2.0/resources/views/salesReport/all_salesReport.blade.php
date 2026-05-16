@extends('layouts.layout')

@section('main')

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-success text-info">

            <!-- HEADER -->
            <div class="panel-heading" style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h3 class="panel-title text-white">All Sales Reports</h3>
                </div>

                <div>
<a href="{{ route('reports.sales.index') }}">All Sales Report</a>
<a href="{{ route('reports.sales.today') }}">Today's Sales</a>
<a href="{{ route('reports.sales.monthly') }}">Monthly Sales</a>
<a href="{{ route('reports.sales.yearly') }}">Yearly Sales</a>
                </div>
            </div>

            <!-- TABLE -->
            <div class="panel-body">
                <div class="table-responsive">

                    <table id="dataTable" class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Grand Total</th>
                                <th>Discount</th>
                                <th>Tax</th>
                                <th>Payment Status</th>
                                <th>Sale Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($allReports as $row)
                            <tr>

                                <td>{{ $row->invoice_no }}</td>
                                <td>{{ $row->grand_total }}</td>
                                <td>{{ $row->discount }}</td>
                                <td>{{ $row->tax }}</td>

                                <td>
                                    @if($row->payment_status == 'paid')
                                        <span class="label label-success">Paid</span>
                                    @else
                                        <span class="label label-danger">
                                            {{ $row->payment_status }}
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $row->sale_date }}</td>

                                <td>
                                    <a href="{{ url('view-sale/'.$row->id) }}" class="btn btn-sm btn-primary">
                                        View
                                    </a>
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

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>
@endsection