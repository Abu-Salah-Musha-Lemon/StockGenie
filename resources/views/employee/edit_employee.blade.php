@extends('layouts.layout')

@section('main')

<style>
    label {
        width: auto;
    }

    .employee-container {
        display: flex;
        flex-wrap: wrap;
    }

    .photo-preview {
        width: 190px;
        height: 190px;
        object-fit: cover;
        border-radius: 16px;
        border: 1px solid #ddd;
    }

    .photo-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .text-danger {
        /* display: block; */
        margin-top: 4px;
				font-size: large;
    }
</style>

<div class="row" style="display:flex; justify-content:center; align-items:center;">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

        <div class="panel panel-info">

            {{-- Header --}}
            <div class="panel-heading"
                 style="display:flex; justify-content:space-between; align-items:center;">

                <h3 class="panel-title text-white">
                    Edit Employee
                </h3>

                <a class="panel-title fs-4"
                   href="{{ route('admin.employees.index') }}">
                    <i class="bi bi-box-arrow-in-left"
                       style="font-size:24px;color:white;"></i>
                </a>

            </div>

            {{-- Body --}}
            <div class="panel-body">

                <form
                    role="form"
                    action="{{ route('admin.employees.update', $employee->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf
                    @method('PUT')

                    <div class="row employee-container">

                        {{-- =====================================================
                             PHOTO COLUMN
                        ====================================================== --}}
                        <div class="col-sm-12 col-md-4 col-lg-3">

                            <div class="form-group">

                                <div class="photo-wrapper">

                                    <div style="margin-bottom:10px;">
                                        <strong>Photo</strong>
                                    </div>

                                    {{-- Current / Preview Image --}}
                                    <img
                                        id="image"
                                        class="photo-preview"
                                        src="{{ $employee->photo ? asset($employee->photo) : asset('images/default-user.png') }}"
                                        alt="Employee Photo"
                                    />

                                    {{-- Upload Button --}}
                                    <div
                                        class="fileUpload btn btn-success waves-effect waves-light"
                                        style="margin-top:15px;"
                                    >

                                        <span>
                                            <i class="ion-upload m-r-5"></i>
                                            Upload
                                        </span>

                                        <input
                                            type="file"
                                            name="photo"
                                            id="photo"
                                            accept="image/jpeg,image/png,image/jpg,image/webp"
                                            class="upload form-control"
                                            onchange="readURL(this);"
                                        >

                                    </div>

                                    {{-- Old photo --}}
                                    <input
                                        type="hidden"
                                        name="old_photo"
                                        value="{{ $employee->photo }}"
                                    >

                                </div>

                                @error('photo')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>


                        {{-- =====================================================
                             FIRST INFORMATION COLUMN
                        ====================================================== --}}
                        <div class="col-sm-12 col-md-5 col-lg-4">

                            {{-- Name --}}
                            <div class="form-group">

                                <label for="name">
                                    Name
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    placeholder="Enter Name"
                                    value="{{ old('name', $user->name ?? '') }}"
                                >

                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- First Name --}}
                            <div class="form-group">

                                <label for="first_name">
                                    First Name <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="first_name"
                                    id="first_name"
                                    placeholder="Enter First Name"
                                    value="{{ old('first_name', $employee->first_name) }}"
                                    required
                                >

                                @error('first_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Last Name --}}
                            <div class="form-group">

                                <label for="last_name">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="last_name"
                                    id="last_name"
                                    placeholder="Enter Last Name"
                                    value="{{ old('last_name', $employee->last_name) }}"
                                >

                                @error('last_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- NID --}}
                            <div class="form-group">

                                <label for="nid">
                                    NID <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="nid"
                                    id="nid"
                                    placeholder="Enter NID Number"
                                    value="{{ old('nid', $employee->nid) }}"
                                    required
                                >

                                @error('nid')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Phone Number --}}
                            <div class="form-group">

                                <label for="phone_number">
                                    Phone Number <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="tel"
                                    class="form-control"
                                    name="phone_number"
                                    id="phone_number"
                                    placeholder="Enter Phone Number"
                                    value="{{ old('phone_number', $employee->phone_number) }}"
                                    maxlength="11"
                                    required
                                >

                                @error('phone_number')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Email --}}
                            <div class="form-group">

                                <label for="email">
                                    Email Address <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    id="email"
                                    placeholder="Enter Email"
                                    value="{{ old('email', $user->email ?? $employee->email ?? '') }}"
                                    required
                                >

                                @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Address --}}
                            <div class="form-group">

                                <label for="address">
                                    Address
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="address"
                                    id="address"
                                    placeholder="Enter Address"
                                    value="{{ old('address', $employee->address) }}"
                                >

                                @error('address')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- City --}}
                            <div class="form-group">

                                <label for="city">
                                    City
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    name="city"
                                    id="city"
                                    placeholder="Enter City"
                                    value="{{ old('city', $employee->city) }}"
                                >

                                @error('city')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>


                        {{-- =====================================================
                             SECOND INFORMATION COLUMN
                        ====================================================== --}}
                        <div class="col-sm-12 col-md-5 col-lg-4">

                            {{-- Date of Birth --}}
                            <div class="form-group">

                                <label for="date_of_birth">
                                    Date of Birth
                                </label>

                                <input
                                    type="date"
                                    class="form-control"
                                    name="date_of_birth"
                                    id="date_of_birth"
                                    value="{{ old('date_of_birth', $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') : '') }}"
                                >

                                @error('date_of_birth')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Gender --}}
                            <div class="form-group">

                                <label for="gender">
                                    Gender
                                </label>

                                <select
                                    name="gender"
                                    id="gender"
                                    class="form-control"
                                >

                                    <option value="">
                                        Select Gender
                                    </option>

                                    <option
                                        value="male"
                                        {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}
                                    >
                                        Male
                                    </option>

                                    <option
                                        value="female"
                                        {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}
                                    >
                                        Female
                                    </option>

                                    <option
                                        value="other"
                                        {{ old('gender', $employee->gender) == 'other' ? 'selected' : '' }}
                                    >
                                        Other
                                    </option>

                                </select>

                                @error('gender')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Experience --}}
                            <div class="form-group">

                                <label for="experience">
                                    Experience
                                </label>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="experience"
                                    id="experience"
                                    placeholder="Enter Experience"
                                    value="{{ old('experience', $employee->experience) }}"
                                    min="0"
                                >

                                @error('experience')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Salary --}}
                            <div class="form-group">

                                <label for="salary">
                                    Salary
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    class="form-control"
                                    name="salary"
                                    id="salary"
                                    placeholder="Enter Salary"
                                    value="{{ old('salary', $employee->salary) }}"
                                    min="0"
                                >

                                @error('salary')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Vacation --}}
                            <div class="form-group">

                                <label for="vacation">
                                    Vacation
                                </label>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="vacation"
                                    id="vacation"
                                    placeholder="Enter Vacation"
                                    value="{{ old('vacation', $employee->vacation) }}"
                                    min="0"
                                >

                                @error('vacation')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Department --}}
                            <div class="form-group">

                                <label for="department_id">
                                    Department <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="department_id"
                                    id="department_id"
                                    class="form-control"
                                    required
                                >

                                    <option value="">
                                        Select Department
                                    </option>

                                    @foreach($allDepartments as $row)

                                        <option
                                            value="{{ $row->id }}"
                                            {{ old('department_id', $employee->department_id) == $row->id ? 'selected' : '' }}
                                        >
                                            {{ $row->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('department_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>


                            {{-- Position --}}
                            <div class="form-group">

                                <label for="position_id">
                                    Position <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="position_id"
                                    id="position_id"
                                    class="form-control"
                                    required
                                >

                                    <option value="">
                                        Select Position
                                    </option>

                                    @foreach($allPositions as $row)

                                        <option
                                            value="{{ $row->id }}"
                                            data-department="{{ $row->department_id }}"
                                            {{ old('position_id', $employee->position_id) == $row->id ? 'selected' : '' }}
                                        >
                                            {{ $row->title }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('position_id')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- =====================================================
                         BUTTONS
                    ====================================================== --}}
                    <div
                        class="form-group mx-2 my-2"
                        style="text-align:center;"
                    >

                        <a
                            href="{{ route('admin.employees.index') }}"
                            class="btn btn-info waves-effect waves-light w-sm m-b-5"
                        >
                            <i class="glyphicon glyphicon-arrow-left"></i>
                            Back
                        </a>

                        <button
                            type="submit"
                            class="btn btn-purple waves-effect waves-light w-sm m-b-5"
                        >
                            Update
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


{{-- =====================================================
     IMAGE PREVIEW
====================================================== --}}
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {

            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('image').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


{{-- =====================================================
     DEPARTMENT / POSITION FILTER
====================================================== --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const departmentSelect = document.getElementById('department_id');
        const positionSelect = document.getElementById('position_id');

        function filterPositions() {

            const departmentId = departmentSelect.value;

            const options = positionSelect.querySelectorAll('option');

            options.forEach(function(option) {

                if (!option.value) {
                    option.style.display = '';
                    return;
                }

                const optionDepartment = option.getAttribute('data-department');

                if (optionDepartment === departmentId) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';

                    if (option.selected) {
                        option.selected = false;
                    }
                }
            });

        }

        departmentSelect.addEventListener('change', filterPositions);

        // Run once when page loads
        filterPositions();

    });
</script>

@endsection
