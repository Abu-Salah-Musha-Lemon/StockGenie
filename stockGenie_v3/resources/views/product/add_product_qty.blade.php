@extends('layouts.layout')
@section('main')


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            
        <div class="panel-heading " style="display: flex;justify-content: space-between;">
                <h3 class="panel-title text-white">Update Product Quantity</h3>
                <a class="panel-title fs-4" href="{{URL::to('/pos')}}">
                <i class="bi bi-bag-plus"style="font-size:24px;color:white;font-weight:800;"></i>
                </a>
        </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Code</th>
                                    <th>Old Quantity</th>
                                    <th>Image</th>
                                    <th>New Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                @foreach($product as $row)
                                <tr>
                                    <td>{{$row->product_name}}</td>
                                    <td>{{$row->product_code}}</td>
                                    <td>{{$row->product_qty}}</td>
                                    <td>
                                    <img src="{{ asset($row->product_image) }}" style="width:50px;height:50px;object:cover;">
                                    </td>
                                    <form action="{{URL::to('/update-product-qty/'.$row->id)}}" method="GET">
                                        <td><input type="number" name="updateQty" id="" class="form-control" min='1' placeholder="Enter product Quantity " value="{{old('updateQty')}}"></td>
                                        <td>
                                            <button type="submit"class="btn btn-purple btn-sm waves-effect waves-light  m-b-5" > Update</button>
                                        </td>
                                    </form>
                                </tr>
                                @endforeach
                        
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
</div>


@endsection