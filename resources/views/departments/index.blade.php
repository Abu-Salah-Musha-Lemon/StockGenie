@extends('layouts.layout')

@section('main')

<div class="row">
	<div class="col-md-10 mx-auto">

		<div class="panel panel-success">

			<div class="panel-heading" style="display:flex; justify-content:space-between;">
				<h3 class="panel-title">All Departments</h3>

				<button class="btn btn-primary" data-toggle="modal" data-target="#addDepartmentsModal">
					Add Departments
				</button>
			</div>

			<div class="panel-body">

				<table id="dataTable" class="table table-bordered">

					<thead>
						<tr>
							<th>Name</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						@foreach($departments as $department)
						<tr>
							<td>{{ $department->name }}</td>

							<td>
								<button class="btn btn-info" data-toggle="modal" data-target="#editModal{{ $department->id }}">
									Edit
								</button>

								<form action="{{ route('admin.departments.destroy', $department->id) }}" method="POST" style="display:inline;">
									@csrf
									@method('DELETE')
									<button class="btn btn-danger">Delete</button>
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

<!-- ================= ADD MODAL ================= -->
<div class="modal fade" id="addDepartmentsModal">
	<div class="modal-dialog">
		<div class="modal-content">

			<form method="POST" action="{{ route('admin.departments.store') }}">
				@csrf

				<div class="modal-body">

					<label>Name</label>
					<input type="text" name="name" class="form-control" required>
					@error('name')<span class="text-danger">{{ $message }}</span>@enderror

					<label>Description</label>
					<textarea name="description" class="form-control"></textarea>
					@error('name')<span class="text-danger">{{ $description }}</span>@enderror

				</div>

				<div class="modal-footer">
					<button class="btn btn-danger" data-dismiss="modal">Close</button>
					<button class="btn btn-primary">Save</button>
				</div>

			</form>

		</div>
	</div>
</div>

<!-- ================= EDIT MODAL ================= -->
@foreach($departments as $department)
<div class="modal fade" id="editModal{{ $department->id }}">
	<div class="modal-dialog">
		<div class="modal-content">

			<form method="POST" action="{{ route('admin.departments.update', $department->id) }}">
				@csrf
				@method('PUT')

				<div class="modal-body">

					<label>Name</label>
					<input type="text" name="name" value="{{ $department->name }}" class="form-control">

					<label>Description</label>
					<textarea name="description" class="form-control">{{ $department->description }}</textarea>

				</div>

				<div class="modal-footer">
					<button class="btn btn-danger" data-dismiss="modal">Close</button>
					<button class="btn btn-primary">Update</button>
				</div>

			</form>

		</div>
	</div>
</div>
@endforeach

@endsection

@section('script')
<script>
$(document).ready(function () {
	initializeDataTable(['Name', 'Actions']);
});
</script>
@endsection