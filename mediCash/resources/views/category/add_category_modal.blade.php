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
						<label for="category_name">category Name</label>
						<input type="text" class="form-control" id="category_name" name="category_name" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger waves-effect waves-light  " data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary waves-effect waves-light  ">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>