@extends('layouts.layout')
@section('main')
<style>
	label {
		width: auto;
	}
</style>


<div class="row " style="display:flex;justify-content:center;align-item:center;">
	<!-- Basic example -->
	<div class=" col-md-6 col-lg-10 col-xl-10">

		<div class="panel panel-success">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">View Supplier</h3>
				<a class="panel-title fs-4" href="{{URL::to('/all-supplier')}}">
					<i class="bi bi-box-arrow-in-left" style="font-size:24px;color:white;font-weight:800;"></i>
				</a>
			</div>

			<div class="panel-body">

				<div class="row"style="display: flex;justify-content: center;align-items: center;justify-content: space-between;">

					<div class="col-md-6 col-lg-6">

						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $single->name }}"
								disabled>
						</div>

						<div class="form-group">
							<label>Phone Number</label>
							<input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number"
								value="{{ $single->phone }}" disabled>
						</div>

						<div class="form-group">
							<label>Address</label>
							<input type="text" class="form-control" name="address" placeholder="Enter address"
								value="{{ $single->address }}" disabled>
						</div>
					</div>

					<div class="col-md-6 col-lg-6">
						<div class="form-group">
							<label>Type</label>
							<input type="text" class="form-control" name="address" value="{{ $single->type}}" disabled>
						</div>

						<div class="form-group">
							<label>shopeName</label>
							<input type="text" class="form-control" name="shopName" value="{{ $single->shopName }}"
								placeholder="Enter shopeName" disabled>
						</div>
					</div>

				</div><!--  -->

			</div> <!--  panel-body-->

		</div> <!-- panel-->

	</div><!-- col -->
</div><!--  row -->


	@endsection