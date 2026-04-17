<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="addSupplierModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title">Add Supplier</h5>
			</div>
			<form role="form" action="{{ route('supplier.store') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name') }}" required/>
					<span class="text-danger">@error('name'){{ $message }}@enderror</span>
				</div>

				<div class="form-group">
					<label>Phone Number</label>
					<input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number"
						value="{{ old('phone') }}" required/>
					<span class="text-danger">@error('phone'){{ $message }}@enderror</span>
				</div>

				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control" name="address" placeholder="Enter address"
						value="{{ old('address') }}" required/>
					<span class="text-danger">@error('address'){{ $message }}@enderror</span>
				</div>

				<div class="form-group">
					<label>Type</label>
					<select name="type" id="type" class="form-control">
						<option disabled="" selected="">Select</option>
						<option value="Distributer">Distributer</option>
						<option value="WholeSeller">Whole Seller</option>
						<option value="Broker">Broker</option>
					</select>
					<span class="text-danger">@error('type'){{ $message }}@enderror</span>
				</div>

				<div class="form-group">
					<label>Shop Name</label>
					<input type="text" class="form-control" name="shopName" placeholder="Enter Shop Name"
						value="{{ old('shopName') }}" required/>
					<span class="text-danger">@error('shopName'){{ $message }}@enderror</span>
				</div>

				<button type="submit" class="btn btn-purple btn-custom waves-effect waves-light m-b-5">
					Submit
				</button>
			</form>
		</div>
	</div>
</div>