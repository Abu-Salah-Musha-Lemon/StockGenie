@extends('layout')
@section('main')


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                
            <div class="panel-heading " style="display: flex;justify-content: space-between;">
                    <h3 class="panel-title"> @php $date = date("Y");@endphp  Sales Report</h3>
                    <h3 class="btn btn-info"><a class="panel-title fs-4" href="{{route('todaySalesReport')}}" value="Today">Today Sales Report </h3>
                    <h3 class="btn btn-warning"><a class="panel-title fs-4" href="{{route('monthlySalesReport')}}" value="Monthly">Monthly Sales Report </h3>
                    <h3 class="btn btn-warning"><a class="panel-title fs-4" href="{{route('yearlySalesReport')}}" value="yearly">Yearlyly Sales Report </h3>
                    
                    
                    @php
                    $date = date("Y");
                    $total = DB::table('order')->where('order_year',$date)->sum('total');
                    $sub_total = DB::table('order')->where('order_year',$date)->sum('sub_total');
                    $pay = DB::table('order')->where('order_year',$date)->sum('pay');
                    $due = DB::table('order')->where('order_year',$date)->sum('due');
                    $total_product = DB::table('order')->where('order_year',$date)->sum('total_products');
                    @endphp
                
                    <!-- <a class="panel-title fs-4" href="{{URL::to('/add-expense')}}">
                        <i class="bi bi-bag-plus-fill"style="font-size:24px;color:white;font-weight:800;"></i>
                    </a> -->
            </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Customer Name </th>
                                        <th>Date</th>
                                        <th>Total Products</th>
                                        <th>Sub Total</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                    
                            
                                <tbody>

                                        @foreach($yearly as $row)
                                    <tr>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->order_date}}</td>
                                        <td>{{$row->total_products}}</td>
                                        <td>{{$row->sub_total}}</td>
                                        <td>{{$row->total}}</td>
                                        <td>{{$row->pay}}</td>
                                        <td>{{$row->due}}</td>
                                        <td>{{$row->payment_status}}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Total:</td>
                                        <td>Total Products:</td>
                                        <td> {{$total_product}}</td>
                                        <td> </td>
                                        
                                        <td>Total Paid:</td>
                                        <td>{{$pay}}</td>
                                        <td>Total Due:{{$due}}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>


@endsection