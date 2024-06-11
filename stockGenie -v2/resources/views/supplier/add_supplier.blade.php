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
		<div class="panel panel-primary">
				
				<div class="panel-heading " style="display: flex;justify-content: space-between;">
								<h3 class="panel-title text-white">Add Supplier </h3>
								<a class="panel-title fs-4" href="{{URL::to('/all-supplier')}}">
								<i class="bi bi-box-arrow-in-left"style="font-size:24px;color:white"></i>
								</a>
				</div>
				<div class="panel-body">
						<form role="form" action="{{ URL::to('/insert-supplier') }}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" name="name" placeholder="Enter Name"  value="{{old('name')}}"/>
										<span class="text-danger">@error('name'){{$message}}@enderror</span>
								</div>

								<div class="form-group">
										<label>Email address</label>
										<input type="email" class="form-control" name="email" placeholder="Enter email" value="{{old('email')}}" />
										<span class="text-danger">@error('email'){{$message}}@enderror</span>
								</div>

								<div class="form-group">
										<label>Phone Number</label>
										<input type="tel" class="form-control" name="phone"
												placeholder="Enter Phone Number" value="{{old('phone')}}" />
												<span class="text-danger">@error('phone'){{$message}}@enderror</span>
								</div>

								<div class="form-group">
										<label>Address</label>
										<input type="text" class="form-control" name="address"
												placeholder="Enter address" value="{{old('address')}}" />
												<span class="text-danger">@error('address'){{$message}}@enderror</span>
								</div>
								<div class="form-group">
										<label>Type</label>
										<select name="type" id="type"class="form-control">
												<option disabled="" selected="">Select</option>
												<option value="Distributer">Distributer</option>
												<option value="WholeSeller">Whole Seller</option>
												<option value="Broker">Broker</option>
										</select>
										<span class="text-danger">@error('type'){{$message}}@enderror</span>
								</div>

								<div class="form-group">
										<label>shopeName</label>
										<input type="text" class="form-control" name="shopeName"
												placeholder="Enter shopeName" value="{{old('shopeName')}}" />
												<span class="text-danger">@error('shopeName'){{$message}}@enderror</span>
								</div>
								<div class="form-group">
										<label>Account Holder Name</label>
										<input type="text" class="form-control" name="account_holder"
												placeholder="Enter Account Holder Name" value="{{old('')}}" />
												<span class="text-danger">@error('account_holder'){{$message}}@enderror</span>
								</div>
								<div class="form-group">
										<label>Account Number</label>
										<input type="text" class="form-control" name="account_number"
												placeholder="Enter Account Number"  value="{{old('account_number')}}"/>
												<span class="text-danger">@error('account_number'){{$message}}@enderror</span>
								</div>
								<div class="form-group">
										<label>Bank Name</label>
										<input type="text" class="form-control" name="bank_name"
												placeholder="Enter Bank Name" value="{{old('bank_name')}}" />
												<span class="text-danger">@error('bank_name'){{$message}}@enderror</span>
								</div>
								<div class="form-group">
										<label>Bank Branch Name</label>
										<input type="text" class="form-control" name="bank_branch"
												placeholder="Enter Bank Branch Name" value="{{old('bank_branch')}}" />
												<span class="text-danger">@error('bank_branch'){{$message}}@enderror</span>
								</div>
								<div class="form-group">
										<label>City</label>
										<input type="text" class="form-control" name="city" placeholder="Enter City" value="{{old('city')}}" />
										<span class="text-danger">@error('city'){{$message}}@enderror</span>
								</div>

									<!-- Photo -->
									<div class="form-group my-2 mb-2">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span>Photo</span>
											</div>
											<img id="image" style="width: 100px;height: 100px;object: cover;" /><br />
									
											
											<div class="fileUpload btn btn-success waves-effect waves-light" style="margin-top:10px">
													<span><i class="ion-upload m-r-5"></i>Upload</span>
													<input type="file" name="photo" id="photo" accept="image/*" class="upload" class="form-control" onchange="readURL(this);" value="{{old('photo')}}"/>
											</div>

											<span class="text-danger">@error('photo'){{$message}}@enderror</span>
									</div>
									<br>
								<button type="submit" class="btn btn-purple btn-custom waves-effect waves-light m-b-5">
										Submit
								</button>
						</form>
				</div>
				<!-- panel-body -->
		</div>
		<!-- panel -->
</div>
<!-- col-->
</div>
                     
 @endsection


