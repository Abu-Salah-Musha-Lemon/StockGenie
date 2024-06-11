<!-- resources/views/category/index.blade.php -->
@extends('layouts.layout')

@section('main')
<div class="row">
		<div class="col-md-12">
		<div class="panel panel-success">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">All Category</h3>
				<div class="div" style="display: flex; justify-content: space-between;">

					<a class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
						<i class="bi bi-person-add" style="font-size:24px;color:white;font-weight:800;"></i>
					</a>

				</div>

			</div>
			<div class="panel-body">
				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">

						<table class="table mt-3" id="dataTable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>category Name</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($category as $category)
								<tr>
									<td>{{ $category->category_name }}</td>
									<td>
										<!-- edit  -->
										<button class="btn btn-info" data-toggle="modal"
											data-target="#editCategoryModal{{ $category->id }}">Edit
										</button>

										<!-- delete -->
										<form action="{{ route('category.destroy', $category->id) }}" method="POST"
											style="display:inline;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger">Delete</button>
											
										</form>
									</td>
								</tr>

								<!-- Edit Category Modal -->
								<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog"
									aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">
													Edit Category</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>

											<form action="{{ route('category.update', $category->id) }}" method="POST">
												@csrf
												@method('PUT')
												<div class="modal-body">
													<div class="form-group">
														<label for="category_name">category Name</label>
														<input type="text" class="form-control" id="category_name" name="category_name"
															value="{{ $category->category_name }}" required>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Save changes</button>
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

</div>
</div>
<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{ route('category.store') }}" method="POST">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label for="category_name">category Name</label>
						<input type="text" class="form-control" id="category_name" name="category_name" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection