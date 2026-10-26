@extends('layouts.layout')

@section('main')

<div class="row">
	<div class="col-md-10 mx-auto">

		<div class="panel panel-success">

			<div class="panel-heading" style="display:flex; justify-content:space-between;">
				<h3 class="panel-title">All Categories</h3>

				<button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
					Add Category
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
						@foreach($categories as $category)
						<tr>
							<td>{{ $category->name }}</td>

							<td>
								<button class="btn btn-info" data-toggle="modal" data-target="#editModal{{ $category->id }}">
									Edit
								</button>

								<form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
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
<div class="modal fade" id="addCategoryModal">
	<div class="modal-dialog">
		<div class="modal-content">

			<form method="POST" action="{{ route('admin.categories.store') }}">
				@csrf

				<div class="modal-body">

					<label>Name</label>
					<input type="text" name="name" class="form-control" required>

					<label>Description</label>
					<textarea name="description" class="form-control"></textarea>

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
@foreach($categories as $category)
<div class="modal fade" id="editModal{{ $category->id }}">
	<div class="modal-dialog">
		<div class="modal-content">

			<form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
				@csrf
				@method('PUT')

				<div class="modal-body">

					<label>Name</label>
					<input type="text" name="name" value="{{ $category->name }}" class="form-control">

					<label>Description</label>
					<textarea name="description" class="form-control">{{ $category->description }}</textarea>

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