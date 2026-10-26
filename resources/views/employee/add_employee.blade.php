@extends('layouts.layout')
@section('main')


<div class="row" >
    <!-- Basic example -->
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="panel panel-info">
            <div class="panel-heading" style="display: flex; justify-content: space-between;">
                <h3 class="panel-title">Add Employee</h3>
                <a class="panel-title fs-4" href="{{URL::to('/all-employee')}}">
                    <i class="bi bi-box-arrow-in-left" style="font-size:24px"></i>
                </a>
            </div>
            <div class="panel-body">
                <form role="form" action="{{ route('addEmployee') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 mb-4">
                            <!-- Photo -->
                            <div class="form-group my-2">
                                <div class="input-group mb-3" style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                    <div class="input-group-prepend">
                                        <span>Photo</span>
                                    </div>
                                    <img id="image" style="width: 190px; height: 190px; object: cover; border-radius: 16px;" /><br />
                                    <div class="fileUpload btn btn-success waves-effect waves-light" style="margin-top:10px">
                                        <span><i class="ion-upload m-r-5"></i>Upload</span>
                                        <input type="file" name="photo" id="photo" accept="image/*" class="upload form-control" onchange="readURL(this);" required/>
                                    </div>
                                    <br><span class='text-danger'>@error('photo'){{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4 mb-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Name" value="{{old('name')}}" required>
                                <span class='text-danger'>@error('name'){{ $message }} @enderror</span>
                            </div>

                            <div class="form-group">
                                <label>NID</label>
                                <input type="text" class="form-control @error('nid') is-invalid @enderror" name="nid" placeholder="Enter nid Number" value="{{old('nid')}}" required>
                                <span class='text-danger'>@error('nid'){{ $message }} @enderror</span>
                            </div>

                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" pattern="[0-9]{3}[0-9]{4}[0-9]{4}" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Enter Your Phone Number (01978977465)" value="{{old('phone')}}" required>
                                <span class='text-danger'>@error('phone'){{ $message }} @enderror</span>
                            </div>

                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email" value="{{old('email')}}" required>
                                <span class='text-danger'>@error('email'){{ $message }} @enderror</span>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter address" value="{{old('address')}}" required>
                                <span class='text-danger'>@error('address'){{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4 mb-4">
                            <div class="form-group">
                                <label>Experience</label>
                                <input type="text" class="form-control @error('experience') is-invalid @enderror" name="experience" placeholder="Enter experience" value="{{old('experience')}}" required>
                                <span class='text-danger'>@error('experience'){{ $message }} @enderror</span>
                            </div>

                            <div class="form-group">
                                <label>Salary</label>
                                <input type="text" class="form-control @error('salary') is-invalid @enderror" name="salary" placeholder="Enter salary" value="{{old('salary')}}" required>
                                <span class='text-danger'>@error('salary'){{ $message }} @enderror</span>
                            </div>

                            <div class="form-group">
                                <label>Vacation</label>
                                <input type="text" class="form-control @error('vacation') is-invalid @enderror" name="vacation" placeholder="Enter vacation" value="{{old('vacation')}}" required>
                                <span class='text-danger'>@error('vacation'){{ $message }} @enderror</span>
                            </div>

                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="Enter City" value="{{old('city')}}" required>
                                <span class='text-danger'>@error('city'){{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success waves-effect waves-light w-sm m-b-5">Submit</button>
                        </div>
                    </div>
                </form>
            </div><!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col-->
</div>

@endsection
