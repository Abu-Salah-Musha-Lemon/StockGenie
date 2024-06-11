@extends('layouts.layout')

@section('main')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">All Suppliers</h3>
				<a class="panel-title fs-4" href="#" class="btn btn-info" data-toggle="modal" data-target="#addSupplierModal">
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
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Shop Name</th>
                <th>City</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->email }}</td>
                <td>{{ $supplier->phone }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->shopeName }}</td>
                <td>{{ $supplier->city }}</td>
                <td><img src="{{ asset($supplier->photo) }}" alt="{{ $supplier->name }}" width="50"></td>
                <td>
                    <button class="btn btn-primary edit-btn" data-id="{{ $supplier->id }}">Edit</button>
                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">Delete</button>
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

@include('suppliers.modal')

@endsection

@section('scripts')
<script>
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        $.get('/suppliers/' + id + '/edit', function(data) {
            $('#editSupplierModal input[name="name"]').val(data.name);
            $('#editSupplierModal input[name="email"]').val(data.email);
            $('#editSupplierModal input[name="phone"]').val(data.phone);
            $('#editSupplierModal input[name="address"]').val(data.address);
            $('#editSupplierModal input[name="shopeName"]').val(data.shopeName);
            $('#editSupplierModal input[name="account_holder"]').val(data.account_holder);
            $('#editSupplierModal input[name="account_number"]').val(data.account_number);
            $('#editSupplierModal input[name="bank_name"]').val(data.bank_name);
            $('#editSupplierModal input[name="bank_branch"]').val(data.bank_branch);
            $('#editSupplierModal input[name="city"]').val(data.city);
            $('#editSupplierModal input[name="type"]').val(data.type);
            $('#editSupplierModal form').attr('action', '/suppliers/' + id);
            $('#editSupplierModal').modal('show');
        });
    });
</script>
@endsection