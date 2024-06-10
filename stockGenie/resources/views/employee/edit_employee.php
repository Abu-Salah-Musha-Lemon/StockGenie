@extends('dashboard')
@section('main')
<style>
    label{
        width:auto;
    }
</style>

	<div class="row"style="display:flex;justify-content:center;align-item:center;">
			<!-- Basic example -->
			<div class="col-xl-10 col-lg-8 col-md-6 col-12 m-auto">
					<div class="panel panel-info">
							

					<div class="panel-heading " style="display: flex;justify-content: space-between;">
											<h3 class="panel-title text-white">Edit Employee</h3>
											<a class="panel-title fs-4" href="{{URL::to('/all-employee')}}">
													<i class="bi bi-box-arrow-in-left"style="font-size:24px;color:white;"></i>
											</a>
							</div>

							<div class="panel-body">

							<form role="form" action="{{ URL::to('update-employee'.$editUser->id) }}" method="post" enctype="multipart/form-data">
											@csrf
											<div class="form-group">
													<label>Name</label>
													<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"value="{{$editUser->name}}">
													<span class='text-danger'>@error('name'){{ $message }} @enderror</span>
											</div>

											<div class="form-group">
													<label>Email address</label>
													<input type="email" class="form-control" name="email" id="email" placeholder="Enter email"value="{{$editUser->email}}">
													<span class='text-danger'>@error('email'){{ $message }} @enderror</span>
											</div>

											<div class="form-group">
													<label>Phone Number</label>
													<input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number"value="{{$editUser->phone}}">
													<span class='text-danger'>@error('phone'){{ $message }} @enderror</span>
											</div>

											<div class="form-group">
													<label>Address</label>
													<input type="text" class="form-control" name="address" id="address" placeholder="Enter address"value="{{$editUser->address}}">
													<span class='text-danger'>@error('address'){{ $message }} @enderror</span>
											</div>
											<div class="form-group">
													<label>Experience</label>
													<input type="text" class="form-control" name="experience" id="experience" placeholder="Enter experience"value="{{$editUser->experience}}">
													<span class='text-danger'>@error('experience'){{ $message }} @enderror</span>
											</div>

											<div class="form-group">
													<label>Salary</label>
													<input type="text" class="form-control" name="salary" id="salary" placeholder="Enter salary"value="{{$editUser->salary}}">
													<span class='text-danger'>@error('salary'){{ $message }} @enderror</span>
											</div>
											<div class="form-group">
													<label>Vacation</label>
													<input type="text" class="form-control" name="vacation" id="vacation" placeholder="Enter vacation"value="{{$editUser->vacation}}">
													<span class='text-danger'>@error('vacation'){{ $message }} @enderror</span>
											</div>
											<div class="form-group">
													<label>City</label>
													<input type="text" class="form-control" name="city" id="city" placeholder="Enter City"value="{{$editUser->city}}">
													<span class='text-danger'>@error('city'){{ $message }} @enderror</span>
											</div>
											<div class="form-group">
													<label>NID</label>
													<input type="text" class="form-control" name="nid" id="nid" placeholder="Enter nid Number"value="{{$editUser->nid}}">
													<span class='text-danger'>@error('nid'){{ $message }} @enderror</span>
											</div>

									<!-- Photo -->
											<div class="form-group my-2">
													<div class="input-group mb-3">
															<div class="input-group-prepend">
																			<span>Photo</span>
															</div>
															<img id="image" style="width: 100px;height: 100px;object: cover;"  src="{{ $editUser->photo}}"/><br />
															<div class="fileUpload btn btn-success waves-effect waves-light" style="margin-top:10px">
																	<span><i class="ion-upload m-r-5"></i>Upload</span>
																	<input type="file" name="photo" id="photo" accept="image/*" class="upload" class="form-control" onchange="readURL(this);" />
															</div>
															<input type="hidden" name="old_photo" value="{{ $editUser->photo }}">
													</div>
													
											</div>

											<button type="submit" class="btn btn-purple waves-effect waves-light w-sm m-b-5">Update</button>

									</form>


							</div><!-- panel-body -->
					</div> <!-- panel -->
			</div> <!-- col-->
</div>

@endsection