@extends('layouts.layout')

@section('main')

  <!-- Add Employee Modal -->
  <div class="modal fade" id="add_employee_modal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required  value="{{old('name')}}">
                                <span class='text-danger'>@error('name'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required   value="{{old('email')}}">
                                <span class='text-danger'>@error('email'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required  value="{{old('phone')}}">
                                <span class='text-danger'>@error('phone'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="nid">NID</label>
                                <input type="text" class="form-control" id="nid" name="nid" required  value="{{old('nid')}}">
                                <span class='text-danger'>@error('nid'){{ $message }} @enderror</span>
                            </div>
                          
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="experience">Experience</label>
                                <input type="number" class="form-control" id="experience" name="experience" required  value="{{old('experience')}}">
                                <span class='text-danger'>@error('experience'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary" required  value="{{old('salary')}}">
                                <span class='text-danger'>@error('salary'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="vacation">Vacation</label>
                                <input type="number" class="form-control" id="vacation" name="vacation" required  value="{{old('vacation')}}">
                                <span class='text-danger'>@error('vacation'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" required  value="{{old('city')}}">
                                <span class='text-danger'>@error('city'){{ $message }} @enderror</span>
                            </div>
                        </div>
                      </div>
                        
                      <div class="form-group">
                              <label for="address">Address</label>
                              <input type="text" class="form-control" id="address" name="address" required  value="{{old('address')}}">
                              <span class='text-danger'>@error('address'){{ $message }} @enderror</span>
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
                                    <input type="file" name="photo" id="photo" accept="image/*" class="upload" class="form-control" onchange="readURL(this);" />
                                </div>
                            </div>
                            <span class='text-danger'>@error('photo'){{ $message }} @enderror</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger waves-effect waves-light " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading" style="display: flex; justify-content: space-between;">
                    <h3 class="panel-title text-white">All Employees</h3>
                    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#add_employee_modal">
                        <i class="bi bi-person-add" style="font-size: 24px; color: white; font-weight: 800;"></i> 
                    </button>
                </div>
                <div class="panel-body">
                    <table id="dataTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Image</th>
                                <th>Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td><img src="{{ $employee->photo }}" style="width: 50px; height: 50px; object-fit: cover;"></td>
                                    <td>{{ $employee->salary }}</td>
                                    <td style="display: flex; gap: 4px;">
                                        <!-- edit -->
                                        <!-- <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-info"><i class="bi bi-pencil-square" style="font-size: 25px;"></i></a> -->
                                        <button class="btn btn-info" data-toggle="modal"
                                          data-target="#editEmployeeModal{{  $employee->id }}"><i class="bi bi-pencil-square" style="font-size: 25px;"></i>
                                        </button>
                                        <!-- view -->
                                        <!-- <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-cast" style="font-size: 25px;"></i></a> -->
                                        <button class="btn btn-info" data-toggle="modal"
                                          data-target="#showEmployeeModal{{  $employee->id }}"><i class="bi bi-cast" style="font-size: 25px;"></i>
                                        </button>
                                        <!-- delete -->
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash3" style="font-size: 25px;"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @include('employee.edit_modal')
                                @include('employee.show_modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  
   
@endsection

