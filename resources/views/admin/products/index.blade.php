@extends('layouts.layout')
@section('main')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success">
			<div class="panel-heading" style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">All Product</h3>
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
										<th>bar Code</th>
										<th>Alert Quantity</th>
										<th>Selling Price</th>
										<th>Create at</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($products as $row)
									<tr>
										<td>
											<img src="{{ asset($row->product_image) }}" style="width:50px;height:50px;object-fit:cover;">
										</td>
										<td>{{ $row->name }}</td>
										<td>{{ $row->barcode }}</td>
										<td>{{ $row->alert_qty }}</td>
										<td>{{ $row->sale_price }}</td>
										<td>{{ $row->create_at }}</td>
										<td>{{ $row->status }}</td>
										<td>
											<a href="{{ route('admin.products.show', $row->id) }}"
												class="btn btn-purple btn-custom m-b-5 fs-2">
												<i class="bi bi-eye"></i>
											</a>

											<a href="{{ route('admin.products.edit', $row->id) }}" class="btn btn-info btn-custom m-b-5 fs-2">
												<i class="bi bi-pencil-square"></i>
											</a>

											<form action="{{ route('admin.products.destroy', $row->id) }}" method="POST"
												style="display:inline-block;">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger btn-custom m-b-5 fs-2"
													onclick="return confirm('Delete this product?')">
													<i class="bi bi-trash3"></i>
												</button>
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