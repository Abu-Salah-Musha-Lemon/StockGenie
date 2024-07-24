@extends('layouts.layout')
@section('main')
<style>
	label{
		width:auto;
	}
</style>



<div class="row "style="display:flex;justify-content:center;align-item:center;">
        <!-- Basic example -->
        <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6 col-xxl-6">
    <div class="panel panel-success">
        <div class="panel-heading " style="display: flex;justify-content: space-between;">
                <h3 class="panel-title">View Employee</h3>
                <a class="panel-title fs-4" href="{{URL::to('/all-employee')}}">
                    <i class="bi bi-box-arrow-in-left"style="font-size:24px;color:white;"></i></a>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name"value="{{$single->name}}" disabled>
                </div>

                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email"value="{{$single->email}}" disabled>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number"value="{{$single->phone}}" disabled>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Enter address"value="{{$single->address}}" disabled>
                </div>
                <div class="form-group">
                    <label>Experience</label>
                    <input type="text" class="form-control" name="experience" placeholder="Enter experience"value="{{$single->experience}}" disabled>
                </div>

                <div class="form-group">
                    <label>Salary</label>
                    <input type="text" class="form-control" name="salary" placeholder="Enter salary"value="{{$single->salary}}" disabled>
                </div>
                <div class="form-group">
                    <label>Vacation</label>
                    <input type="text" class="form-control" name="vacation" placeholder="Enter vacation"value="{{$single->vacation}}" disabled>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" name="city" placeholder="Enter City"value="{{$single->city}}">
                </div>
                <div class="form-group">
                    <label>NID</label>
                    <input type="text" class="form-control" name="nid" placeholder="Enter nid Number"value="{{$single->nid}}" disabled>
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