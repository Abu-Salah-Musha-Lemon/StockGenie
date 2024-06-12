@extends('layouts.layout')
@section('main')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading" style="display: flex; justify-content: space-between;">
                <h3 class="panel-title text-white">All Supplier</h3>
                <!-- <a class="panel-title fs-4" href="#" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">
                    <i class="bi bi-person-add" style="font-size:24px;color:white;font-weight:800;"></i>
                </a> -->
								<a href="{{URL::to('/add-supplier')}}"><i class="bi bi-person-add" style="font-size:24px;color:white;font-weight:800;"></i></a>
								
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Shop Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplier as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->address}}</td>
                                    <td>{{$row->shopName}}</td>
                                    <td>
                                        <a href="{{URL::to('/view-supplier'.$row->id)}}" class="btn btn-sm btn-primary btn-custom waves-effect waves-light"><i class="bi bi-eye fs-2"></i></a>
                                        <a href="{{URL::to('/edit-supplier'.$row->id)}}" class="btn btn-sm btn-info btn-custom waves-effect waves-light"><i class="bi bi-pencil-square fs-2"></i></a>
                                        <a href="{{URL::to('/delete-supplier'.$row->id)}}" class="btn btn-sm btn-danger btn-custom waves-effect waves-light" id="delete"><i class="bi bi-trash fs-2"></i></a>
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
</div>

<!-- Modal -->
<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

@if (session('message'))
    <div class="alert alert-{{ session('alert-type') }}">
        {{ session('message') }}
    </div>
@endif

<div id="con-close-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; padding-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Supplier </h4>
            </div>
						<form role="form" action="{{ route('supplier.store') }}" method="post" enctype="multipart/form-data">
							@csrf
            <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name') }}" />
                        <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}" />
                        <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter address" value="{{ old('address') }}" />
                        <span class="text-danger">@error('address'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" id="type" class="form-control">
                            <option disabled="" selected="">Select</option>
                            <option value="Distributer">Distributer</option>
                            <option value="WholeSeller">Whole Seller</option>
                            <option value="Broker">Broker</option>
                        </select>
                        <span class="text-danger">@error('type'){{ $message }}@enderror</span>
                    </div>

                    <div class="form-group">
                        <label>Shop Name</label>
                        <input type="text" class="form-control" name="shopName" placeholder="Enter Shop Name" value="{{ old('shopName') }}" />
                        <span class="text-danger">@error('shopName'){{ $message }}@enderror</span>
                    </div>

                    
                
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-purple btn-custom waves-effect waves-light m-b-5">
                        Submit
                </button>
            </div>
					</form>
        </div>
    </div>
</div>
<!-- Modal End -->

@endsection
