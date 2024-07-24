@extends('layouts.layout')
@section('main')
<style>
	label {
		width: auto;
	}
</style>


<div class="row" style="display:flex;justify-content:center;align-item:center;">
	<!-- Basic example -->

	<div class="col-xl-10 col-lg-8 col-md-6 col-12 m-auto">

		<div class="panel panel-info">
			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">Edit Supplier</h3>
				<a class="panel-title fs-4" href="{{URL::to('/all-supplier')}}">
					<i class="bi bi-box-arrow-in-left" style="font-size:24px;color:white;"></i>
				</a>
			</div>

			<div class="panel-body">

				<form role="form" action="{{ URL::to('/update-supplier'.$editUser->id) }}" method="post"
					enctype="multipart/form-data">

					@csrf
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"
							value="{{ $editUser->name }}">
						<span class="text-danger">@error('name') {{$message}}@enderror <span>
					</div>

					<div class="form-group">
						<label>Phone Number</label>
						<input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number"
							value="{{ $editUser->phone }}">
						<span class="text-danger">@error('phone') {{$message}}@enderror <span>
					</div>

					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" name="address" id="address" placeholder="Enter address"
							value="{{ $editUser->address }}">
						<span class="text-danger">@error('address') {{$message}}@enderror <span>
					</div>

					<div class="form-group">
						<label>Type</label><br>
						<select class="form-control" name="type" id="type">
							<option value="{{ $editUser->type }}">{{ $editUser->type }}</option>
							<!-- Add other options as needed -->
						</select>
						<span class="text-danger">@error('type') {{$message}}@enderror <span>
					</div>

					<div class="form-group">
						<label>shopName</label>
						<input type="text" class="form-control" name="shopName" id="shopName" value="{{ $editUser->shopName }}"
							placeholder="Enter shopName">
						<span class="text-danger">@error('shopName') {{$message}}@enderror <span>
					</div>
					<br>

					<button type="submit" class="btn btn-success btn-custom waves-effect waves-light">Update</button>

				</form>


			</div><!-- panel-body -->

		</div> <!-- panel -->

	</div> <!-- col-->
	
</div>




@endsection