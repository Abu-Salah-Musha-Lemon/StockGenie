 <!-- show Employee Modal -->
 <div class="modal fade" id="showEmployeeModal{{  $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="showEmployeeModal{{  $employee->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('employees.update',$employee->id) }}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                            </button>
                        <h5 class="modal-title" id="showEmployeeModal{{  $employee->id }}">Edit Employee</h5>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name"value="{{$employee->name}}" disabled>
                                
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"value="{{$employee->email}}" disabled>
                                
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number"value="{{$employee->phone}}" disabled>
                                
                            </div>
                            <div class="form-group">
                                <label for="nid">NID</label>
                                <input type="text" class="form-control" name="nid" id="nid" placeholder="Enter nid Number"value="{{$employee->nid}}" disabled>
                            </div>
                          
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="experience">Experience</label>
                                <input type="text" class="form-control" name="experience" id="experience" placeholder="Enter experience"value="{{$employee->experience}}" disabled>
                                
                            </div>
                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input type="text" class="form-control" name="salary" id="salary" placeholder="Enter salary"value="{{$employee->salary}}" disabled>
                                
                            </div>
                            <div class="form-group">
                                <label for="vacation">Vacation</label>
                                <input type="text" class="form-control" name="vacation" id="vacation" placeholder="Enter vacation"value="{{$employee->vacation}}" disabled>
                                
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City"value="{{$employee->city}}" disabled>
                                
                            </div>
                        </div>
                      </div>
                        
                      <div class="form-group">
                              <label for="address">Address</label>
                              <input type="text" class="form-control" name="address" id="address" placeholder="Enter address"value="{{$employee->address}}" disabled>
                              
                          </div>
                        <!-- Photo -->
                        <div class="form-group my-2">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span>Photo</span>
                                </div>
                                <img id="image" style="width: 100px;height: 100px;object: cover;" src="{{$employee->photo}}"/><br />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger waves-effect waves-light " data-dismiss="modal">Close</button>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>