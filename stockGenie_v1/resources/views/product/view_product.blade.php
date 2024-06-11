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
						<div class="panel panel-info">
						<div class="panel-heading " style="display: flex;justify-content: space-between;">
										<h3 class="panel-title" style="color:white">View Product</h3>
										<a class="panel-title fs-4" href="{{URL::to('/all-product')}}">
												<i class="bi bi-box-arrow-in-left"style="font-size:24px;color:white"></i>
										</a>
						</div>
								<div class="panel-body">

										<div class="form-group">
										
												<img  style="width: 100px;height: 100px;object: cover;" src="{{asset($show->product_image)}}"/><br />
												
										</div>
												<div class="form-group">
														<label>Product Name</label>
														<input type="text" class="form-control" value="{{$show->product_name}}" disabled>
												</div>
												<div class="form-group">
														<label>Categories Name</label>
														<input type="text" class="form-control" value="{{$show->categories_name}}" disabled>
												</div>
												<div class="form-group">
														<label>Suppliers Name</label>
														<input type="text" class="form-control" value="{{$show->name}}" disabled>
												</div>


												<div class="form-group">
														<label>Product Code</label>
														<input type="text" class="form-control" value="{{$show->product_code}}" disabled>
												</div>

												<div class="form-group">
														<label>Product Quantity</label>
														<input type="text" class="form-control" value="{{$show->product_qty}}" disabled>
												</div>

												<div class="form-group">
														<label>Product Garage</label>
														<input type="text" class="form-control" value="{{$show->product_garage}}"disabled >
												</div>
												<div class="form-group">
														<label>Product Route</label>
														<input type="text" class="form-control" value="{{$show->product_route}}"disabled >
												</div>
												<div class="form-group">
														<label>Product Buying Date</label>
														<input type="date" class="form-control" value="{{$show->buy_date}}" disabled>
												</div>
												<div class="form-group">
														<label>Product Expire Date</label>
														<input type="date" class="form-control" value="{{$show->expire_date}}" disabled>
												</div>
												<div class="form-group">
														<label>Product  Buying Prize</label>
														<input type="number" class="form-control" value="{{$show->buying_price}}" disabled>
												</div>
												<div class="form-group">
														<label>Product  Selling Prize</label>
														<input type="number" class="form-control" value="{{$show->selling_price}}"disabled >
												</div> 
								</div><!-- panel-body -->
						</div> <!-- panel -->
				</div> <!-- col-->
		</div>
@endsection