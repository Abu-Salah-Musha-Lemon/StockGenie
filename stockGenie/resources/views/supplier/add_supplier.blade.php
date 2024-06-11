@extends('layouts.layout')
@section('main')
<style>
    label {
        width: auto;
    }
</style>

<div class="row" style="display:flex;justify-content:center;align-item:center;">
    <div class="col-md-6 col-lg-8 col-xl-10">
        <div class="panel panel-primary">
            <div class="panel-heading" style="display: flex;justify-content: space-between;">
                <h3 class="panel-title text-white">Add Supplier </h3>
                <a class="panel-title fs-4" href="{{ route('supplier.all-supplier') }}">
                    <i class="bi bi-box-arrow-in-left" style="font-size:24px;color:white"></i>
                </a>
            </div>
            <div class="panel-body">
                <form role="form" action="{{ route('supplier.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
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

                    <button type="submit" class="btn btn-purple btn-custom waves-effect waves-light m-b-5">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
