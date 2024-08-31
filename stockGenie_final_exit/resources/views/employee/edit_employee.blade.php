@extends('layouts.layout')
@section('main')
<style>
	label {
		width: auto;
	}
</style>
<div class="row " style="display:flex;justify-content:center;align-item:center;">
	<!-- Basic example -->

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
		<div class="panel panel-info">
			<div class="panel-heading " style="display: flex;justify-content: space-between;">

				<h3 class="panel-title text-white">Edit Employee</h3>
				<a class="panel-title fs-4" href="{{URL::to('/all-employee')}}">
					<i class="bi bi-box-arrow-in-left" style="font-size:24px;color:white;"></i>
				</a>
			</div>

			<div class="panel-body">

				<form role="form" action="{{ URL::to('update-employee'.$editUser->id) }}" method="post"
					enctype="multipart/form-data">
					@csrf

					<div class="row">
						<div class="col-sm-10 col-md-4 col-lg-3">
							<!-- Photo -->
							<div class="form-group my-2">
								<div class="input-group mb-3"
									style="display: flex;justify-content: center;align-items: center;flex-direction: column;">
									<div class="input-group-prepend">
										<span>Photo</span>
									</div>
									<img id="image" style="width: 190px;height: 190px; object: cover; border-radius: 16px;"
										src="{{ $editUser->photo}}" /><br />
									<div class="fileUpload btn btn-success waves-effect waves-light" style="margin-top:10px">
										<span><i class="ion-upload m-r-5"></i>Upload</span>
										<input type="file" name="photo" id="photo" accept="image/*" class="upload" class="form-control"
											onchange="readURL(this);" />
										<input type="hidden" name="old_photo" value="{{ $editUser->photo }}">
									</div>
								</div>
								<span class='text-danger'>@error('photo'){{ $message }} @enderror</span>
							</div>

						</div>
						<div class="col-sm-12 col-md-4 col-lg-4">
							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"
									value="{{$editUser->name}}">
								<span class='text-danger'>@error('name'){{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label>NID</label>
								<input type="text" class="form-control" name="nid" id="nid" placeholder="Enter nid Number"
									value="{{$editUser->nid}}">
								<span class='text-danger'>@error('nid'){{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label>Phone Number</label>
								<input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number"
									value="{{$editUser->phone}}">
								<span class='text-danger'>@error('phone'){{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label>Email address</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="Enter email"
									value="{{$editUser->email}}">
								<span class='text-danger'>@error('email'){{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label>Address</label>
								<input type="text" class="form-control" name="address" id="address" placeholder="Enter address"
									value="{{$editUser->address}}">
								<span class='text-danger'>@error('address'){{ $message }} @enderror</span>
							</div>

						</div>
						<div class="col-sm-12 col-md-4 col-lg-4">

							<div class="form-group">
								<label>Experience</label>
								<input type="text" class="form-control" name="experience" id="experience" placeholder="Enter experience"
									value="{{$editUser->experience}}">
								<span class='text-danger'>@error('experience'){{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label>Salary</label>
								<input type="text" class="form-control" name="salary" id="salary" placeholder="Enter salary"
									value="{{$editUser->salary}}">
								<span class='text-danger'>@error('salary'){{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label>Vacation</label>
								<input type="text" class="form-control" name="vacation" id="vacation" placeholder="Enter vacation"
									value="{{$editUser->vacation}}">
								<span class='text-danger'>@error('vacation'){{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label>City</label>
								<input type="text" class="form-control" name="city" id="city" placeholder="Enter City"
									value="{{$editUser->city}}">
								<span class='text-danger'>@error('city'){{ $message }} @enderror</span>
							</div>

						</div>
					</div>

					<div class="form-group mx-2 my-2" style="text-align:center">
						<button type="submit" class="btn btn-purple waves-effect waves-light w-sm m-b-5">Update</button>
					</div>
				</form>

			</div><!-- panel-body -->
		</div> <!-- panel -->
	</div> <!-- col-->
</div>

@endsection