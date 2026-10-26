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
											<a href="{{URL::to('/view-supplier'.$row->id)}}"
												class="btn btn-sm btn-primary btn-custom waves-effect waves-light"><i
													class="bi bi-eye fs-2"></i></a>
											<a href="{{URL::to('/edit-supplier'.$row->id)}}"
												class="btn btn-sm btn-info btn-custom waves-effect waves-light"><i
													class="bi bi-pencil-square fs-2"></i></a>
											<a href="{{URL::to('/delete-supplier'.$row->id)}}"
												class="btn btn-sm btn-danger btn-custom waves-effect waves-light" id="delete"  onclick="confirmation(event)"><i
													class="bi bi-trash fs-2"></i></a>
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
        title: "Are you sure to delete this Supplier?",
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
		initializeDataTable([
			'Name', 'Phone', 'Address', '	Shop Name']);
	});
</script>
@endsection
@endsection