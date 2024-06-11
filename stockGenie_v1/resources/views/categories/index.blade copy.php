@extends('dashboard')

<!-- add Categories  -->
<div id="add_categories" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add_categories" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" id="addCategoryForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="add_categories">Add Categories</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Categories Name</label>
                                <input type="text" class="form-control" name="categoriesName" id="categoriesName" placeholder="Categories Name" value="{{ old('categoriesName') }}">
                                <span class='text-danger'>@error('categoriesName'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light add_categories">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


 <!-- Edit Category Modal -->
 <div id="editCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" id="editCategoryForm">
            @csrf
            <input type="hidden" name="categoryId" id="editCategoryId">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="editCategoryModalLabel">Edit Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Categories name</label>
                        <input type="text" class="form-control" name="categories_name" id="editCategoriesName" placeholder="Enter Name">
                        <span class="text-danger">@error('categories_name'){{$message}}@enderror</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>



@section('main')


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                <h3 class="panel-title text-white">All Categories</h3>

                <button class="btn btn-primary waves-effect waves-light add_categories" data-toggle="modal" data-target="#add_categories">
                <i class="bi bi-bag-plus-fill" style="font-size:24px;color:white;font-weight:800;"></i>
                </button>

            </div>
						<div class="panel-body">
							<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
											<table id="dataTable" class="table table-striped table-bordered">
													<thead>
															<tr>
																	<th>Categories Name</th>
																	<th>Action</th>
															</tr>
													</thead>
													<tbody>
															@foreach($view as $row)
															<tr>
																	<td>{{$row->categories_name}}</td>
																	<td>
																			<a href="#" class="btn btn-info btn-custom waves-effect waves-light m-b-5 fs-2 btn-edit" data-id="{{ $row->id }}" data-name="{{ $row->categories_name }}" data-toggle="modal" data-target="#editCategoryModal"><i class="bi bi-pencil-square fsc"></i></a>
																			<a href="#" class="btn btn-danger btn-custom waves-effect waves-light m-b-5 fs-2 btn-delete" data-id="{{ $row->id }}"><i class="bi bi-trash3 fsc"></i></a>
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




@endsection

@section('script')
<script>
	$(document).ready(function () {
    // CSRF Token setup for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add Category
    $('#addCategoryForm').on('submit', function(e) {
        e.preventDefault();
        var data = {
            'categoriesName': $('#categoriesName').val()
        };
        $.ajax({
            type: "POST",
            url: '/insert-product-categories',
            data: data,
            dataType: 'json',
            success: function(response) {
                if(response.success){
                    $('#add_categories').modal('hide');
                    location.reload(); // Refresh page to show new category
                }
            }
        });
    });

    // Edit Category - Fill the form with data
    $('.btn-edit').on('click', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#editCategoryId').val(id);
        $('#editCategoriesName').val(name);
    });

    // Update Category
    $('#editCategoryForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#editCategoryId').val();
        var data = {
            'categories_name': $('#editCategoriesName').val()
        };
        $.ajax({
            type: "POST",
            url: '/update-product-categories/' + id,
            data: data,
            dataType: 'json',
            success: function(response) {
                if(response.success){
                    $('#editCategoryModal').modal('hide');
                    location.reload(); // Refresh page to show updated category
                }
            }
        });
    });

    // Delete Category
    $('.btn-delete').on('click', function() {
        var id = $(this).data('id');
				console.log(id);
        if(confirm('Are you sure you want to delete this category?')){
            $.ajax({
                type: "",
                url: '/delete-product-categories/' + id,
                dataType: 'json',
                success: function(response) {
                    if(response.success){
                        location.reload(); // Refresh page to remove deleted category
                    }
                }
            });
        }
    });
});




</script>
@endsection