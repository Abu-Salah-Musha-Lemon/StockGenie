@extends('layouts.layout')

@section('main')

<div class="container-fluid py-4">

    {{-- =========================================================
        FLASH MESSAGES
    ========================================================== --}}

    @if(session('success'))
    <div id="successMessage" data-message="{{ session('success') }}" style="display:none;"></div>
    @endif

    @if(session('error'))
    <div id="errorMessage" data-message="{{ session('error') }}" style="display:none;"></div>
    @endif


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors-> any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>

        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="mb-4 mx-2">

        <div>
            <h3 class="font-weight-bold mb-1">
                <i class="bi bi-building text-primary mr-2"></i>
                Warehouses 
            </h3>

            <p class="text-muted mb-0">
                Manage your warehouses and storage locations.
            </p>
        </div>

        <button type="button" class="btn btn-primary shadow-sm mx-2 my-2" data-toggle="modal" data-target="#addWarehouseModal">

            <i class="bi bi-plus-lg mr-1"></i>
            Add Warehouse

        </button>

    </div>


    {{-- =========================================================
        STATISTICS
    ========================================================== --}}

    <div class="row mb-4">

        {{-- TOTAL --}}

        <div class="col-lg-4 col-md-4 mb-3">

            <div class="card dashboard-stat-card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Total Warehouses
                            </small>

                            <h3 class="font-weight-bold mb-0">
                                {{ $totalWarehouses }}
                            </h3>

                        </div>

                        <div class="stat-icon bg-primary">
                            <i class="bi bi-building"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ACTIVE --}}

        <div class="col-lg-4 col-md-4 mb-3">

            <div class="card dashboard-stat-card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Active Warehouses
                            </small>

                            <h3 class="font-weight-bold text-success mb-0">
                                {{ $activeWarehouses }}
                            </h3>

                        </div>

                        <div class="stat-icon bg-success">
                            <i class="bi bi-check-circle"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- INACTIVE --}}

        <div class="col-lg-4 col-md-4 mb-3">

            <div class="card dashboard-stat-card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">
                                Inactive Warehouses
                            </small>

                            <h3 class="font-weight-bold text-danger mb-0">
                                {{ $inactiveWarehouses }}
                            </h3>

                        </div>

                        <div class="stat-icon bg-danger">
                            <i class="bi bi-x-circle"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        WAREHOUSE TABLE
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        {{-- FILTER --}}

        <div class="card-header bg-white border-0 py-3">

            <form action="{{ route('warehouses.index') }}" method="GET">

                <div class="row">

                    <div class="col-md-7 mb-2 mb-md-0">

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <span class="input-group-text bg-light border-right-0">

                                    <i class="bi bi-search text-muted"></i>

                                </span>

                            </div>

                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control border-left-0" placeholder="Search warehouse or location...">

                        </div>

                    </div>


                    <div class="col-md-3 mb-2 mb-md-0">

                        <select name="status" class="form-control">

                            <option value="">
                                All Status
                            </option>

                            {{-- IMPORTANT:
                                 Database status is INTEGER
                                 1 = Active
                                 0 = Inactive
                            --}}

                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    <div class="col-md-2">

                        <button type="submit" class="btn btn-primary btn-block">

                            <i class="bi bi-search mr-1"></i>

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>


        {{-- =====================================================
            TABLE
        ====================================================== --}}

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="thead-light">

                        <tr>

                            <th width="70">
                                #
                            </th>

                            <th>
                                Warehouse
                            </th>

                            <th>
                                Location
                            </th>

                            <th width="120">
                                Status
                            </th>

                            <th width="160" class="text-center">

                                Action

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($warehouses as $warehouse)

                        <tr>

                            {{-- NUMBER --}}

                            <td class="align-middle text-muted">

                                {{ $warehouses->firstItem() + $loop->index }}

                            </td>


                            {{-- NAME --}}

                            <td class="align-middle">

                                <div class="d-flex align-items-center">

                                    <div class="warehouse-avatar mr-3">

                                        <i class="bi bi-building"></i>

                                    </div>


                                    <div>

                                        <strong class="d-block">

                                            {{ $warehouse->name }}

                                        </strong>

                                        <small class="text-muted">

                                            #{{ $warehouse->id }}

                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- LOCATION --}}

                            <td class="align-middle">

                                @if($warehouse->location)

                                <span>

                                    <i class="bi bi-geo-alt-fill text-danger mr-1"></i>

                                    {{ $warehouse->location }}

                                </span>

                                @else

                                <span class="text-muted">
                                    Not specified
                                </span>

                                @endif

                            </td>


                            {{-- STATUS --}}

                            <td class="align-middle">

                                @if((int) $warehouse->status === 1)

                                <span class="badge badge-success status-badge">

                                    <i class="bi bi-check-circle mr-1"></i>

                                    Active

                                </span>

                                @else

                                <span class="badge badge-danger status-badge">

                                    <i class="bi bi-x-circle mr-1"></i>

                                    Inactive

                                </span>

                                @endif

                            </td>


                            {{-- ACTIONS --}}

                            <td class="align-middle text-center">

                                <div class="btn-group" role="group">


                                    {{-- VIEW --}}

                                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal"
                                        data-target="#viewWarehouseModal" data-id="{{ $warehouse->id }}"
                                        data-name="{{ $warehouse->name }}" data-location="{{ $warehouse->location }}"
                                        data-status="{{ (int) $warehouse->status }}" title="View">

                                        <i class="bi bi-eye"></i>

                                    </button>


                                    {{-- EDIT --}}

                                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                        data-target="#editWarehouseModal" data-id="{{ $warehouse->id }}"
                                        data-name="{{ $warehouse->name }}" data-location="{{ $warehouse->location }}"
                                        data-status="{{ (int) $warehouse->status }}" title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </button>


                                    {{-- DELETE --}}

                                    <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST"
                                        class="delete-warehouse-form d-inline">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <div class="empty-state">

                                    <i class="bi bi-building"></i>

                                    <h5 class="mt-3">
                                        No warehouses found
                                    </h5>

                                    <p class="text-muted">
                                        Add your first warehouse to get started.
                                    </p>

                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#addWarehouseModal">

                                        <i class="bi bi-plus-lg mr-1"></i>

                                        Add Warehouse

                                    </button>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                PAGINATION
            ================================================== --}}

            @if($warehouses->hasPages())

            <div class="card-footer bg-white border-top">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <small class="text-muted mb-2 mb-md-0">

                        Showing

                        <strong>
                            {{ $warehouses->firstItem() }}
                        </strong>

                        -

                        <strong>
                            {{ $warehouses->lastItem() }}
                        </strong>

                        of

                        <strong>
                            {{ $warehouses->total() }}
                        </strong>

                    </small>


                    <div>

                        {{ $warehouses->appends(request()->query())->links() }}

                    </div>

                </div>

            </div>

            @endif

        </div>

    </div>

</div>


{{-- =============================================================
    ADD WAREHOUSE MODAL
============================================================== --}}

<div class="modal fade" id="addWarehouseModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content border-0 shadow-lg">

            <form action="{{ route('warehouses.store') }}" method="POST">

                @csrf


                <div class="modal-header bg-primary text-white">

                    <div>

                        <h5 class="modal-title mb-1">

                            <i class="bi bi-building mr-1"></i>

                            Add Warehouse

                        </h5>

                        <small>
                            Create a new warehouse.
                        </small>

                    </div>


                    <button type="button" class="close text-white" data-dismiss="modal">

                        <span>
                            &times;
                        </span>

                    </button>

                </div>


                <div class="modal-body p-4">

                    {{-- NAME --}}

                    <div class="form-group">

                        <label class="font-weight-bold">

                            Warehouse Name

                            <span class="text-danger">
                                *
                            </span>

                        </label>

                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="Example: Main Warehouse" required>

                    </div>


                    {{-- LOCATION --}}

                    <div class="form-group">

                        <label class="font-weight-bold">

                            Location

                        </label>

                        <textarea name="location" rows="3" class="form-control"
                            placeholder="Example: Dhaka, Bangladesh">{{ old('location') }}</textarea>

                    </div>


                    {{-- STATUS --}}

                    <div class="form-group mb-0">

                        <label class="font-weight-bold">

                            Status

                        </label>

                        {{-- IMPORTANT:
                             INTEGER VALUE ONLY
                             1 = Active
                             0 = Inactive
                        --}}

                        <select name="status" class="form-control" required>

                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>

                                Active

                            </option>

                            <option value="0" {{ old('status') == 0 && old('status') !== null ? 'selected' : '' }}>

                                Inactive

                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer bg-light">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">

                        Cancel

                    </button>


                    <button type="submit" class="btn btn-primary">

                        <i class="bi bi-check-circle mr-1"></i>

                        Save Warehouse

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =============================================================
    VIEW WAREHOUSE MODAL
============================================================== --}}

<div class="modal fade" id="viewWarehouseModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header bg-info text-white">

                <h5 class="modal-title">

                    <i class="bi bi-eye mr-1"></i>

                    Warehouse Details

                </h5>


                <button type="button" class="close text-white" data-dismiss="modal">

                    <span>
                        &times;
                    </span>

                </button>

            </div>


            <div class="modal-body p-4">

                <div class="text-center mb-4">

                    <div class="warehouse-view-icon">

                        <i class="bi bi-building"></i>

                    </div>


                    <h4 id="viewWarehouseName" class="font-weight-bold mt-3 mb-1">

                        -

                    </h4>


                    <small id="viewWarehouseId" class="text-muted">

                        -

                    </small>

                </div>


                <div class="detail-box mb-3">

                    <small class="text-muted d-block mb-1">

                        <i class="bi bi-geo-alt mr-1"></i>

                        Location

                    </small>

                    <strong id="viewWarehouseLocation">

                        -

                    </strong>

                </div>


                <div class="detail-box">

                    <small class="text-muted d-block mb-1">

                        Status

                    </small>

                    <span id="viewWarehouseStatus">

                        -

                    </span>

                </div>

            </div>


            <div class="modal-footer bg-light">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">

                    Close

                </button>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
    EDIT WAREHOUSE MODAL
============================================================== --}}

<div class="modal fade" id="editWarehouseModal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content border-0 shadow-lg">

            <form method="POST" id="editWarehouseForm">

                @csrf

                @method('PUT')


                <div class="modal-header bg-primary text-white">

                    <h5 class="modal-title">

                        <i class="bi bi-pencil-square mr-1"></i>

                        Edit Warehouse

                    </h5>


                    <button type="button" class="close text-white" data-dismiss="modal">

                        <span>
                            &times;
                        </span>

                    </button>

                </div>


                <div class="modal-body p-4">

                    {{-- NAME --}}

                    <div class="form-group">

                        <label class="font-weight-bold">

                            Warehouse Name

                            <span class="text-danger">
                                *
                            </span>

                        </label>

                        <input type="text" name="name" id="editWarehouseName" class="form-control" required>

                    </div>


                    {{-- LOCATION --}}

                    <div class="form-group">

                        <label class="font-weight-bold">

                            Location

                        </label>

                        <textarea name="location" id="editWarehouseLocation" rows="3" class="form-control"></textarea>

                    </div>


                    {{-- STATUS --}}

                    <div class="form-group mb-0">

                        <label class="font-weight-bold">

                            Status

                        </label>

                        {{-- INTEGER VALUES --}}

                        <select name="status" id="editWarehouseStatus" class="form-control" required>

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer bg-light">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">

                        Cancel

                    </button>


                    <button type="submit" class="btn btn-primary">

                        <i class="bi bi-save mr-1"></i>

                        Update Warehouse

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


@endsection


@section('script')

{{-- =============================================================
    SWEETALERT2
============================================================== --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- <style>
    .dashboard-stat-card {
        border-radius: 12px;
        transition: all .2s ease;
    }

    .dashboard-stat-card:hover {
        transform: translateY(-2px);
    }

    .stat-icon {

        width: 50px;
        height: 50px;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        color: #fff;

        font-size: 20px;

    }

    .warehouse-avatar {

        width: 44px;
        height: 44px;

        border-radius: 50%;

        background: #eef4ff;

        color: #007bff;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 18px;

    }

    .warehouse-view-icon {

        width: 80px;
        height: 80px;

        border-radius: 50%;

        background: #eef4ff;

        color: #007bff;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        font-size: 35px;

    }

    .detail-box {

        background: #f8f9fa;

        border: 1px solid #e9ecef;

        border-radius: 8px;

        padding: 15px;

    }

    .status-badge {

        padding: 7px 10px;

        border-radius: 20px;

    }

    .empty-state {

        padding: 20px;

    }

    .empty-state>i {

        font-size: 55px;

        color: #adb5bd;

    }

    .table th {

        font-size: 12px;

        text-transform: uppercase;

        letter-spacing: .3px;

        white-space: nowrap;

    }

    .table td {

        vertical-align: middle;

    }

    .btn {

        border-radius: 6px;

    }

    .modal-content {

        border-radius: 12px;

        overflow: hidden;

    }

    .pagination {

        margin-bottom: 0;

    }

</style> -->


<script>
    $(document).ready(function () {


        /*
        |--------------------------------------------------------------------------
        | SUCCESS TOAST
        |--------------------------------------------------------------------------
        */

        const successMessage =
            $('#successMessage').data('message');


        if (successMessage) {

            Swal.fire({

                toast: true,

                position: 'top-end',

                icon: 'success',

                title: successMessage,

                showConfirmButton: false,

                timer: 3000,

                timerProgressBar: true

            });

        }


        /*
        |--------------------------------------------------------------------------
        | ERROR TOAST
        |--------------------------------------------------------------------------
        */

        const errorMessage =
            $('#errorMessage').data('message');


        if (errorMessage) {

            Swal.fire({

                toast: true,

                position: 'top-end',

                icon: 'error',

                title: errorMessage,

                showConfirmButton: false,

                timer: 4000,

                timerProgressBar: true

            });

        }


        /*
        |--------------------------------------------------------------------------
        | VIEW WAREHOUSE
        |--------------------------------------------------------------------------
        */

        $('#viewWarehouseModal').on(
            'show.bs.modal',
            function (event) {

                const button =
                    $(event.relatedTarget);


                const id =
                    button.attr('data-id');

                const name =
                    button.attr('data-name');

                const location =
                    button.attr('data-location');

                const status =
                    parseInt(
                        button.attr('data-status'),
                        10
                    );


                $('#viewWarehouseId').text(
                    'Warehouse #' + id
                );


                $('#viewWarehouseName').text(
                    name
                );


                $('#viewWarehouseLocation').text(
                    location || 'No location specified'
                );


                /*
                |--------------------------------------------------------------------------
                | INTEGER STATUS
                |--------------------------------------------------------------------------
                */

                if (status === 1) {

                    $('#viewWarehouseStatus').html(

                        '<span class="badge badge-success px-3 py-2">' +

                        '<i class="bi bi-check-circle mr-1"></i>' +

                        'Active' +

                        '</span>'

                    );

                } else {

                    $('#viewWarehouseStatus').html(

                        '<span class="badge badge-danger px-3 py-2">' +

                        '<i class="bi bi-x-circle mr-1"></i>' +

                        'Inactive' +

                        '</span>'

                    );

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | EDIT WAREHOUSE
        |--------------------------------------------------------------------------
        */

        $('#editWarehouseModal').on(
            'show.bs.modal',
            function (event) {

                const button =
                    $(event.relatedTarget);


                const id =
                    button.attr('data-id');

                const name =
                    button.attr('data-name');

                const location =
                    button.attr('data-location');

                const status =
                    button.attr('data-status');


                /*
                |--------------------------------------------------------------------------
                | FORM ACTION
                |--------------------------------------------------------------------------
                */

                $('#editWarehouseForm').attr(

                    'action',

                    "{{ url('warehouses') }}/" + id

                );


                /*
                |--------------------------------------------------------------------------
                | FILL FORM
                |--------------------------------------------------------------------------
                */

                $('#editWarehouseName').val(
                    name
                );


                $('#editWarehouseLocation').val(
                    location || ''
                );


                /*
                |--------------------------------------------------------------------------
                | IMPORTANT:
                | Database status is 1/0
                |--------------------------------------------------------------------------
                */

                $('#editWarehouseStatus').val(
                    String(status)
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | DELETE CONFIRMATION
        |--------------------------------------------------------------------------
        */

        $('.delete-warehouse-form').on(
            'submit',
            function (event) {

                event.preventDefault();


                const form =
                    this;


                const warehouseName =
                    $(form)
                    .closest('tr')
                    .find('td:eq(1) strong')
                    .first()
                    .text()
                    .trim();


                Swal.fire({

                    title: 'Delete warehouse?',

                    html:

                        'You are about to delete ' +

                        '<strong>' +

                        $('<div>')
                        .text(warehouseName)
                        .html() +

                        '</strong>.' +

                        '<br><br>' +

                        '<span class="text-danger">' +

                        'This action cannot be undone.' +

                        '</span>',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#dc3545',

                    cancelButtonColor: '#6c757d',

                    confirmButtonText:

                        '<i class="bi bi-trash mr-1"></i> Yes, Delete',

                    cancelButtonText: 'Cancel',

                    reverseButtons: true

                }).then(function (result) {

                    if (result.isConfirmed) {

                        form.submit();

                    }

                });

            }
        );


        /*
        |--------------------------------------------------------------------------
        | RESET ADD MODAL
        |--------------------------------------------------------------------------
        */

        $('#addWarehouseModal').on(
            'hidden.bs.modal',
            function () {

                const form =
                    $(this).find('form')[0];


                if (form) {

                    form.reset();

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | IF VALIDATION ERROR
        | OPEN ADD MODAL
        |--------------------------------------------------------------------------
        */

        @if($errors-> any())

        $('#addWarehouseModal').modal('show');

        @endif


    });

</script>

@endsection
