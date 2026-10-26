@extends('layouts.layout')
@section('main')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success">
			<div class="panel-heading" style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">Update Product Qty</h3>
				<a class="panel-title fs-4" href="{{ URL::to('/add-product') }}">
					<i class="bi bi-bag-plus" style="font-size:24px;color:white;font-weight:800;"></i>
				</a>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="dataTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Image</th>
										<th>Product Name</th>
										<th>Supplier Name</th>
										<th>Quantity</th>
										<th>Buying Price</th>
										<th>Selling Price</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>


									@foreach($productQty as $row)
									<tr>
										<td>
											<img src="{{ asset($row->product_image) }}" style="width:50px;height:50px;object-fit:cover;">
										</td>
										<td>{{ $row->product_name }}</td>

										<form action="{{ route('updateProductQtyPrice', $row->id) }}" method="GET">
											@csrf <!-- CSRF token for security -->

											<td>
												@php
												$suppliers = DB::table('suppliers')->get(); // Fetch all suppliers
												@endphp
												<!-- <input type="hidden" name="supplier_id" value="{{$row->suppliers_id}}"> -->
												<input type="hidden" name="product_id" value="{{$row->id}}">
												<select name="supplier_id" class="form-control" style="width:100%">
													<option disabled selected>Select Supplier</option>
													@foreach($suppliers as $supplier)
													<option name="supplier_id" value="{{ $supplier->id }}" {{ $supplier->id == $row->suppliers_id
														? 'selected' : '' }}>
														{{ $supplier->name }}
														<!-- Assuming 'name' is the column storing supplier name -->
													</option>
													@endforeach
												</select>
										</td>

											<td>
												<!-- Quantity input -->
												<input type="number" class="form-control" name="updateQty" min="0" placeholder="update qty"
													value="0">
												<input type="number" class="form-control" value="{{$row->product_qty}}" min="0" disabled>
											</td>

											<td>
												<!-- Buying price input -->
												<input type="number" class="form-control" name="buying_price" min="0" placeholder="update price"
													value="0">
												<input type="number" class="form-control" value="{{$row->buying_price}}" min="0" disabled>
											</td>

											<td>
												<!-- Selling price input -->
												<input type="number" class="form-control" name="selling_price" min="0"
													placeholder="update price" value="0">
												<input type="number" class="form-control" value="{{$row->selling_price}}" min="0" disabled>
											</td>

											<td>
												<!-- Update button for all fields -->
												<button type="submit"
													class="btn btn-success btn-custom waves-effect waves-light m-b-5">Update</button>
											</td>
										</form>
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
</div>

@section('script')
<script>
	function confirmation(ev) {
		ev.preventDefault();  // Prevent the default link behavior
		var urlToRedirect = ev.currentTarget.getAttribute('href');
		console.log(urlToRedirect);

		swal({
			title: "Are you sure to delete this Product?",
			text: "You will not be able to revert this!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				// Redirect if confirmed
				window.location.href = urlToRedirect;
			}
		});
	}


	$(document).ready(function () {
		initializeDataTable(['Product Name', 'Code', 'Quantity', 'Selling Price', 'Garage', 'Route']);
	});
</script>
@endsection

@endsection