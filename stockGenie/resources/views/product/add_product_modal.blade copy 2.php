<!-- Add Product Modal -->
<div class="modal fade" id="addProductsModal" tabindex="-1" role="dialog" aria-labelledby="addProductsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="addProductsModalLabel">Add Products</h5>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#productTab" role="tab">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#supplierTab" role="tab">Supplier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#categoryTab" role="tab">Category</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Product Tab -->
                    <div class="tab-pane active" id="productTab" role="tabpanel">
                        <form role="form" action="{{ URL::to('/insert-product-modal') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-3">
                                    <!-- Photo -->
                                    <div class="form-group my-2">
                                        <div class="input-group mb-3" style="display: flex; flex-direction: column; align-items: center;">
                                            <div class="input-group-prepend">
                                                <span>Product Photo</span>
                                            </div>
                                            <img id="image" style="width: 190px; height: 190px; border-radius: 16px; border: 1px solid rgba(0, 0, 0, 0.1);">
                                            <div class="fileUpload btn btn-success waves-effect waves-light" style="margin: 5px 0;">
                                                <span><i class="ion-upload m-r-5"></i>Upload</span>
                                                <input type="file" name="photo" id="photo" accept="image/*" class="upload form-control" onchange="readURL(this);" />
                                            </div>
                                            <span class='text-danger'>@error('photo'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control @error('product_name') @enderror" name="product_name" placeholder="Enter Name" value="{{ old('product_name') }}">
                                        <span class='text-danger'>@error('product_name'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        @php
                                        $cat = DB::table('category')->get();
                                        @endphp
                                        <label>Category Name</label>
                                        <select name="cat_id" id="cat_id" class="form-control">
                                            <option disabled="" selected="">Select</option>
                                            @foreach($cat as $row)
                                            <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class='text-danger'>@error('cat_id'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        @php
                                        $sup = DB::table('suppliers')->get();
                                        @endphp
                                        <label>Suppliers Name </label>
                                        <select name="sup_id" class="form-control">
                                            <option disabled="" selected="">Select</option>
                                            @foreach($sup as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class='text-danger'>@error('sup_id'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Code</label>
                                        <input type="text" class="form-control" name="product_code" value="{{ old('product_code') }}" placeholder="Enter Product Code">
                                        <span class='text-danger'>@error('product_code'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Quantity</label>
                                        <input type="text" class="form-control" name="product_qty" value="{{ old('product_qty') }}" placeholder="Enter Product Quantity">
                                        <span class='text-danger'>@error('product_qty'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Garage</label>
                                        <input type="text" class="form-control" name="product_garage" value="{{ old('product_garage') }}" placeholder="Enter Product Garage">
                                        <span class='text-danger'>@error('product_garage'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Product Route</label>
                                        <input type="text" class="form-control" name="product_route" value="{{ old('product_route') }}" placeholder="Enter Product Route">
                                        <span class='text-danger'>@error('product_route'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Buying Date</label>
                                        <input type="date" class="form-control" name="buy_date" value="{{ old('buy_date') }}" placeholder="Enter Product Buying Date">
                                        <span class='text-danger'>@error('buy_date'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Expire Date</label>
                                        <input type="date" class="form-control" name="expire_date" value="{{ old('expire_date') }}" placeholder="Enter Product Expire Date">
                                        <span class='text-danger'>@error('expire_date'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Buying Prize</label>
                                        <input type="number" class="form-control" name="buying_price" value="{{ old('buying_price') }}" placeholder="Enter Product Buying Prize">
                                        <span class='text-danger'>@error('buying_price'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Selling Prize</label>
                                        <input type="number" class="form-control" name="selling_price" value="{{ old('selling_price') }}" placeholder="Enter Product Selling Prize">
                                        <span class='text-danger'>@error('selling_price'){{ $message }}@enderror</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success waves-effect waves-light w-sm m-b-5">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- Supplier Tab -->
                    <div class="tab-pane" id="supplierTab" role="tabpanel">
                        <form role="form" action="{{ route('supplier.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name') }}" />
                                <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}" />
                                <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter address" value="{{ old('address') }}" />
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
                                <input type="text" class="form-control" name="shopName" placeholder="Enter Shop Name" value="{{ old('shopName') }}" />
                                <span class="text-danger">@error('shopName'){{ $message }}@enderror</span>
                            </div>
                            <button type="submit" class="btn btn-purple btn-custom waves-effect waves-light m-b-5">Submit</button>
                        </form>
                    </div>
                    <!-- Category Tab -->
                    <div class="tab-pane" id="categoryTab" role="tabpanel">
                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional scripts for handling image preview -->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('image').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>
    .nav-tabs .nav-link {
        border: 1px solid transparent;
        transition: border-color 0.3s ease-in-out;
    }

    .nav-tabs .nav-link.active {
        border-color: #007bff #007bff #fff; /* Change the border color as needed */
    }

    .tab-content .tab-pane {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 15px;
        transition: border-color 0.3s ease-in-out;
    }

    .tab-content .tab-pane.active {
        border-color: #007bff; /* Change the border color as needed */
    }
</style>
