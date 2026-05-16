@extends('layouts.layout')
@section('main')
<style>
	label{
		width: auto;
	}
</style>
	<div class="container mt-4">
		<div class="row justify-content-center">
			<div class="col-xl-8 col-lg-9 col-md-10 col-sm-12">

				<div class="panel panel-info shadow">

					<div class="panel-heading d-flex justify-content-between align-items-center p-3 bg-info"style="display: flex;justify-content: space-between;">
						<h3 class="panel-title text-white m-0">Edit Supplier</h3>

						<a href="{{ route('admin.suppliers.index') }}" class="panel-title fs-4">
							<i class="bi bi-box-arrow-in-left text-white" style="font-size:24px;"></i>
						</a>
					</div>

					<div class="panel-body p-4">

						<form action="{{ route('admin.suppliers.update', $editUser->id) }}" method="post"
							enctype="multipart/form-data">

							@csrf
							@method('PUT')

							<div class="mb-3">
								<label class="form-label">Name</label>

								<input type="text" class="form-control" name="name" value="{{ $editUser->name }}"
									placeholder="Enter Name">

								<span class="text-danger">
									@error('name') {{ $message }} @enderror
								</span>
							</div>

							<div class="mb-3">
								<label class="form-label">Phone Number</label>

								<input type="tel" class="form-control" name="phone" value="{{ $editUser->phone }}"
									placeholder="Enter Phone Number">

								<span class="text-danger">
									@error('phone') {{ $message }} @enderror
								</span>
							</div>

							<div class="mb-3">
								<label class="form-label">Address</label>

								<input type="text" class="form-control" name="address" value="{{ $editUser->address }}"
									placeholder="Enter Address">

								<span class="text-danger">
									@error('address') {{ $message }} @enderror
								</span>
							</div>

							<div class="mb-3">
								<label class="form-label">Type</label>

								<select class="form-control" name="type">
									<option value="{{ $editUser->type }}">
										{{ $editUser->type }}
									</option>
								</select>

								<span class="text-danger">
									@error('type') {{ $message }} @enderror
								</span>
							</div>

							<div class="mb-3">
								<label class="form-label">Shop Name</label>

								<input type="text" class="form-control" name="shopName" value="{{ $editUser->shopName }}"
									placeholder="Enter Shop Name">

								<span class="text-danger">
									@error('shopName') {{ $message }} @enderror
								</span>
							</div>

							<button type="submit" class="btn btn-success">
								Update
							</button>

						</form>

					</div>
				</div>

			</div>
		</div>
	</div>


	@endsection