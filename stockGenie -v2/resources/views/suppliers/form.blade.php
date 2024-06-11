<div class="row">
	<div class="col-md-6">

		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{old('name')}}" />
			<span class="text-danger">@error('name'){{$message}}@enderror</span>
		</div>



		<div class="form-group">
			<label>Phone Number</label>
			<input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number" value="{{old('phone')}}" />
			<span class="text-danger">@error('phone'){{$message}}@enderror</span>
		</div>

		<div class="form-group">
			<label>Address</label>
			<input type="text" class="form-control" name="address" placeholder="Enter address" value="{{old('address')}}" />
			<span class="text-danger">@error('address'){{$message}}@enderror</span>
		</div>

		<div class="form-group">
			<label>Type</label>
			<select name="type" id="type" class="form-control">
				<option disabled="" selected="">Select</option>
				<option value="Distributer">Distributer</option>
				<option value="WholeSeller">Whole Seller</option>
				<option value="Broker">Broker</option>
			</select>
			<span class="text-danger">@error('type'){{$message}}@enderror</span>
		</div>
</div>

		<div class="col-md-6">
		<div class="form-group">
			<label>shopeName</label>
			<input type="text" class="form-control" name="shopeName" placeholder="Enter shopeName"
				value="{{old('shopeName')}}" />
			<span class="text-danger">@error('shopeName'){{$message}}@enderror</span>
		</div>
		<!-- Photo -->
		<div class="form-group my-2">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span>Photo</span>
				</div>
				<img id="image" style="width: 100px;height: 100px;object: cover;" /><br />
				<!-- <input type="file" name="photo" id="photo" accept="image/*" class="upload" class="form-control" onchange="readURL(this);" /> -->
				<div class="fileUpload btn btn-success waves-effect waves-light" style="margin-top:10px">
					<span><i class="ion-upload m-r-5"></i>Upload</span>
					<input type="file" name="photo" id="photo" accept="image/*" class="upload" class="form-control"
						onchange="readURL(this);" />
				</div>
			</div>
			<span class='text-danger'>@error('photo'){{ $message }} @enderror</span>
		</div>

	</div>
</div>