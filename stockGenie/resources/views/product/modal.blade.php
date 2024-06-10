<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                </div>
                <div class="modal-body">
                    @include('product.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-sm">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                </div>
                <div class="modal-body">
                    @include('product.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light w-sm">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
