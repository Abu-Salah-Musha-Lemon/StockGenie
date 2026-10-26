@extends('layouts.layout')

@section('main')

<div class="container-fluid py-4">

    {{-- =========================================================
        FLASH MESSAGES
    ========================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm">

            <i class="bi bi-check-circle-fill mr-2"></i>

            <strong>Success!</strong>
            {{ session('success') }}

            <button
                type="button"
                class="close"
                data-dismiss="alert"
            >
                <span>&times;</span>
            </button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show shadow-sm">

            <i class="bi bi-exclamation-triangle-fill mr-2"></i>

            <strong>Error!</strong>
            {{ session('error') }}

            <button
                type="button"
                class="close"
                data-dismiss="alert"
            >
                <span>&times;</span>
            </button>

        </div>

    @endif


    @if(session('info'))

        <div class="alert alert-info alert-dismissible fade show shadow-sm">

            <i class="bi bi-info-circle-fill mr-2"></i>

            {{ session('info') }}

            <button
                type="button"
                class="close"
                data-dismiss="alert"
            >
                <span>&times;</span>
            </button>

        </div>

    @endif


    {{-- VALIDATION ERRORS --}}

    @if($errors->any())

        <div class="alert alert-danger shadow-sm">

            <strong>
                <i class="bi bi-exclamation-octagon-fill mr-1"></i>
                Please fix the following:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h3 class="font-weight-bold mb-1">

                <i class="bi bi-people-fill text-primary mr-2"></i>

                Customers

            </h3>

            <p class="text-muted mb-0">
                Manage your customers and their contact information.
            </p>

        </div>


        <div class="mt-3 mt-md-0">

            <a
                href="{{ route('customers.create') }}"
                class="btn btn-primary shadow-sm"
            >

                <i class="bi bi-person-plus-fill mr-1"></i>

                Add Customer

            </a>

        </div>

    </div>


    {{-- =========================================================
        CUSTOMER CARD
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <div class="row align-items-center">

                {{-- SEARCH --}}

                <div class="col-md-7">

                    <form
                        action="{{ route('customers.index') }}"
                        method="GET"
                    >

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <span class="input-group-text bg-light border-right-0">

                                    <i class="bi bi-search text-muted"></i>

                                </span>

                            </div>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-left-0"
                                placeholder="Search by name, phone or email..."
                            >

                            <div class="input-group-append">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Search
                                </button>

                                @if(request('search'))

                                    <a
                                        href="{{ route('customers.index') }}"
                                        class="btn btn-outline-secondary"
                                    >
                                        Clear
                                    </a>

                                @endif

                            </div>

                        </div>

                    </form>

                </div>


                {{-- COUNT --}}

                <div class="col-md-5 text-md-right mt-3 mt-md-0">

                    <span class="badge badge-light border px-3 py-2">

                        <i class="bi bi-people text-primary mr-1"></i>

                        {{ $customers->total() }}

                        Customer(s)

                    </span>

                </div>

            </div>

        </div>


        <div class="card-body p-0">

            @if($customers->count())

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead class="thead-light">

                            <tr>

                                <th width="60">
                                    #
                                </th>

                                <th>
                                    Customer
                                </th>

                                <th>
                                    Phone
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Address
                                </th>

                                <th width="150" class="text-center">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($customers as $customer)

                                <tr>

                                    {{-- NUMBER --}}

                                    <td class="align-middle text-muted">

                                        {{ $customers->firstItem() + $loop->index }}

                                    </td>


                                    {{-- CUSTOMER --}}

                                    <td class="align-middle">

                                        <div class="d-flex align-items-center">

                                            <div
                                                class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-3"
                                                style="width:42px;height:42px;"
                                            >

                                                <strong>
                                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                                </strong>

                                            </div>


                                            <div>

                                                <div class="font-weight-bold">

                                                    {{ $customer->name }}

                                                </div>

                                                <small class="text-muted">

                                                    Customer #{{ $customer->id }}

                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- PHONE --}}

                                    <td class="align-middle">

                                        @if($customer->phone)

                                            <a
                                                href="tel:{{ $customer->phone }}"
                                                class="text-dark"
                                            >

                                                <i class="bi bi-telephone mr-1 text-primary"></i>

                                                {{ $customer->phone }}

                                            </a>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- EMAIL --}}

                                    <td class="align-middle">

                                        @if($customer->email)

                                            <a
                                                href="mailto:{{ $customer->email }}"
                                                class="text-dark"
                                            >

                                                <i class="bi bi-envelope mr-1 text-primary"></i>

                                                {{ $customer->email }}

                                            </a>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ADDRESS --}}

                                    <td class="align-middle">

                                        @if($customer->address)

                                            <span
                                                title="{{ $customer->address }}"
                                            >
                                                {{ \Illuminate\Support\Str::limit($customer->address, 45) }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ACTIONS --}}

                                    <td class="align-middle text-center">

                                        <div class="btn-group">

                                            {{-- VIEW --}}

                                            <a
                                                href="{{ route('customers.show', $customer) }}"
                                                class="btn btn-sm btn-outline-info"
                                                title="View"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- EDIT --}}

                                            <a
                                                href="{{ route('customers.edit', $customer) }}"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Edit"
                                            >

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- DELETE --}}

                                            <form
                                                action="{{ route('customers.destroy', $customer) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this customer?');"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete"
                                                >

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}

                <div class="p-3 border-top">

                    <div class="d-flex flex-wrap justify-content-between align-items-center">

                        <small class="text-muted mb-2 mb-md-0">

                            Showing
                            <strong>{{ $customers->firstItem() }}</strong>
                            to
                            <strong>{{ $customers->lastItem() }}</strong>
                            of
                            <strong>{{ $customers->total() }}</strong>
                            customers

                        </small>


                        <div>

                            {{ $customers->links() }}

                        </div>

                    </div>

                </div>

            @else

                {{-- EMPTY STATE --}}

                <div class="text-center py-5 px-3">

                    <div
                        class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3"
                        style="width:90px;height:90px;"
                    >

                        <i
                            class="bi bi-people text-muted"
                            style="font-size:42px;"
                        ></i>

                    </div>


                    <h5 class="font-weight-bold">
                        No customers found
                    </h5>


                    @if(request('search'))

                        <p class="text-muted">
                            No customers match
                            "<strong>{{ request('search') }}</strong>".
                        </p>

                        <a
                            href="{{ route('customers.index') }}"
                            class="btn btn-outline-secondary"
                        >
                            Clear Search
                        </a>

                    @else

                        <p class="text-muted">
                            Start by adding your first customer.
                        </p>

                        <a
                            href="{{ route('customers.create') }}"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-person-plus mr-1"></i>

                            Add Customer

                        </a>

                    @endif

                </div>

            @endif

        </div>

    </div>

</div>


<style>

    .card {
        border-radius: 10px;
        overflow: hidden;
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

    .pagination {
        margin-bottom: 0;
    }

</style>

@endsection
