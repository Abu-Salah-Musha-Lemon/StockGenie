@extends('layouts.layout')
@section('main')

<div class="row">

	<div class="col-md-12">

		<div class="panel panel-success">

			<div class="panel-heading" style="display: flex; justify-content: space-between;">
				<h3 class="panel-title text-white">All Supplier</h3>
				@include('supplier.add_supplier_modal')

				<a class="btn btn-primary btn-custom waves-effect waves-light " data-toggle="modal"
					data-target="#addSupplierModal">
					<i class="bi bi-person-add" style="font-size:24px;color:white;font-weight:800;"></i>
				</a>
			</div>

			<div class="panel-body">
				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

						<div class="table-responsive">

							<table id="dataTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Phone</th>
										<th>Address</th>
										<th>Shop Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($supplier as $row)
									<tr>
										<td>{{$row->name}}</td>
										<td>{{$row->phone}}</td>
										<td>{{$row->address}}</td>
										<td>{{$row->shopName}}</td>
										<td>
											<a href="{{ route('admin.suppliers.show', $row->id) }}"
													class="btn btn-sm btn-primary btn-custom waves-effect waves-light">
													<i class="bi bi-eye fs-2"></i>
											</a>

											<a href="{{ route('admin.suppliers.edit', $row->id) }}"
													class="btn btn-sm btn-info btn-custom waves-effect waves-light">
													<i class="bi bi-pencil-square fs-2"></i>
											</a>

													<button
															type="button"
															class="btn btn-sm btn-danger js-delete"
															data-url="{{ route('admin.suppliers.destroy', $row->id) }}"
													>
															<i class="bi bi-trash"></i>
													</button>
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
$(document).ready(function () {
    if (!$.fn.DataTable.isDataTable('#dataTable')) {
        $('#dataTable').DataTable();
    }
});

	$(document).ready(function () {
		initializeDataTable([
			'Name', 'Phone', 'Address', '	Shop Name']);
	});
</script>
@endsection
@endsection