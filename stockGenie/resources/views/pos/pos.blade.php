@extends('layouts.layout')
@section('main')

<style>
	label {
		width: auto;
	}
</style>

<!-- Modal -->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<form role="form" action="{{ route('addCustomer') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Add Customer</h4>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-1" class="control-label">Name</label>
								<input type="text" class="form-control" id="field-1" placeholder="Lemon" name="name"
									value="{{old('name')}}">
								<span class='text-danger'>@error('name'){{ $message }} @enderror</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-3" class="control-label">Phone</label>
								<input type="text" class="form-control" id="field-2" placeholder="01978970460" name="phone"
									value="{{old('phone')}}">
								<span class='text-danger'>@error('phone'){{ $message }} @enderror</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-1" class="control-label">Email</label>
								<input type="email" class="form-control" id="field-1" placeholder="lemon@gmail.com" name="email"
									value="{{old('email')}}">
								<span class='text-danger'>@error('email'){{ $message }} @enderror</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="field-3" class="control-label">City</label>
								<input type="text" class="form-control" id="field-2" placeholder="Dhaka" name="city"
									value="{{old('city')}}">
								<span class='text-danger'>@error('city'){{ $message }} @enderror</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="field-1" class="control-label">Address</label>
								<input type="text" class="form-control" id="field-1" placeholder="Dhaka" name="address"
									value="{{old('address')}}">
								<span class='text-danger'>@error('address'){{ $message }} @enderror</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="field-1" class="control-label">Bank Name</label>
								<input type="text" class="form-control" id="field-1" placeholder="ASM Bank" name="bank_name"
									value="{{old('bank_name')}}">
								<span class='text-danger'>@error('bank_name'){{ $message }} @enderror</span>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="field-3" class="control-label">Bank Branch Name</label>
								<input type="text" class="form-control" id="field-2" placeholder="Jatrabari" name="bank_branch"
									value="{{old('bank_branch')}}">
								<span class='text-danger'>@error('bank_branch'){{ $message }} @enderror</span>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="field-3" class="control-label">Account Number</label>
								<input type="text" class="form-control" id="field-2" placeholder="1978970460" name="account_number"
									value="{{old('account_number')}}">
								<span class='text-danger'>@error('account_number'){{ $message }} @enderror</span>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="field-1" class="control-label">Account Holder Name</label>
								<input type="text" class="form-control" id="field-1" placeholder="ASM123S" name="account_holder"
									value="{{old('account_holder')}}">
								<span class='text-danger'>@error('account_holder'){{ $message }} @enderror</span>
							</div>
						</div>
					</div>
					<!-- More form fields... -->

				</div>
				<div class="modal-footer">
					<button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal"
						onclick="clearFields()">Close</button>
					<button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- /.modal -->


<div class="row">

	<div class="col-md-5">
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
					<!-- <h3 class="portlet-title text-dark text-uppercase">Customer Product</h3>
                <button class="btn btn-primary waves-effect waves-light" style="margin:4px" 
                data-toggle="modal" data-target="#con-close-modal">Add Customer</button> -->
				</div>

				<div class="form-group">
					@php
					$cust = DB::table('customers')->get();
					@endphp
					<form action="{{ URL::to('/create-invoice') }}" method="get">
						@csrf

						<button type="submit" class="btn btn-success w-md waves-effect waves-light">Check invoice</button>


					</form>
				</div>


				<div class="card-body">
					<div class="col-sm-6 col-md-6 col-lg-3 mt-2" style="width:100%">
						<div class="price_card text-center">
							<div class="pricing-header ">
								<table class="table">
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
											<!-- <th scope="col" style="width: 25%;">Discount (%)</th> -->

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
														<input type="number" name="qty" id="" min="0" value="{{$p->qty}}" class="form-control"
															style="margin:0px;padding:0px;">
														<button type="submit" class="btn btn-success  waves-effect waves-light m-0 p-0">
															<i class="bi bi-check2-circle" style="font-size:22px"></i>
														</button>
													</div>
												</form>
											</td>
											<!-- <td style="width: 25%;">
                                                    <form action="{{URL::to('/update-card/'.$p->rowId)}}" method="post" >
                                                            @csrf
                                                            <div class="qty"style="">
                                                            <input type="number" name="discount" min="0" value="{{$p->discount}}" min="1" class="form-control"style="margin:0px;padding:0px;">
                                                                    <button type="submit" class="btn btn-success m-0 p-0">
                                                                            <i class="bi bi-check2-circle"style="font-size:22px"></i>
                                                                    </button>
                                                            </div>
                                                    </form>
                                                </td> -->

											<td style="width: 25%;">{{$p->price*$p->qty}} ৳</td>
											<td>
												<a href="{{ URL::to('/delete-cart/'.$p->rowId) }}" class="btn  m-0" style="padding:2px">
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

						</div> <!-- end Pricing_card -->
					</div> <!-- end col -->
				</div>
			</div>
		</div>
	</div>



	<div class="col-md-7">
		<div class="grid-container">
			<div class="card shadow-sm">
				<div class="card-title " style="display: flex;justify-content: space-between;align-items: center; ">
					<h3 class="portlet-title text-dark text-uppercase"> Products </h3>
					<a href="{{URL::to('update-product-qty-view')}}" class="btn btn-primary waves-effect waves-light float-right"
						style="margin:4px">Update Product Qty</a>
				</div>
				<div class="card-body">

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
								<td>{{ $row->product_qty }}</td>
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

@endsection