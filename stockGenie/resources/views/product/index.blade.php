@extends('dashboard')

@section('main')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">All Product</h3>
				<a class="panel-title fs-4" href="#"class="btn btn-info waves-effect waves-light w-sm" data-toggle="modal" data-target="#addProductModal">
					<i class="bi bi-bag-plus" style="font-size:24px;color:white;font-weight:800;"></i>
				</a>
			</div>
			<div class="panel-body">
				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">
						<table id="dataTable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Category</th>
									<th>Supplier</th>
									<th>Code</th>
									<th>Garage</th>
									<th>Route</th>
									<th>Quantity</th>
									<th>Buy Date</th>
									<th>Expire Date</th>
									<th>Buying Price</th>
									<th>Selling Price</th>
									<th>Image</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($products as $product)
								<tr>
									<td>{{ $product->product_name }}</td>
									<td>{{ $product->cat_id }}</td>
									<td>{{ $product->sup_id }}</td>
									<td>{{ $product->product_code }}</td>
									<td>{{ $product->product_garage }}</td>
									<td>{{ $product->product_route }}</td>
									<td>{{ $product->product_qty }}</td>
									<td>{{ $product->buy_date }}</td>
									<td>{{ $product->expire_date }}</td>
									<td>{{ $product->buying_price }}</td>
									<td>{{ $product->selling_price }}</td>
									<td><img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" width="50">
									</td>
									<td>
										<button class="btn btn-primary edit-btn waves-effect waves-light w-sm" data-id="{{ $product->id }}">Edit</button>
										<form action="{{ route('products.destroy', $product->id) }}" method="POST"
											style="display:inline-block;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger waves-effect waves-light w-sm delete-btn">Delete</button>
										</form>
									</td>
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

@include('product.modal')

@endsection

@section('scripts')
<script>
	$(document).on('click', '.edit-btn', function () {
		var id = $(this).data('id');
		$.get('/products/' + id + '/edit', function (data) {
			$('#editProductModal input[name="product_name"]').val(data.product_name);
			$('#editProductModal input[name="cat_id"]').val(data.cat_id);
			$('#editProductModal input[name="sup_id"]').val(data.sup_id);
			$('#editProductModal input[name="product_code"]').val(data.product_code);
			$('#editProductModal input[name="product_garage"]').val(data.product_garage);
			$('#editProductModal input[name="product_route"]').val(data.product_route);
			$('#editProductModal input[name="product_qty"]').val(data.product_qty);
			$('#editProductModal input[name="buy_date"]').val(data.buy_date);
			$('#editProductModal input[name="expire_date"]').val(data.expire_date);
			$('#editProductModal input[name="buying_price"]').val(data.buying_price);
			$('#editProductModal input[name="selling_price"]').val(data.selling_price);
			$('#editProductModal form').attr('action', '/products/' + id);
			$('#editProductModal').modal('show');
		});
	});
</script>
@endsection