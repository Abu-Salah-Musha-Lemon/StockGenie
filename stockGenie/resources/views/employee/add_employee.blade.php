@extends('layouts.layout')
@section('main')

<style>
	label{
		width:auto;
	}
</style>
	<div class="row "style="display:flex;justify-content:center;align-item:center;">
				<!-- Basic example -->
				<div class=" col-md-4 col-lg-8 col-xl-10">
					<div class="panel panel-info">
					<div class="panel-heading " style="display: flex;justify-content: space-between;">
									<h3 class="panel-title">Add Employee</h3>
									<a class="panel-title fs-4" href="{{URL::to('/all-employee')}}">
											<i class="bi bi-box-arrow-in-left"style="font-size:24px"></i>
									</a>
					</div>
							<div class="panel-body">

							<form role="form" action="{{ route('addEmployee') }}" method="post" enctype="multipart/form-data">
								@csrf
							
								<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Name"value="{{old('email')}}">
										<span class='text-danger'>@error('name'){{ $message }} @enderror</span>
								</div>

								<div class="form-group">
										<label>Email address</label>
										<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email" value="{{old('email')}}">
										<span class='text-danger'>@error('email'){{ $message }} @enderror</span>
								</div>

								<div class="form-group">
										<label>Phone Number</label>
										<input type="tel"  pattern="[0-9]{3}[0-9]{4}[0-9]{4}"  class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Enter Your Phone Number (01978977465) " value="{{old('phone')}}">
										<span class='text-danger'>@error('phone'){{ $message }} @enderror</span>
								</div>

								<div class="form-group">
										<label>Address</label>
										<input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter address" value="{{old('address')}}">
										<span class='text-danger'>@error('address'){{ $message }} @enderror</span>
								</div>
								<div class="form-group">
										<label>Experience</label>
										<input type="text" class="form-control @error('experience') is-invalid @enderror" name="experience" placeholder="Enter experience" value="{{old('experience')}}">
										<span class='text-danger'>@error('experience'){{ $message }} @enderror</span>
								</div>

								<div class="form-group">
										<label>Salary</label>
										<input type="text" class="form-control @error('salary') is-invalid @enderror" name="salary" placeholder="Enter salary" value="{{old('salary')}}">
										<span class='text-danger'>@error('salary'){{ $message }} @enderror</span>
								</div>
								<div class="form-group">
										<label>Vacation</label>
										<input type="text" class="form-control @error('vacation') is-invalid @enderror" name="vacation" placeholder="Enter vacation" value="{{old('vacation')}}">
										<span class='text-danger'>@error('vacation'){{ $message }} @enderror</span>
								</div>
								<div class="form-group">
										<label>City</label>
										<input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="Enter City" value="{{old('city')}}">
										<span class='text-danger'>@error('city'){{ $message }} @enderror</span>
								</div>
								<div class="form-group">
										<label>NID</label>
										<input type="text" class="form-control @error('nid') is-invalid @enderror" name="nid" placeholder="Enter nid Number" value="{{old('nid')}}">
										<span class='text-danger'>@error('nid'){{ $message }} @enderror</span>
								</div>

								<!-- Photo -->
								<div class="form-group my-2">
										<div class="input-group mb-3">
												<div class="input-group-prepend">
														<span>Photo</span>
												</div>
												<img id="image" style="width: 100px;height: 100px;object: cover;" /><br />
												<!-- <input type="file" name="photo" id="photo" accept="image/*" class="upload" class="form-control" onchange="readURL(this);" /> -->
												<div class="fileUpload btn btn-success waves-effect waves-light" style="margin-top:10px">
														<span><i class="ion-upload m-r-5"></i>Upload</span>
														<input type="file" name="photo" id="photo" accept="image/*" class="upload" class="form-control" onchange="readURL(this);" />
												</div>
										</div>
										<span class='text-danger'>@error('photo'){{ $message }} @enderror</span>
								</div>


								<button type="submit" class="btn btn-success waves-effect waves-light w-sm m-b-5">Submit</button>

						</form>


							</div><!-- panel-body -->
					</div> <!-- panel -->
	</div> <!-- col-->
	
</div>

@endsection