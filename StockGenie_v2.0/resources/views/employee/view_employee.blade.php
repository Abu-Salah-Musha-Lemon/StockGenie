@extends('layouts.layout')

@section('main')

<style>
    label {
        width: auto;
        font-weight: 600;
    }

    .employee-photo {
        width: 190px;
        height: 190px;
        object-fit: cover;
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }
</style>

<div class="row" style="display:flex;justify-content:center;align-items:center;">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

        <div class="panel panel-info">

            {{-- Header --}}
            <div class="panel-heading"
                 style="display:flex;justify-content:space-between;align-items:center;">

                <h3 class="panel-title text-white">
                    View Employee
                </h3>

                <a class="panel-title fs-4"
                   href="{{ route('admin.employees.index') }}">

                    <i class="bi bi-box-arrow-in-left"
                       style="font-size:24px;color:white;">
                    </i>

                </a>

            </div>

            <div class="panel-body">

                <div class="row">

                    {{-- ========================================= --}}
                    {{-- PHOTO --}}
                    {{-- ========================================= --}}

                    <div class="col-sm-12 col-md-4 col-lg-4">

                        <div class="form-group my-2">

                            <div class="input-group mb-3"
                                 style="display:flex;
                                        justify-content:center;
                                        align-items:center;
                                        flex-direction:column;">

                                <div class="input-group-prepend">
                                    <span>Photo</span>
                                </div>

                                @if($employee->photo)

                                    <img
                                        class="employee-photo"
                                        src="{{ asset($employee->photo) }}"
                                        alt="Employee Photo"
                                    >

                                @else

                                    <div class="employee-photo"
                                         style="display:flex;
                                                justify-content:center;
                                                align-items:center;
                                                background:#f5f5f5;">

                                        No Photo

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- ========================================= --}}
                    {{-- PERSONAL INFORMATION --}}
                    {{-- ========================================= --}}

                    <div class="col-sm-12 col-md-4 col-lg-4">

                        <h4 class="text-primary">Personal Information</h4>

                        {{-- Name --}}
                        <div class="form-group">

                            <label>Name</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $user->name ?? 'N/A' }}"
                                disabled
                            >

                        </div>


                        {{-- NID --}}
                        <div class="form-group">

                            <label>NID</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $employee->nid ?? 'N/A' }}"
                                disabled
                            >

                        </div>


                        {{-- Phone --}}
                        <div class="form-group">

                            <label>Phone Number</label>

                            <input
                                type="tel"
                                class="form-control"
                                value="{{ $employee->phone_number ?? 'N/A' }}"
                                disabled
                            >

                        </div>


                        {{-- Email --}}
                        <div class="form-group">

                            <label>Email Address</label>

                            <input
                                type="email"
                                class="form-control"
                                value="{{ $user->email ?? 'N/A' }}"
                                disabled
                            >

                        </div>


                        {{-- Address --}}
                        <div class="form-group">

                            <label>Address</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $employee->address ?? 'N/A' }}"
                                disabled
                            >

                        </div>

                    </div>


                    {{-- ========================================= --}}
                    {{-- EMPLOYEE INFORMATION --}}
                    {{-- ========================================= --}}

                    <div class="col-sm-12 col-md-4 col-lg-4">

                        <h4 class="text-primary">Employee Information</h4>

                        {{-- Experience --}}
                        <div class="form-group">

                            <label>Experience</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $employee->experience ?? 'N/A' }}"
                                disabled
                            >

                        </div>


                        {{-- Salary --}}
                        <div class="form-group">

                            <label>Salary</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $employee->salary ?? 'N/A' }}"
                                disabled
                            >

                        </div>


                        {{-- Vacation --}}
                        <div class="form-group">

                            <label>Vacation</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $employee->vacation ?? 'N/A' }}"
                                disabled
                            >

                        </div>


                        {{-- City --}}
                        <div class="form-group">

                            <label>City</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $employee->city ?? 'N/A' }}"
                                disabled
                            >

                        </div>

                    </div>

                </div>


                {{-- ========================================= --}}
                {{-- DATES --}}
                {{-- ========================================= --}}

                <hr>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Created At</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $employee->created_at
                                    ? \Carbon\Carbon::parse($employee->created_at)->format('d M Y, h:i A')
                                    : 'N/A' }}"
                                disabled
                            >

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Last Updated</label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $employee->updated_at
                                    ? \Carbon\Carbon::parse($employee->updated_at)->format('d M Y, h:i A')
                                    : 'N/A' }}"
                                disabled
                            >

                        </div>

                    </div>

                </div>


                {{-- ========================================= --}}
                {{-- BUTTONS --}}
                {{-- ========================================= --}}

								<div class="margin-top-20">

										<a
												href="{{ route('admin.employees.index') }}"
												class="btn btn-default">

												<i class="glyphicon glyphicon-arrow-left"></i>
												Back

										</a>

										<a
												href="{{ route('admin.employees.edit', $employee->id) }}"
												class="btn btn-primary">

												<i class="glyphicon glyphicon-pencil"></i>
												Edit Employee

										</a>

								</div>


            </div>

        </div>

    </div>

</div>

@endsection
