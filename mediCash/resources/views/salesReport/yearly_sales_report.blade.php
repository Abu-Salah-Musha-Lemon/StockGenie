@extends('layouts.layout')
@section('main')


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                
            <div class="panel-heading " style="display: flex;justify-content: space-between;">
                    <h3 class="panel-title text-white"> @php $date = date("Y");@endphp  Sales Report</h3>
                    <h3 class="btn btn-info"><a class="panel-title fs-4" href="{{route('todaySalesReport')}}" value="Today">Today Sales Report </a></h3>
                    <h3 class="btn btn-warning"><a class="panel-title fs-4" href="{{route('monthlySalesReport')}}" value="Monthly">Monthly Sales Report </a></h3>
                    <h3 class="btn btn-warning"><a class="panel-title fs-4" href="{{route('yearlySalesReport')}}" value="yearly">Yearlyly Sales Report </a></h3>
                    
                    
                    @php
                    $date = date("Y");
                    $total = DB::table('orders')->where('order_year',$date)->sum('total');
                    $sub_total = DB::table('orders')->where('order_year',$date)->sum('sub_total');
                    $pay = DB::table('orders')->where('order_year',$date)->sum('pay');
                    $due = DB::table('orders')->where('order_year',$date)->sum('due');
                    $total_product = DB::table('orders')->where('order_year',$date)->sum('total_products');
                    @endphp
                
                   
            </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
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

                                        @foreach($yearly as $row)
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
                                        
                                        <td colspan=2>Total Products: {{$total_product}}</td>
                                        <td>Sub Total : {{$sub_total}}</td>
                                        <td>Total: {{$total}}</td>
                                        
                                        
                                        
                                        <td>Total Paid: {{$pay}}</td>
                                       
                                        <td>Total Due:{{$due}}</td>
                                        
                                        
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