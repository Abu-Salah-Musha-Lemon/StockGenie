@extends('layouts.layout') @section('main')
<div class="row">
    <div class="col-12">
        <div class="panel panel-info">
            <div class="panel-heading" style="display:flex; justify-content:space-between; align-items:center;">
                <h3 class="panel-title">Add Employee</h3>
                <a class="panel-title fs-4" href="{{ route('admin.employees.index') }}"> <i
                        class="bi bi-box-arrow-in-left" style="font-size:24px"></i> </a>
            </div>
            <div class="panel-body">
                {{-- GENERAL ERROR --}} @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- PHOTO --}}
                        <div class="col-md-4 mb-4">
                            <div class="form-group my-2">
                                <div class="input-group mb-3" style="
                                    display:flex;
                                    justify-content:center;
                                    align-items:center;
                                    flex-direction:column;
                                 ">
                                    <div class="input-group-prepend"><span>Photo</span></div>
                                    <img id="image" src="https://via.placeholder.com/190" style="
                                        width:190px;
                                        height:190px;
                                        object-fit:cover;
                                        border-radius:16px;
                                    " /> <br>
                                    <div class="fileUpload btn btn-success waves-effect waves-light mt-2">
                                        <span> <i class="ion-upload m-r-5"></i> Upload </span> <input type="file"
                                            name="photo" id="photo" accept="image/*" class="upload form-control"
                                            onchange="readURL(this);" required />
                                    </div>
                                    <span class="text-danger"> @error('photo') {{ $message }} @enderror </span>
                                </div>
                            </div>
                        </div>

                        {{-- LEFT SIDE --}}
                        <div class="col-md-4">
                            {{-- FIRST NAME --}}
                            <div class="form-group mb-3">
                                <label>First Name</label> <input type="text" name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name') }}" placeholder="Enter First Name" required>
                                @error('first_name') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                            {{-- LAST NAME --}}
                            <div class="form-group mb-3">
                                <label>Last Name</label> <input type="text" name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name') }}" placeholder="Enter Last Name"> @error('last_name')
                                <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                            {{-- NID --}}
                            <div class="form-group mb-3">
                                <label>NID</label> <input type="text" name="nid"
                                    class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid') }}"
                                    placeholder="Enter NID" required> @error('nid') <span class="text-danger">
                                    {{ $message }} </span> @enderror
                            </div>
                            {{-- PHONE --}}
                            <div class="form-group mb-3">
                                <label>Phone Number</label> <input type="text" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number') }}" placeholder="01912345678" pattern="[0-9]{11}"
                                    maxlength="11" required> @error('phone_number') <span class="text-danger">
                                    {{ $message }} </span> @enderror
                            </div>
                            {{-- EMAIL --}}
                            <div class="form-group mb-3">
                                <label>Email</label> <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="Enter Email" required> @error('email') <span class="text-danger">
                                    {{ $message }} </span> @enderror
                            </div>
                            {{-- ADDRESS --}}
                            <div class="form-group mb-3">
                                <label>Address</label> <input type="text" name="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address') }}" placeholder="Enter Address"> @error('address') <span
                                    class="text-danger"> {{ $message }} </span> @enderror
                            </div>

                            {{-- DEPARTMENT --}}
                            <div class="form-group mb-3">
                                <label>Department</label> 
																<select name="department_id" id="department_id"
                                    class="form-control @error('department_id') is-invalid @enderror" required>
                                    <option value="">Select Department</option>
                                    @foreach($departments as $row)
                                    <option value="{{ $row->id }}" {{ old('department_id')==$row->
                  id ? 'selected' : '' }}> {{ $row->name }}
                                    </option>
                                    @endforeach
                                </select> @error('department_id') <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            {{-- POSITION --}}
                            <div class="form-group mb-3">
                                <label>Position</label> <select name="position_id" id="position_id"
                                    class="form-control @error('position_id') is-invalid @enderror" required>
                                    <option value="">Select Position</option>
                                    @foreach($positions as $row)
                                    <option value="{{ $row->id }}" data-department="{{ $row->department_id }}" {{ old('position_id')==$row->
                  id ? 'selected' : '' }}> {{ $row->title }}
                                    </option>
                                    @endforeach
                                </select> @error('position_id') <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        {{-- RIGHT SIDE --}}
                        <div class="col-md-4">
                            {{-- PASSWORD --}}
                            <div class="form-group mb-3">
                                <label>Password</label> <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    required> @error('password') <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            {{-- CONFIRM PASSWORD --}}
                            <div class="form-group mb-3">
                                <label>Confirm Password</label> <input type="password" name="password_confirmation"
                                    class="form-control" placeholder="Confirm Password" required>
                            </div>

                            {{-- EXPERIENCE --}}
                            <div class="form-group mb-3">
                                <label>Experience (Years)</label> <input type="number" name="experience"
                                    class="form-control @error('experience') is-invalid @enderror"
                                    value="{{ old('experience') }}" placeholder="Experience" min="0">
                                @error('experience') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>

                            <!-- {{-- SALARY --}}
                            <div class="form-group mb-3">
                                <label>Salary</label> <input type="number" step="0.01" name="salary"
                                    class="form-control @error('salary') is-invalid @enderror"
                                    value="{{ old('salary') }}" placeholder="Salary" min="0"> @error('salary') <span
                                    class="text-danger"> {{ $message }} </span> @enderror
                            </div> -->

                            {{-- VACATION --}}
                            <div class="form-group mb-3">
                                <label>Vacation Days</label> <input type="number" name="vacation"
                                    class="form-control @error('vacation') is-invalid @enderror"
                                    value="{{ old('vacation') }}" placeholder="Vacation Days" min="0">
                                @error('vacation') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>
                            {{-- ROLE --}}
                            <div class="form-group mb-3">
                                <label>Role</label>

                                <select
                                    name="role_id"
                                    id="role_id"
                                    class="form-control @error('role_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">Select Role</option>

                                    @foreach($roles as $role)
                                        <option
                                            value="{{ $role->id }}"
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}
                                        >
                                            {{ $role->display_name ?? $role->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('role_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- CITY --}}
                            <div class="form-group mb-3">
                                <label>City</label> <input type="text" name="city"
                                    class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}"
                                    placeholder="City"> @error('city') <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            {{-- DATE OF BIRTH --}}
                            <div class="form-group mb-3">
                                <label>Date of Birth</label> <input type="date" name="date_of_birth"
                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                    value="{{ old('date_of_birth') }}"> @error('date_of_birth') <span
                                    class="text-danger"> {{ $message }} </span> @enderror
                            </div>

                            {{-- GENDER --}}
                            <div class="form-group mb-3">
                                <label>Gender</label> <select name="gender"
                                    class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender')=='male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender')=='female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender')=='other' ? 'selected' : '' }}>Other</option>
                                </select> @error('gender') <span class="text-danger"> {{ $message }} </span> @enderror
                            </div>

                        </div>
                    </div>
                    {{-- SUBMIT --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success waves-effect waves-light"> <i
                                class="bi bi-person-plus"></i> Add Employee </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- IMAGE PREVIEW --}}
<script>
    function readURL(input) {
        
        if (input.files && input.files[0]) {
            let reader = new FileReader();


            reader.onload = function (e) {
                document.getElementById('image').src = e.target.result;
            };



            reader.readAsDataURL(input.files[0]);
        }


    }


    //  | FILTER POSITIONS BY DEPARTMENT |


    document.addEventListener('DOMContentLoaded', function () {
        const department = document.getElementById('department_id');
        const position = document.getElementById('position_id');


        if (!department || !position) {
            return;
        }



        function filterPositions() {
            const departmentId = department.value;



            Array.from(position.options).forEach(function (option) {
                if (!option.value) {
                    option.hidden = false;
                    return;
                }



                const optionDepartment = option.dataset.department;



                option.hidden = optionDepartment !== departmentId;
            });



            /*
            |--------------------------------------------------------------------------
            | Reset invalid selected position
            |--------------------------------------------------------------------------
            */



            const selectedOption =
                position.options[position.selectedIndex];



            if (
                selectedOption &&
                selectedOption.value &&
                selectedOption.dataset.department !== departmentId
            ) {
                position.value = '';
            }
        }



        department.addEventListener('change', filterPositions);



        filterPositions();


    });

</script>
@endsection
