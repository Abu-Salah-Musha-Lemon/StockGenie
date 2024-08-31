@extends('layouts.layout')
@section('main')

<style>
	label {
		width: auto;
	}
</style>
@include('customer.customerModel')
<!-- final Invoice Model -->
 @include('pos.finalInvoice')
<!-- /.modal -->


<div class="row">

	<div class="col-sm-12 col-md-5 col-lg-5 mt-2">
		<div class="grid-container">
			<div class="card shadow-sm">
				<div class="customer">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary waves-effect waves-light" data-toggle="modal"
						data-target="#finalInvoice">Check invoice</button>

				</div>

				<div class="card-body">
					<div class="col-sm-6 col-md-4 col-lg-3 mt-2" style="width:100%;padding:2px">
						<div class="price_card text-center" style="margin:0px;padding:0px">
							<div class="pricing-header ">
							<div class="table-responsive"style="margin:0px;padding: 6px;border: 1px solid rgba(255,255,255,.5);border-radius: 4px;">
								<table  class="table table-striped table-bordered"style="margin:0px;padding:0px">
									<style>
										.th_color {
											width: 25%;
											color: white;
											font-weight: bold;
											font-size: 17px;
										}
									</style>
									<thead>
										<tr class="bg-purple" style="width: 100%;">
											<th class="text-white d-flex text-center" scope="col" style="width: 25%;">Name</th>
											<th class="text-white d-flex text-center" scope="col" style="width: 25%;">Single Prize</th>
											<th class="text-white d-flex text-center" scope="col" style="width: 25%;">Qty</th>
											<th class="text-white d-flex text-center" scope="col" style="width: 25%;">Sup Total</th>
											<th class="text-white d-flex text-center" scope="col" style="width: 25%;">Action</th>
										</tr>
									</thead>
									<style>
										.qty {
											display: flex;
											justify-content: center;
											align-items: space-between;
										}

										.c-btn {
											cursor: pointer;
											width: 40px;
											height: 40px;
											margin-top: 6px;
										}
									</style>
									<tbody>
										@php
										$products = Cart::content();
										@endphp
										@foreach($products as $p)
										<tr>
											<td style="width: 25%;">{{$p->name}}</td>
											<td style="width: 25%;">{{$p->price}} ৳</td>
											<td style="width: 40%; text-align: center;">
												<form action="{{URL::to('/update-card/'.$p->rowId)}}" method="post">
													@csrf
													<div class="qty" style="">
														<input type="number" name="qty" id="" min="0" value="{{$p->qty}}"
															class="form-control text-center" style="margin:0px;padding:0px;">
														<button type="submit" class="btn btn-success  waves-effect waves-light m-0 p-0" style="display: flex;
															justify-content: center;
															align-items: center;">
															<i class="bi bi-check2-circle" style="font-size: 20px;    margin: 2px;"></i>
														</button>
													</div>
												</form>
											</td>

											<td style="width: 25%;">{{$p->price*$p->qty}} ৳</td>
											<td>
												<a href="{{ URL::to('/delete-cart/'.$p->rowId) }}" class="btn  m-0" style="padding:2px">
													<!-- <img src="{{asset('images/icons/system-regular-39-trash.gif')}}" style="width:25px;height:25px" alt="" srcset=""> -->
													<i class="bi bi-trash3 text-danger" style="font-size:22px"></i>
												</a>
											</td>
										</tr>
										@endforeach
									</tbody>

									<tfoot class="bg-success">
										<tr>
											<td colspan="3">Prize::</td>
											<td colspan="2">: {{Cart::subtotal();}} ৳</td>
										</tr>
										<tr>
											<td colspan="3">Qty::</td>
											<td colspan="2">: {{Cart::count();}}</td>
										</tr>
										<tr>
											<td colspan="3">Vat::</td>
											<td colspan="2">:{{Cart::tax();}} ৳</td>
										</tr>
										<tr>
											<td colspan="3">Total::</td>
											<td colspan="2">: {{Cart::total();}} ৳</td>
										</tr>

									</tfoot>
								</table>
									</div>
							</div>

						</div> <!-- end Pricing_card -->
					</div> <!-- end col -->
				</div>
			</div>
		</div>
	</div>



	<div class="col-sm-12 col-md-7 col-lg-7 mt-2">
		<div class="grid-container">
			<div class="card shadow-sm">
				<div class="card-title " style="display: flex;justify-content: space-between;align-items: center; ">
					<h3 class="portlet-title text-dark text-uppercase"> Products </h3>

					@include('product.add_product_modal')
					<a class="btn btn-primary btn-custom waves-effect waves-light " data-toggle="modal"
						data-target="#addProductsModal">
						Add Product
					</a>
				</div>
				<div class="card-body">

					<div class="table-responsive">
						<table id="dataTable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Action</th>
									<th>Image</th>
									<th>Name</th>
									<th>Qty</th>
									<th>Code</th>
									<th>Price</th>
									<th>Route</th>
								</tr>
							</thead>
							<tbody>
								@foreach($product as $row)
								<tr style="text-align:center">
									<td>
										<form action="{{ URL::to('/add-card') }}" method="post">
											@csrf
											<input type="hidden" name="id" value="{{ $row->id }}">
											<input type="hidden" name="name" value="{{ $row->product_name }}">
											<input type="hidden" name="qty" value="1">
											<input type="hidden" name="price" value="{{ $row->selling_price }}">
											<button type="submit" class="btn btn-primary" class="c-btn">
												<i class="bi bi-bag-plus-fill" style="font-size:20px"></i>
											</button>
										</form>
									</td>
									<td><img src="{{ asset($row->product_image) }}" style="width:40px;height:40px;object:cover;"></td>
									<td>{{ $row->product_name }}</td>
									<td>
										<p class="btn btn-{{ $row->product_qty < 5 ? 'danger' : 'success' }} shadow-none">{{
											$row->product_qty
											}}</p>
									</td>
									<td>{{ $row->product_code }}</td>
									<td>{{ $row->selling_price }} ৳</td>
									<td>{{ $row->product_route }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				</div>

			</div>
		</div>
	</div>

</div>
@section('script')
<script>
    $(document).ready(function () {
        initializeDataTable([	'Name'	,'Qty','Code',	'Price',	'Route']);
    });
    </script>
@endsection

@endsection