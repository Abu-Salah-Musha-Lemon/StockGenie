<!-- Customer Details Modal -->
<div id="customerDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="customerDetailsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title text-info" id="customerDetailsLabel">Customer Details</h4>
              </div>
            <div class="modal-body">
                <form action="{{ URL::to('/save-customer-details') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="customerName">Name</label>
                        <input type="text" name="customerName" id="customerName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="customerPhone">Phone Number</label>
                        <input type="text" name="customerPhone" id="customerPhone" class="form-control" required>
                    </div>
                    <input type="hidden" name="totalAmount" id="totalAmountModal" value="">
                    <input type="hidden" name="productId" id="productIdModal" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
