@extends('layouts.layout')
@section('main')

<style>
	label {
		width: auto;
	}
</style>


<div class="row" >
	<!-- Basic example -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">Add Product</h3>
				<a class="panel-title fs-4" href="{{URL::to('/all-product')}}">
					<i class="bi bi-box-arrow-in-left text-white" style="font-size:24px"></i>
				</a>
			</div>
			<div class="panel-body">
			@include('supplier.add_supplier_modal')
				<a class="btn btn-primary waves-effect waves-light " data-toggle="modal"
					data-target="#addSupplierModal">
					<i class="bi bi-truck-flatbed"style="font-size:24px;color:white;font-weight:800;"></i>
				</a>
				@include('category.add_category_modal')
				<a class="btn btn-primary waves-effect waves-light " data-toggle="modal"
					data-target="#addCategoryModal">
					<i class="bi bi-journal-plus"style="font-size:24px;color:white;font-weight:800;"></i>
				</a>
				<form role="form" action="{{ URL::to('/insert-product') }}" method="post" enctype="multipart/form-data"style="margin-top:10px">
					@csrf

					<div class="row">

						<div class="col-md-3 mx-2">
							<!-- Photo -->
							<div class="form-group my-2">
								<div class="input-group mb-3" style="display: flex;justify-content: center;align-items: center;flex-direction: column;">
									<div class="input-group-prepend">
										<span>Product Photo</span>
									</div>
									<img id="image"
										style="width: 190px;height: 190px;border-radius:16px;border:1px solid rgba(0 0 0 0.1) ">

									<div class="fileUpload btn btn-success waves-effect waves-light" style="margin-top:10px">
										<span><i class="ion-upload m-r-5"></i>Upload</span>
										<input type="file" name="photo" id="photo" accept="image/*" class="upload" class="form-control" style="width:100%"
											onchange="readURL(this);"  required/>
									</div>

									<span class='text-danger'>@error('photo'){{ $message }}@enderror</span>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" class="form-control @error('product_name') @enderror" name="product_name"
									placeholder="Enter Name" value="{{old('product_name')}}" required>
								<span class='text-danger'>@error('product_name'){{ $message }}@enderror</span>

							</div>

							<div class="form-group">
								@php
								$cat =DB::table('category')->get()
								@endphp
								<label>Category Name</label>

								<select name="cat_id" id="cat_id" class="form-control">
									<option disabled="" selected="">Select</option>

									@foreach($cat as $row)
									<option value="{{$row->id}}">{{$row->category_name}}</option>
									@endforeach

								</select>
								<span class='text-danger'>@error('cat_id'){{ $message }}@enderror</span>
							</div>
							<div class="form-group">
								@php
								$sup =DB::table('suppliers')->get();
								@endphp
								<label>Suppliers Name </label>
								<select name="sup_id" class="form-control">
									<option disabled="" selected="">Select</option>

									@foreach($sup as $row)
									<option value="{{$row->id}}">{{$row->name}}</option>
									@endforeach

								</select>
								<span class='text-danger'>@error('sup_id'){{ $message }}@enderror</span>

							</div>

							<div class="form-group">
								<label>Product Code</label>
								<input type="text" class="form-control" name="product_code" value="{{old('product_code')}}" placeholder="Enter Product Code" required>
								<span class='text-danger'>@error('product_code'){{ $message }}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Quantity</label>
								<input type="number" class="form-control" name="product_qty" value="{{old('product_qty')}}" placeholder="Enter Product Quantity" required>
								<span class='text-danger'>@error('product_qty'){{ $message }}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Garage</label>
								<input type="text" class="form-control" name="product_garage" value="{{old('product_garage')}}" placeholder="Enter Product Garage" required>
								<span class='text-danger'>@error('product_garage'){{ $message }}@enderror</span>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Product Route</label>
								<input type="text" class="form-control" name="product_route" value="{{old('product_route')}}" placeholder="Enter Product Route" required>
								<span class='text-danger'>@error('product_route'){{ $message }}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Buying Date</label>
								<input type="date" class="form-control" name="buy_date" value="{{old('buy_date')}}" placeholder="Enter Product Buying Date" required>
								<span class='text-danger'>@error('buy_date'){{ $message }}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Expire Date</label>
								<input type="date" class="form-control" name="expire_date" value="{{old('expire_date')}}" placeholder="Enter Product Expire Date" required>
								<span class='text-danger'>@error('expire_date'){{ $message }}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Buying Prize</label>
								<input type="number" class="form-control" name="buying_price" value="{{old('buying_price')}}" placeholder="Enter Product  Buying Prize" required>
								<span class='text-danger'>@error('buying_price'){{ $message }}@enderror</span>
							</div>
							<div class="form-group">
								<label>Product Selling Prize</label>
								<input type="number" class="form-control" name="selling_price" value="{{old('selling_price')}}"
									placeholder="Enter Product  Selling Prize" required>
								<span class='text-danger'>@error('selling_price'){{ $message }}@enderror</span>
							</div>
						</div>

					</div>


					<div class="form-group">

						<button type="submit" class="btn btn-success waves-effect waves-light w-sm m-b-5">Submit</button>
					</div>

				</form>


			</div><!-- panel-body -->
		</div> <!-- panel -->
	</div> <!-- col-->
</div>

@endsection