@extends('layouts.layout')

@section('main')

<div class="row">
	<div class="col-md-10 mx-auto">

		<div class="panel panel-success">

			<div class="panel-heading" style="display:flex; justify-content:space-between;">
				<h3 class="panel-title">All Positions</h3>

				<button class="btn btn-primary" data-toggle="modal" data-target="#addPositionsModal">
					Add positions
				</button>
			</div>

			<div class="panel-body">

				<table id="dataTable" class="table table-bordered">

					<thead>
						<tr>
							<th>Title</th>
							<th>Description</th>
							<th>Departments</th>
							<th>Salary</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						@foreach($positions as $position)
						<tr>
							<td>{{ $position->title }}</td>
							<td>{{ $position->description }}</td>
							<td>{{ $position->department_name }}</td>
							<td>{{ $position->base_salary }}</td>

							<td>
								<button class="btn btn-info" data-toggle="modal" data-target="#editModal{{ $position->id }}">
									Edit
								</button>

								<form action="{{ route('admin.positions.destroy', $position->id) }}" method="POST" style="display:inline;">
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
<div class="modal fade" id="addPositionsModal">
	<div class="modal-dialog">
		<div class="modal-content">

			<form method="POST" action="{{ route('admin.positions.store') }}">
				@csrf

				<div class="modal-body">

					<label>Title</label>
					<input type="text" name="title" class="form-control" placeholder="Enter the Title" required>
					@error('title')<span class="text-danger">{{ $message }}</span>@enderror

					<label>Description</label>
					<textarea name="description" class="form-control"></textarea>
					@error('description')<span class="text-danger">{{ $description }}</span>@enderror

					
					<label>Department</label>
					<select class="form-control" name="department_id" id="department_id">
							@foreach($departments as $department)
									<option value="{{ $department->id }}">{{ $department->name }}</option>
							@endforeach
					</select>

					@error('department_id')<span class="text-danger">{{ $message }}</span>@enderror
					

						<label>Salary</label>
					<input type="text" name="base_salary" class="form-control" placeholder="Enter the Salary" required>
					@error('base_salary')<span class="text-danger">{{ $message }}</span>@enderror


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
@foreach($positions as $position)
<div class="modal fade" id="editModal{{ $position->id }}">
	<div class="modal-dialog">
		<div class="modal-content">

			<form method="POST" action="{{ route('admin.positions.update', $position->id) }}">
				@csrf
				@method('PUT')

				<div class="modal-body">

					<label>Title</label>
					<input type="text" name="title" class="form-control" placeholder="Enter the Title" required>
					@error('title')<span class="text-danger">{{ $message }}</span>@enderror

					<label>Description</label>
					<textarea name="description" class="form-control"></textarea>
					@error('description')<span class="text-danger">{{ $description }}</span>@enderror

					
					<label>Department</label>
					<select class="form-control" name="department_id" id="department_id">
							@foreach($departments as $department)
									<option value="{{ $department->id }}">{{ $department->name }}</option>
							@endforeach
					</select>

					@error('department_id')<span class="text-danger">{{ $message }}</span>@enderror
					

						<label>Salary</label>
					<input type="text" name="base_salary" class="form-control" placeholder="Enter the Salary" required>
					@error('base_salary')<span class="text-danger">{{ $message }}</span>@enderror


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