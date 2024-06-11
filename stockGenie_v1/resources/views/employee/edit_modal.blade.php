 <!-- Edit Employee Modal -->
 <div class="modal fade" id="editEmployeeModal{{  $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModal{{  $employee->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('employees.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
										@method('PUT')
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        <h5 class="modal-title" id="editEmployeeModal{{  $employee->id }}">Edit Employee</h5>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"value="{{$employee->name}}">
                                <span class='text-danger'>@error('name'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"value="{{$employee->email}}">
                                <span class='text-danger'>@error('email'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number"value="{{$employee->phone}}">
                                <span class='text-danger'>@error('phone'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="nid">NID</label>
                                <input type="text" class="form-control" name="nid" id="nid" placeholder="Enter nid Number"value="{{$employee->nid}}">
                                
                                <span class='text-danger'>@error('nid'){{ $message }} @enderror</span>
                            </div>
                          
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="experience">Experience</label>
                                <input type="text" class="form-control" name="experience" id="experience" placeholder="Enter experience"value="{{$employee->experience}}">
                                <span class='text-danger'>@error('experience'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input type="text" class="form-control" name="salary" id="salary" placeholder="Enter salary"value="{{$employee->salary}}">
                                <span class='text-danger'>@error('salary'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="vacation">Vacation</label>
                                <input type="text" class="form-control" name="vacation" id="vacation" placeholder="Enter vacation"value="{{$employee->vacation}}">
                                <span class='text-danger'>@error('vacation'){{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City"value="{{$employee->city}}">
                                <span class='text-danger'>@error('city'){{ $message }} @enderror</span>
                            </div>
                        </div>
                      </div>
                        
                      <div class="form-group">
                              <label for="address">Address</label>
                              <input type="text" class="form-control" name="address" id="address" placeholder="Enter address"value="{{$employee->address}}">
                              <span class='text-danger'>@error('address'){{ $message }} @enderror</span>
                          </div>
                        <!-- Photo -->
                        <div class="form-group my-2">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span>Photo</span>
                                </div>
                                <img id="image" style="width: 100px;height: 100px;object: cover;" src="{{$employee->photo}}"/><br />
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