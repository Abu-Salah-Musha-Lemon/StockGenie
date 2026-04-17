@extends('layouts.layout')
@section('main')
<style>
	label {
		width: auto;
	}
</style>

<div class="row" style="display:flex;justify-content:center;align-item:center;">
	<!-- Basic example -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">Edit Employee</h3>
				<a class="panel-title fs-4" href="{{URL::to('/all-product')}}">
					<i class="bi bi-box-arrow-in-left" style="font-size:24px;color:white;"></i>
				</a>
			</div>

			<div class="panel-body">
				@include('supplier.add_supplier_modal')
				<a class="btn btn-primary btn-custom waves-effect waves-light " data-toggle="modal" data-target="#addSupplierModal">
					<i class="bi bi-truck-flatbed" style="font-size:18px;font-weight:bolder;"></i>
				</a>
				@include('category.add_category_modal')
				<a class="btn btn-purple btn-custom waves-effect waves-light " data-toggle="modal" data-target="#addCategoryModal">
					<i class="bi bi-journal-plus" style="font-size:18px;font-weight:bolder;"></i>
				</a>

				<form role="form" action="{{ URL::to('update-product/'.$edit->id) }}" method="post"
					enctype="multipart/form-data" style="margin-top:10px">
					@csrf
					<div class="row">
						<div class="col-md-4 col-lg-4">

							<!-- Photo -->
							<div class="form-group my-2">
								<div class="input-group mb-3"
									style="display: flex;justify-content: center;align-items: center;flex-direction: column;">
									<div class="input-group-prepend">
										<span>Product Photo</span>
									</div>
									<img id="image"
										style="width: 190px;height: 190px;border-radius:16px;border:1px solid rgba(0 0 0 0.1) "
										src="{{ asset($edit->product_image) }}" /><br />

									<div class="fileUpload btn btn-success waves-effect waves-light" style="margin:5px 0 5px 0">
										<span><i class="ion-upload m-r-5"></i>Upload</span>
										<input type="file" name="photo" id="photo" accept="image" class="upload" class="form-control"
											onchange="readURL(this);" />
									</div>
									<input type="hidden" name="old_photo" value="{{ $edit->product_image }}">
									<span class='text-danger'>@error('old_photo'){{$message}}@enderror</span>
								</div>
							</div>
						</div>

						<div class="col-md-4 col-lg-4">
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" class="form-control" name="product_name" value="{{$edit->product_name}}">
								<span class='text-danger'>@error('product_name'){{$message}}@enderror</span>
							</div>

							<div class="form-group">
								@php
								$cat =DB::table('category')->get();
								@endphp
								<label>category Name</label>
								<select name="cat_id" id="cat_id" class="form-control">
									<option disabled="" selected="">Select</option>

									@foreach($cat as $row)
									<option value="{{$row->id}}" <?php if ($edit->cat_id ==$row->id) {
										echo 'selected';
										}?>>{{$row->category_name}}</option>
									@endforeach

								</select>
								<span class='text-danger'>@error('cat_id'){{$message}}@enderror</span>
							</div>
							<div class="form-group">
								@php
								$sup =DB::table('suppliers')->get();
								@endphp
								<label>Suppliers Name </label>
								<select name="sup_id" class="form-control">
									<option disabled="" selected="">Select</option>

									@foreach($sup as $row)
									<option value="{{$row->id}}" <?php if ($edit->sup_id ==$row->id) {
										echo 'selected';
										}?>>{{$row->name}}</option>
									@endforeach

								</select>
								<span class='text-danger'>@error('sup_id'){{$message}}@enderror</span>
							</div>

							<div class="form-group">
								<label>Product Code</label>
								<input type="text" class="form-control" name="product_code" value="{{$edit->product_code}}">
								<span class='text-danger'>@error('product_code'){{$message}}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Quantity</label>
								<input type="text" class="form-control" name="product_qty" value="{{$edit->product_qty}}">
								<span class='text-danger'>@error('product_qty'){{$message}}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Garage</label>
								<input type="text" class="form-control" name="product_garage" value="{{$edit->product_garage}}">
								<span class='text-danger'>@error('product_garage'){{$message}}@enderror</span>
							</div>

						</div>

						<div class="col-md-4 col-lg-4">
							<div class="form-group">
								<label>Product Route</label>
								<input type="text" class="form-control" name="product_route" value="{{$edit->product_route}}">
								<span class='text-danger'>@error('product_route'){{$message}}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Buying Date</label>
								<input type="date" class="form-control" name="buy_date" value="{{$edit->buy_date}}">
								<span class='text-danger'>@error('buy_date'){{$message}}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Expire Date</label>
								<input type="date" class="form-control" name="expire_date" value="{{$edit->expire_date}}">
								<span class='text-danger'>@error('expire_date'){{$message}}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Buying Prize</label>
								<input type="number" class="form-control" name="buying_price" value="{{$edit->buying_price}}">
								<span class='text-danger'>@error('buying_price'){{$message}}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Selling Prize</label>
								<input type="number" class="form-control" name="selling_price" value="{{$edit->selling_price}}">
								<span class='text-danger'>@error('selling_price'){{$message}}@enderror</span>
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-warning waves-effect waves-light w-lg m-b-5">Update</button>

				</form>


			</div><!-- panel-body -->
		</div> <!-- panel -->
	</div> <!-- col-->
</div>
@endsection