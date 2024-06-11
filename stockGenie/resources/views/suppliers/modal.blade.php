<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    <h5 class="modal-title" id="addSupplierModalLabel">Add Supplier</h5>
                </div>
                <div class="modal-body">
                    @include('suppliers.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light w-sm">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" role="dialog" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                </div>
                <div class="modal-body">
                    @include('suppliers.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light w-sm">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
