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
				<h3 class="panel-title text-white">show Employee</h3>
				<a class="panel-title fs-4" href="{{URL::to('/all-product')}}">
					<i class="bi bi-box-arrow-in-left" style="font-size:24px;color:white;"></i>
				</a>
			</div>

			<div class="panel-body">
				
					<div class="row"
						style="display: flex;justify-content: center;align-items: center;justify-content: space-between;">
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
										src="{{ asset($show->product_image) }}" /><br />
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" class="form-control" name="product_name" value="{{$show->product_name}}" disabled>
							</div>

							<div class="form-group">
								<label>Categories Name</label>
								<input type="text" class="form-control" value="{{$show->category_name}}" disabled>
							</div>
							<div class="form-group">
								<label>Suppliers Name</label>
								<input type="text" class="form-control" value="{{$show->name}}" disabled>
							</div>

							<div class="form-group">
								<label>Product Code</label>
								<input type="text" class="form-control" name="product_code" value="{{$show->product_code}}" disabled>
							</div>
							<div class="form-group">
								<label>Product Quantity</label>
								<input type="text" class="form-control" name="product_qty" value="{{$show->product_qty}}" disabled>
							</div>
							<div class="form-group">
								<label>Product Garage</label>
								<input type="text" class="form-control" name="product_garage" value="{{$show->product_garage}}"
									disabled>
							</div>

						</div>
						<div class="col-md-4 col-lg-4">
							<div class="form-group">
								<label>Product Route</label>
								<input type="text" class="form-control" name="product_route" value="{{$show->product_route}}" disabled>
							</div>
							<div class="form-group">
								<label>Product Buying Date</label>
								<input type="date" class="form-control" name="buy_date" value="{{$show->buy_date}}" disabled>
							</div>
							<div class="form-group">
								<label>Product Expire Date</label>
								<input type="date" class="form-control" name="expire_date" value="{{$show->expire_date}}" disabled>
							</div>
							<div class="form-group">
								<label>Product Buying Prize</label>
								<input type="number" class="form-control" name="buying_price" value="{{$show->buying_price}}" disabled>
							</div>
							<div class="form-group">
								<label>Product Selling Prize</label>
								<input type="number" class="form-control" name="selling_price" value="{{$show->selling_price}}"
									disabled>
							</div>
						</div>
					</div>
			</div><!-- panel-body -->
		</div> <!-- panel -->
	</div> <!-- col-->
</div>
@endsection