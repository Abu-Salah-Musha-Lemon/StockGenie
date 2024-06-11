<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="product_name">Product Name</label>
			<input type="text" class="form-control" name="product_name" value="{{old('product_name')}}" required>
			<span class="text-danger">@error('product_name'){{$message}} @enderror</span>
		</div>
		<div class="form-group">
			@php
			$cat =DB::table('categories')->get();
			@endphp
			<label>Categories Name</label>

			<select name="cat_id" id="cat_id" class="form-control">
				<option disabled="" selected="">Select</option>

				@foreach($cat as $row)
				<option value="{{$row->id}}">{{$row->categories_name}}</option>
				@endforeach

			</select>
			<span class='text-danger'>@error('cat_id'){{ $message }}@enderror</span>
		</div>
		<div class="form-group">
			@php
			$sup =DB::table('suppliers')->get();
			@endphp
			<label>Suppliers Name </label>
			<select name="sup_id" class="form-control">
				<option disabled="" selected="">Select</option>

				@foreach($sup as $row)
				<option value="{{$row->id}}">{{$row->name}}</option>
				@endforeach

			</select>
			<span class='text-danger'>@error('sup_id'){{ $message }}@enderror</span>

		</div>
		<div class="form-group">
			<label for="product_code">Product Code</label>
			<input type="text" class="form-control" name="product_code" value="{{old('product_code')}}" required>
			<span class="text-danger">@error('product_code'){{$message}} @enderror</span>
		</div>
		<div class="form-group">
			<label for="product_garage">Garage</label>
			<input type="text" class="form-control" name="product_garage" value="{{old('product_garage')}}" required>
			<span class="text-danger">@error('product_garage'){{$message}} @enderror</span>
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

	<div class="col-md-6">
		<div class="form-group">
			<label for="product_route">Route</label>
			<input type="text" class="form-control" name="product_route" value="{{old('product_route')}}" required>
			<span class="text-danger">@error('product_route'){{$message}} @enderror</span>
		</div>
		<div class="form-group">
			<label for="product_qty">Quantity</label>
			<input type="number" class="form-control" name="product_qty" value="{{old('product_qty')}}" required>
			<span class="text-danger">@error('product_qty'){{$message}} @enderror</span>
		</div>
		<div class="form-group">
			<label for="buy_date">Buy Date</label>
			<input type="date" class="form-control" name="buy_date" value="{{old('buy_date')}}" required>
			<span class="text-danger">@error('buy_date'){{$message}} @enderror</span>
		</div>
		<div class="form-group">
			<label for="expire_date">Expire Date</label>
			<input type="date" class="form-control" name="expire_date" value="{{old('expire_date')}}" required>
			<span class="text-danger">@error('expire_date'){{$message}} @enderror</span>
		</div>
		<div class="form-group">
			<label for="buying_price">Buying Price</label>
			<input type="number" class="form-control" name="buying_price" value="{{old('buying_price')}}" required>
			<span class="text-danger">@error('buying_price'){{$message}} @enderror</span>
		</div>
		<div class="form-group">
			<label for="selling_price">Selling Price</label>
			<input type="number" class="form-control" name="selling_price" value="{{old('selling_price')}}" required>
			<span class="text-danger">@error('selling_price'){{$message}} @enderror</span>
		</div>
	</div>
</div>