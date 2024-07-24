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
				<h3 class="panel-title text-white">View Employee</h3>
				<a class="panel-title fs-4" href="{{URL::to('/all-employee')}}">
					<i class="bi bi-box-arrow-in-left" style="font-size:24px;color:white;"></i></a>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-10 col-md-4 col-lg-4">

						<!-- Photo -->
						<div class="form-group my-2">
							<div class="input-group mb-3"
								style="display: flex;justify-content: center;align-items: center;flex-direction: column;">
								<div class="input-group-prepend">
									<span>Product Photo</span>
								</div>
								<img id="image" style="width: 190px;height: 190px;border-radius:16px;border:1px solid rgba(0 0 0 0.1) "
									src="{{ $single->photo}}" /><br />
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">

						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$single->name}}"
								disabled>
						</div>

						<div class="form-group">
							<label>NID</label>
							<input type="text" class="form-control" name="nid" placeholder="Enter NID Number" value="{{$single->nid}}"
								disabled>

						</div>

						<div class="form-group">
							<label>Phone Number</label>
							<input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number"
								value="{{$single->phone}}" disabled>
						</div>

						<div class="form-group">
							<label>Email address</label>
							<input type="email" class="form-control" name="email" placeholder="Enter email" value="{{$single->email}}"
								disabled>
						</div>



						<div class="form-group">
							<label>Address</label>
							<input type="text" class="form-control" name="address" placeholder="Enter address"
								value="{{$single->address}}" disabled>
						</div>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Experience</label>
							<input type="text" class="form-control" name="experience" placeholder="Enter experience"
								value="{{$single->experience}}" disabled>
						</div>

						<div class="form-group">
							<label>Salary</label>
							<input type="text" class="form-control" name="salary" placeholder="Enter salary"
								value="{{$single->salary}}" disabled>
						</div>
						<div class="form-group">
							<label>Vacation</label>
							<input type="text" class="form-control" name="vacation" placeholder="Enter vacation"
								value="{{$single->vacation}}" disabled>
						</div>
						<div class="form-group">
							<label>City</label>
							<input type="text" class="form-control" name="city" placeholder="Enter City" value="{{$single->city}}"
								disabled>
						</div>

					</div>
				</div>


			</div><!-- panel-body -->
		</div> <!-- panel -->
	</div> <!-- col-->
</div>
@endsection