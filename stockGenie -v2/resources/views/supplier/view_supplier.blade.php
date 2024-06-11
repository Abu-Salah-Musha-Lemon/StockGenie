@extends('layouts.layout')
@section('main')
<style>
	label{
		width:auto;
	}
</style>


    <div class="row "style="display:flex;justify-content:center;align-item:center;">
        <!-- Basic example -->
        <div class=" col-md-6 col-lg-8 col-xl-10">
            <div class="panel panel-success">
                <div class="panel-heading " style="display: flex;justify-content: space-between;">
                        <h3 class="panel-title text-white">View Supplier</h3>
                        <a class="panel-title fs-4" href="{{URL::to('/all-supplier')}}">
                                <i class="bi bi-box-arrow-in-left"style="font-size:24px;color:white;font-weight:800;"></i>
                        </a>
                    </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name"
                            placeholder="Enter Name"value="{{ $single->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" name="email"
                            placeholder="Enter email"value="{{ $single->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" class="form-control" name="phone"
                            placeholder="Enter Phone Number"value="{{ $single->phone }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address"
                            placeholder="Enter address" value="{{ $single->address }}" disabled>
                    </div>

                    <div class="form-group">
                                                        <label>Type</label>
                                                                <input type="text" class="form-control" name="address"value="{{ $single->type}}" disabled>
                                                </div>

                    <div class="form-group">
                        <label>shopeName</label>
                        <input type="text" class="form-control" name="shopeName"
                            value="{{ $single->shopeName }}" placeholder="Enter shopeName"disabled>
                    </div>

                    <div class="form-group">
                        <label>Account Holder Name</label>
                        <input type="text" class="form-control" name="account_holder"
                            value="{{ $single->account_holder }}"
                            placeholder="Enter Account Holder Name"disabled>
                    </div>
                    <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" class="form-control" name="account_number"
                            value="{{ $single->account_number }}" placeholder="Enter Account Number"disabled>
                    </div>
                    <div class="form-group">
                        <label>Bank Name</label>
                        <input type="text" class="form-control" name="bank_name"
                            value="{{ $single->bank_name }}" placeholder="Enter Bank Name"disabled>
                    </div>
                    <div class="form-group">
                        <label>Bank Branch Name</label>
                        <input type="text" class="form-control" name="bank_branch"
                            value="{{ $single->bank_branch }}" placeholder="Enter Bank Branch Name"disabled>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city"
                            placeholder="Enter City"value="{{ $single->city }}" disabled>
                    </div>
                    
                        <!-- Photo -->
                    <div class="form-group my-2">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                    <span>Photo</span>
                            </div>
                            <img id="image" style="width: 100px;height: 100px;object: cover;"  src="{{ $single->photo}}"/><br />
                            
                    </div>

                </div><!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col-->
    </div>


    @endsection
