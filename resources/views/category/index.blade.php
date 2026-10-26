@extends('layouts.layout')
@section('main')

<style>
	i {
		font-size: 18px;
	}
</style>

<div class="row">
	<div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6 col-xxl-6 mx-auto">
		<div class="panel panel-success">
			<div class="panel-heading "style=" display:flex; justify-content:space-between; align-items:center">
				<h3 class="panel-title text-white">All Category</h3>
				<div class="d-flex">
					<a class="btn btn-primary btn-custom waves-effect waves-light" data-toggle="modal"
						data-target="#addCategoryModal">
						<i class="bi bi-person-add" style="font-size:24px;color:white;font-weight:800;"></i>
					</a>
				</div>
			</div>
			<div class="panel-body">
			<div class="table-responsive">
			<table id="dataTable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Category Name</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($category as $category)
							<tr>
								<td>{{ $category->category_name }}</td>
								<td class="d-flex">
									<!-- edit -->
									<button class="btn btn-info btn-custom waves-effect waves-light mr-2" data-toggle="modal"
										data-target="#editCategoryModal{{ $category->id }}">
										<i class="bi bi-pencil-square fs-2"></i>
									</button>

									<!-- delete -->
									<form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger btn-custom waves-effect waves-light">
											<i class="bi bi-trash3"></i>
										</button>
									</form>
								</td>
							</tr>

							<!-- Edit Category Modal -->
							<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog"
								aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
										</div>
										<form action="{{ route('category.update', $category->id) }}" method="POST">
											@csrf
											@method('PUT')
											<div class="modal-body">
												<div class="form-group">
													<label for="category_name">Category Name</label>
													<input type="text" class="form-control" id="category_name" name="category_name"
														value="{{ $category->category_name }}" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger waves-effect waves-light"
													data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
											</div>
										</form>
									</div>
								</div>
							</div>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
			</div>
			<form action="{{ route('category.store') }}" method="POST">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label for="category_name">Category Name</label>
						<input type="text" class="form-control" id="category_name" name="category_name" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
@section('script')
<script>
    $(document).ready(function () {
        initializeDataTable([	
					'Category Name',]);
    });
    </script>
@endsection
@endsection