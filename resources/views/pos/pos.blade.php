@extends('layouts.layout')

@section('main')

<div class="container-fluid py-4">

    {{-- =========================================================
        FLASH MESSAGES
    ========================================================== --}}

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill mr-2"></i>
                <div>
                    <strong>Success!</strong>
                    {{ session('success') }}
                </div>
            </div>

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif


    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                <div>
                    <strong>Error!</strong>
                    {{ session('error') }}
                </div>
            </div>

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif


    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill mr-2"></i>
                <div>
                    {{ session('info') }}
                </div>
            </div>

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif


    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">

            <div class="d-flex align-items-start">

                <i class="bi bi-exclamation-octagon-fill mr-2 mt-1"></i>

                <div>
                    <strong>Please fix the following:</strong>

                    <ul class="mb-0 mt-2 pl-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>

        </div>
    @endif


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h3 class="font-weight-bold mb-1">
                <i class="bi bi-shop text-primary mr-2"></i>
                Point of Sale
            </h3>

            <p class="text-muted mb-0">
                Select products, manage your cart and complete the sale.
            </p>
        </div>

        <div class="mt-2 mt-md-0">

            <span class="badge badge-light border px-3 py-2">
                <i class="bi bi-cart3 text-primary mr-1"></i>

                <span id="headerCartCount">
                    {{ Cart::count() }}
                </span>

                item(s)
            </span>

        </div>

    </div>


    <div class="row">

        {{-- =====================================================
            CART
        ====================================================== --}}

        <div class="col-xl-5 col-lg-5 mb-4">

            <div class="card border-0 shadow-sm h-100">

                {{-- CART HEADER --}}

                <div class="card-header bg-primary text-white border-0 py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h5 class="mb-1 font-weight-bold">
                                <i class="bi bi-cart3 mr-1"></i>
                                Current Sale
                            </h5>

                            <small class="text-white-50">
                                {{ Cart::count() }} item(s) in cart
                            </small>

                        </div>


                        @if(Cart::count() > 0)

                            <form
                                action="{{ route('pos.cart.clear') }}"
                                method="POST"
                                onsubmit="return confirm('Clear the entire cart?');"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-light text-danger shadow-sm"
                                >
                                    <i class="bi bi-trash3 mr-1"></i>
                                    Clear
                                </button>

                            </form>

                        @endif

                    </div>

                </div>


                {{-- CART BODY --}}

                <div class="card-body p-0">

                    @if(Cart::count() === 0)

                        <div class="text-center px-4 py-5">

                            <div
                                class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3"
                                style="width:90px;height:90px;"
                            >
                                <i
                                    class="bi bi-cart-x text-muted"
                                    style="font-size:42px;"
                                ></i>
                            </div>

                            <h5 class="font-weight-bold text-dark">
                                Your cart is empty
                            </h5>

                            <p class="text-muted mb-0">
                                Select a product from the list to start a sale.
                            </p>

                        </div>

                    @else

                        {{-- CART ITEMS --}}

                        <div class="table-responsive">

                            <table class="table table-hover mb-0 pos-cart-table">

                                <thead class="bg-light">

                                    <tr>
                                        <th class="border-top-0">
                                            Product
                                        </th>

                                        <th class="border-top-0 text-right">
                                            Price
                                        </th>

                                        <th class="border-top-0 text-center">
                                            Qty
                                        </th>

                                        <th class="border-top-0 text-right">
                                            Total
                                        </th>

                                        <th class="border-top-0 text-center">
                                        </th>
                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach(Cart::content() as $item)

                                        <tr>

                                            {{-- PRODUCT --}}

                                            <td class="align-middle">

                                                <div class="font-weight-bold text-dark">
                                                    {{ $item->name }}
                                                </div>

                                                @if($item->options->sku ?? null)

                                                    <small class="text-muted">
                                                        <i class="bi bi-upc-scan mr-1"></i>
                                                        {{ $item->options->sku }}
                                                    </small>

                                                @endif

                                            </td>


                                            {{-- PRICE --}}

                                            <td class="align-middle text-right text-nowrap">

                                                <span class="font-weight-bold">
                                                    {{ number_format((float) $item->price, 2) }}
                                                </span>

                                                <small>৳</small>

                                            </td>


                                            {{-- QUANTITY --}}

                                            <td class="align-middle">

                                                <form
                                                    action="{{ route('pos.cart.update', $item->rowId) }}"
                                                    method="POST"
                                                >

                                                    @csrf

                                                    <div class="input-group input-group-sm">

                                                        <input
                                                            type="number"
                                                            name="qty"
                                                            min="1"
                                                            value="{{ $item->qty }}"
                                                            class="form-control text-center"
                                                            required
                                                        >

                                                        <div class="input-group-append">

                                                            <button
                                                                type="submit"
                                                                class="btn btn-success"
                                                                title="Update quantity"
                                                            >
                                                                <i class="bi bi-check-lg"></i>
                                                            </button>

                                                        </div>

                                                    </div>

                                                </form>

                                            </td>


                                            {{-- TOTAL --}}

                                            <td class="align-middle text-right text-nowrap">

                                                <strong>
                                                    {{ number_format(
                                                        (float) $item->price * (int) $item->qty,
                                                        2
                                                    ) }}
                                                </strong>

                                                <small>৳</small>

                                            </td>


                                            {{-- DELETE --}}

                                            <td class="align-middle text-center">

                                                <form
                                                    action="{{ route('pos.cart.delete', $item->rowId) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Remove this product from the cart?');"
                                                >

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-outline-danger border-0"
                                                        title="Remove product"
                                                    >
                                                        <i class="bi bi-trash3"></i>
                                                    </button>

                                                </form>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                        {{-- CART SUMMARY --}}

                        <div class="p-3 bg-light border-top">

                            <div class="d-flex justify-content-between py-2">

                                <span class="text-muted">
                                    Subtotal
                                </span>

                                <strong id="cartSubtotal">
                                    {{ number_format(
                                        (float) Cart::subtotal(2, '.', ''),
                                        2
                                    ) }}
                                    ৳
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">

                                <div>
                                    <span class="text-muted d-block small">
                                        Total payable
                                    </span>

                                    <h4 class="mb-0 font-weight-bold text-primary">
                                        {{ number_format(
                                            (float) Cart::subtotal(2, '.', ''),
                                            2
                                        ) }}
                                        ৳
                                    </h4>
                                </div>


                                <button
                                    type="button"
                                    class="btn btn-primary btn-lg px-4 shadow-sm"
                                    data-toggle="modal"
                                    data-target="#checkoutModal"
                                >
                                    <i class="bi bi-credit-card mr-1"></i>
                                    Checkout
                                </button>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
            PRODUCTS
        ====================================================== --}}

        <div class="col-xl-7 col-lg-7 mb-4">

            <div class="card border-0 shadow-sm h-100">

                {{-- PRODUCT HEADER --}}

                <div class="card-header bg-white border-0 py-3">

                    <div class="d-flex flex-wrap justify-content-between align-items-center">

                        <div>

                            <h5 class="mb-1 font-weight-bold">

                                <i class="bi bi-box-seam text-primary mr-1"></i>

                                Products

                            </h5>

                            <small class="text-muted">
                                Select a product to add it to the cart.
                            </small>

                        </div>


                        @if(Auth::check() && Auth::user()->role == 0)

                            <div class="mt-2 mt-md-0">

                                @include('admin.products.add_product_modal')

                                <button
                                    type="button"
                                    class="btn btn-primary shadow-sm"
                                    data-toggle="modal"
                                    data-target="#addProductsModal"
                                >
                                    <i class="bi bi-plus-lg mr-1"></i>
                                    Add Product
                                </button>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- PRODUCT BODY --}}

                <div class="card-body pt-0">

                    <div class="table-responsive">

                        <table
                            id="productTable"
                            class="table table-striped table-bordered table-hover align-middle"
                            width="100%"
                        >

                            <thead class="thead-dark">

                                <tr>

                                    <th width="65">
                                        Action
                                    </th>

                                    <th width="70">
                                        Image
                                    </th>

                                    <th>
                                        Product
                                    </th>

                                    <th width="80">
                                        Stock
                                    </th>

                                    <th>
                                        SKU
                                    </th>

                                    <th>
                                        Barcode
                                    </th>

                                    <th width="110">
                                        Price
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($products as $product)

                                    <tr>

                                        {{-- ACTION --}}

                                        <td class="text-center align-middle">

                                            @if((int) $product->qty > 0)

                                                <form
                                                    action="{{ route('pos.cart.add') }}"
                                                    method="POST"
                                                >

                                                    @csrf

                                                    <input
                                                        type="hidden"
                                                        name="id"
                                                        value="{{ $product->id }}"
                                                    >

                                                    <input
                                                        type="hidden"
                                                        name="qty"
                                                        value="1"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="btn btn-sm btn-primary rounded-circle"
                                                        style="width:36px;height:36px;"
                                                        title="Add to cart"
                                                    >
                                                        <i class="bi bi-cart-plus"></i>
                                                    </button>

                                                </form>

                                            @else

                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-secondary rounded-circle"
                                                    style="width:36px;height:36px;"
                                                    disabled
                                                    title="Out of stock"
                                                >
                                                    <i class="bi bi-x-lg"></i>
                                                </button>

                                            @endif

                                        </td>


                                        {{-- IMAGE --}}

                                        <td class="text-center align-middle">

                                            @if($product->photo)

                                                <img
                                                    src="{{ asset($product->photo) }}"
                                                    alt="{{ $product->name }}"
                                                    class="rounded border shadow-sm"
                                                    style="
                                                        width:48px;
                                                        height:48px;
                                                        object-fit:cover;
                                                    "
                                                >

                                            @else

                                                <div
                                                    class="bg-light border rounded d-inline-flex align-items-center justify-content-center"
                                                    style="
                                                        width:48px;
                                                        height:48px;
                                                    "
                                                >
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>

                                            @endif

                                        </td>


                                        {{-- NAME --}}

                                        <td class="align-middle">

                                            <strong class="text-dark">
                                                {{ $product->name }}
                                            </strong>

                                        </td>


                                        {{-- STOCK --}}

                                        <td class="text-center align-middle">

                                            @if((int) $product->qty <= 0)

                                                <span class="badge badge-danger px-2 py-1">
                                                    Out of stock
                                                </span>

                                            @elseif(
                                                $product->alert_qty !== null &&
                                                (int) $product->qty <= (int) $product->alert_qty
                                            )

                                                <span class="badge badge-warning px-2 py-1">
                                                    {{ $product->qty }}
                                                </span>

                                            @else

                                                <span class="badge badge-success px-2 py-1">
                                                    {{ $product->qty }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- SKU --}}

                                        <td class="align-middle">
                                            {{ $product->sku ?: '-' }}
                                        </td>


                                        {{-- BARCODE --}}

                                        <td class="align-middle">
                                            {{ $product->barcode ?: '-' }}
                                        </td>


                                        {{-- PRICE --}}

                                        <td class="align-middle text-right text-nowrap">

                                            <strong class="text-primary">
                                                {{ number_format(
                                                    (float) $product->sale_price,
                                                    2
                                                ) }}
                                            </strong>

                                            <small>৳</small>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
    CHECKOUT MODAL
============================================================== --}}

@if(Cart::count() > 0)

    <div
        class="modal fade"
        id="checkoutModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="checkoutModalLabel"
        aria-hidden="true"
    >

        <div
            class="modal-dialog modal-lg modal-dialog-centered"
            role="document"
        >

            <div class="modal-content border-0 shadow-lg">

                <form
                    action="{{ route('pos.checkout') }}"
                    method="POST"
                    id="checkoutForm"
                >

                    @csrf


                    {{-- MODAL HEADER --}}

                    <div class="modal-header bg-primary text-white">

                        <div>

                            <h5
                                class="modal-title font-weight-bold"
                                id="checkoutModalLabel"
                            >
                                <i class="bi bi-receipt mr-1"></i>
                                Complete Sale
                            </h5>

                            <small class="text-white-50">
                                Review the payment details before completing the sale.
                            </small>

                        </div>


                        <button
                            type="button"
                            class="close text-white"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>


                    {{-- MODAL BODY --}}

                    <div class="modal-body p-4">

                        {{-- CUSTOMER / WAREHOUSE --}}

                        <div class="row">

                            {{-- WAREHOUSE --}}

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label
                                        for="warehouse_id"
                                        class="font-weight-bold"
                                    >
                                        <i class="bi bi-building mr-1 text-primary"></i>
                                        Warehouse
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select
                                        name="warehouse_id"
                                        id="warehouse_id"
                                        class="form-control"
                                        required
                                    >

                                        <option value="">
                                            Select Warehouse
                                        </option>

                                        @foreach($warehouses as $warehouse)

                                            <option
                                                value="{{ $warehouse->id }}"
                                                {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                            >
                                                {{ $warehouse->name }}

                                                @if($warehouse->location)
                                                    - {{ $warehouse->location }}
                                                @endif

                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>


                            {{-- CUSTOMER --}}

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label
                                        for="customer_id"
                                        class="font-weight-bold"
                                    >
                                        <i class="bi bi-person mr-1 text-primary"></i>
                                        Customer
                                    </label>

                                    <select
                                        name="customer_id"
                                        id="customer_id"
                                        class="form-control"
                                    >

                                        <option value="">
                                            Walk-in Customer
                                        </option>

                                        @foreach($customers as $customer)

                                            <option
                                                value="{{ $customer->id }}"
                                                {{ old('customer_id') == $customer->id ? 'selected' : '' }}
                                            >

                                                {{ $customer->name }}

                                                @if($customer->phone)
                                                    - {{ $customer->phone }}
                                                @endif

                                            </option>

                                        @endforeach

                                    </select>

                                    <small class="form-text text-muted">
                                        A customer is required when the payment leaves a due amount.
                                    </small>

                                </div>

                            </div>

                        </div>


                        {{-- SUMMARY --}}

                        <div class="checkout-summary rounded p-3 mb-4">

                            <div class="d-flex justify-content-between mb-2">

                                <span>
                                    Subtotal
                                </span>

                                <strong id="checkoutSubtotal">
                                    0.00 ৳
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between mb-2">

                                <span>
                                    Discount
                                </span>

                                <strong
                                    id="checkoutDiscount"
                                    class="text-danger"
                                >
                                    0.00 ৳
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between mb-3">

                                <span>
                                    Tax
                                </span>

                                <strong
                                    id="checkoutTax"
                                    class="text-info"
                                >
                                    0.00 ৳
                                </strong>

                            </div>


                            <hr>


                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <small class="text-muted d-block">
                                        Grand Total
                                    </small>

                                    <strong class="h4 mb-0">
                                        Total
                                    </strong>

                                </div>


                                <strong
                                    id="checkoutTotal"
                                    class="display-5 text-primary mb-0"
                                >
                                    0.00 ৳
                                </strong>

                            </div>

                        </div>


                        {{-- PAYMENT INFORMATION --}}

                        <div class="row">

                            {{-- PAYMENT METHOD --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="payment_method"
                                    class="font-weight-bold"
                                >
                                    Payment Method
                                </label>

                                <select
                                    name="payment_method"
                                    id="payment_method"
                                    class="form-control"
                                    required
                                >

                                    <option value="Cash">
                                        Cash
                                    </option>

                                    <option value="Bank">
                                        Bank
                                    </option>

                                </select>

                            </div>


                            {{-- DISCOUNT --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="discount"
                                    class="font-weight-bold"
                                >
                                    Discount
                                </label>

                                <div class="input-group">

                                    <input
                                        type="number"
                                        name="discount"
                                        id="discount"
                                        class="form-control"
                                        min="0"
                                        max="{{ (float) Cart::subtotal(2, '.', '') }}"
                                        step="0.01"
                                        value="{{ old('discount', 0) }}"
                                    >

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            ৳
                                        </span>
                                    </div>

                                </div>

                            </div>


                            {{-- TAX --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="tax"
                                    class="font-weight-bold"
                                >
                                    Tax
                                </label>

                                <div class="input-group">

                                    <input
                                        type="number"
                                        name="tax"
                                        id="tax"
                                        class="form-control"
                                        min="0"
                                        step="0.01"
                                        value="{{ old('tax', 0) }}"
                                    >

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            ৳
                                        </span>
                                    </div>

                                </div>

                            </div>


                            {{-- PAY --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="pay"
                                    class="font-weight-bold"
                                >
                                    Amount Received
                                </label>

                                <div class="input-group">

                                    <input
                                        type="number"
                                        name="pay"
                                        id="pay"
                                        class="form-control form-control-lg"
                                        min="0"
                                        step="0.01"
                                        value="{{ old('pay', 0) }}"
                                        required
                                    >

                                    <div class="input-group-append">

                                        <span class="input-group-text">
                                            ৳
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- DUE --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="due"
                                    class="font-weight-bold"
                                >
                                    Due
                                </label>

                                <div class="input-group">

                                    <input
                                        type="text"
                                        id="due"
                                        class="form-control bg-light font-weight-bold"
                                        value="0.00"
                                        readonly
                                    >

                                    <div class="input-group-append">

                                        <span class="input-group-text bg-light">
                                            ৳
                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- CHANGE --}}

                            <div class="col-md-6 mb-3">

                                <label
                                    for="change"
                                    class="font-weight-bold"
                                >
                                    Change
                                </label>

                                <div class="input-group">

                                    <input
                                        type="text"
                                        id="change"
                                        class="form-control bg-light text-success font-weight-bold"
                                        value="0.00"
                                        readonly
                                    >

                                    <div class="input-group-append">

                                        <span class="input-group-text bg-light text-success">
                                            ৳
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- PAYMENT STATUS --}}

                        <div
                            id="paymentStatus"
                            class="alert alert-info d-flex align-items-center mb-0"
                        >

                            <i
                                id="paymentStatusIcon"
                                class="bi bi-info-circle-fill mr-2"
                            ></i>

                            <span id="paymentStatusText">
                                Enter the received amount.
                            </span>

                        </div>


                        {{-- CUSTOMER WARNING --}}

                        <div
                            id="paymentWarning"
                            class="alert alert-warning d-none mt-3 mb-0"
                        >

                            <i class="bi bi-exclamation-triangle-fill mr-1"></i>

                            Customer is required for a due payment.

                        </div>

                    </div>


                    {{-- MODAL FOOTER --}}

                    <div class="modal-footer bg-light">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            <i class="bi bi-x-lg mr-1"></i>
                            Cancel
                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                            id="completeSaleButton"
                        >
                            <i class="bi bi-check-circle mr-1"></i>
                            Complete Sale
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endif

@endsection


@section('script')

<style>

    .pos-cart-table th {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .3px;
        white-space: nowrap;
    }

    .pos-cart-table td {
        vertical-align: middle;
    }

    #productTable th {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .3px;
        white-space: nowrap;
    }

    #productTable td {
        vertical-align: middle;
    }

    .checkout-summary {
        background: linear-gradient(
            135deg,
            #f4f8ff 0%,
            #ffffff 100%
        );
        border: 1px solid #dce7ff;
    }

    .display-5 {
        font-size: 1.75rem;
        font-weight: 700;
    }

    .modal-content {
        border-radius: 12px;
        overflow: hidden;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.05);
    }

    .table td,
    .table th {
        padding: .65rem;
    }

    @media (max-width: 767px) {

        .checkout-summary {
            padding: 15px !important;
        }

        .display-5 {
            font-size: 1.4rem;
        }

        .modal-body {
            padding: 1rem !important;
        }

    }

</style>


<script>

$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | PRODUCT DATATABLE
    |--------------------------------------------------------------------------
    */

    if ($('#productTable').length) {

        $('#productTable').DataTable({

            responsive: true,

            pageLength: 25,

            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],

            order: [
                [2, 'asc']
            ],

            columnDefs: [

                {
                    orderable: false,
                    searchable: false,
                    targets: [0, 1]
                }

            ],

            language: {

                search: "",

                searchPlaceholder: "Search products...",

                emptyTable: "No products available.",

                zeroRecords: "No matching products found."

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    const checkoutForm = document.getElementById('checkoutForm');

    if (!checkoutForm) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | CART SUBTOTAL
    |--------------------------------------------------------------------------
    |
    | json safely converts the PHP value to valid JavaScript.
    |
    */

    const subtotal = Number(
        @json((float) Cart::subtotal(2, '.', ''))
    ) || 0;


    /*
    |--------------------------------------------------------------------------
    | ELEMENTS
    |--------------------------------------------------------------------------
    */

    const discountInput =
        document.getElementById('discount');

    const taxInput =
        document.getElementById('tax');

    const payInput =
        document.getElementById('pay');

    const customerInput =
        document.getElementById('customer_id');

    const totalDisplay =
        document.getElementById('checkoutTotal');

    const subtotalDisplay =
        document.getElementById('checkoutSubtotal');

    const discountDisplay =
        document.getElementById('checkoutDiscount');

    const taxDisplay =
        document.getElementById('checkoutTax');

    const dueInput =
        document.getElementById('due');

    const changeInput =
        document.getElementById('change');

    const warning =
        document.getElementById('paymentWarning');

    const submitButton =
        document.getElementById('completeSaleButton');

    const paymentStatus =
        document.getElementById('paymentStatus');

    const paymentStatusIcon =
        document.getElementById('paymentStatusIcon');

    const paymentStatusText =
        document.getElementById('paymentStatusText');


    /*
    |--------------------------------------------------------------------------
    | MONEY FORMATTER
    |--------------------------------------------------------------------------
    */

    function money(value) {

        value = Number(value) || 0;

        return value.toFixed(2) + ' ৳';

    }


    /*
    |--------------------------------------------------------------------------
    | ROUND MONEY
    |--------------------------------------------------------------------------
    */

    function roundMoney(value) {

        return Math.round(
            (Number(value) + Number.EPSILON) * 100
        ) / 100;

    }


    /*
    |--------------------------------------------------------------------------
    | POSITIVE NUMBER
    |--------------------------------------------------------------------------
    */

    function positiveNumber(value) {

        const number = parseFloat(value);

        if (isNaN(number) || number < 0) {
            return 0;
        }

        return number;

    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PAYMENT STATUS UI
    |--------------------------------------------------------------------------
    */

    function updatePaymentStatus(
        type,
        icon,
        message
    ) {

        paymentStatus.className =
            'alert d-flex align-items-center mb-0 ' + type;

        paymentStatusIcon.className =
            'mr-2 ' + icon;

        paymentStatusText.innerText =
            message;

    }


    /*
    |--------------------------------------------------------------------------
    | CALCULATE PAYMENT
    |--------------------------------------------------------------------------
    */

    function calculatePayment() {

        let discount =
            positiveNumber(discountInput.value);

        let tax =
            positiveNumber(taxInput.value);

        let pay =
            positiveNumber(payInput.value);


        /*
        |--------------------------------------------------------------------------
        | Discount cannot exceed subtotal
        |--------------------------------------------------------------------------
        */

        if (discount > subtotal) {

            discount = subtotal;

            discountInput.value =
                subtotal.toFixed(2);

        }


        /*
        |--------------------------------------------------------------------------
        | Calculate grand total
        |--------------------------------------------------------------------------
        */

        let grandTotal =
            subtotal -
            discount +
            tax;


        grandTotal =
            Math.max(
                0,
                roundMoney(grandTotal)
            );


        /*
        |--------------------------------------------------------------------------
        | Calculate due/change
        |--------------------------------------------------------------------------
        */

        let difference =
            roundMoney(pay - grandTotal);


        let due = 0;
        let change = 0;


        if (difference < 0) {

            due =
                Math.abs(difference);

        } else {

            change =
                difference;

        }


        /*
        |--------------------------------------------------------------------------
        | Update summary
        |--------------------------------------------------------------------------
        */

        subtotalDisplay.innerText =
            money(subtotal);

        discountDisplay.innerText =
            money(discount);

        taxDisplay.innerText =
            money(tax);

        totalDisplay.innerText =
            money(grandTotal);

        dueInput.value =
            due.toFixed(2);

        changeInput.value =
            change.toFixed(2);


        /*
        |--------------------------------------------------------------------------
        | Customer required for due
        |--------------------------------------------------------------------------
        */

        const customerSelected =
            customerInput.value !== '';


        if (due > 0) {

            if (!customerSelected) {

                warning.classList.remove('d-none');

                submitButton.disabled = true;

                updatePaymentStatus(
                    'alert-warning',
                    'bi bi-exclamation-triangle-fill',
                    'A customer must be selected because this sale has an outstanding due.'
                );

            } else {

                warning.classList.add('d-none');

                submitButton.disabled = false;

                updatePaymentStatus(
                    'alert-warning',
                    'bi bi-clock-history',
                    'This sale will create a due amount of ' +
                    money(due) +
                    '.'
                );

            }

        } else if (change > 0) {

            warning.classList.add('d-none');

            submitButton.disabled = false;

            updatePaymentStatus(
                'alert-success',
                'bi bi-check-circle-fill',
                'Payment is complete. Change to return: ' +
                money(change) +
                '.'
            );

        } else if (grandTotal === 0) {

            warning.classList.add('d-none');

            submitButton.disabled = false;

            updatePaymentStatus(
                'alert-success',
                'bi bi-check-circle-fill',
                'The total amount is 0.00 ৳.'
            );

        } else {

            warning.classList.add('d-none');

            submitButton.disabled = false;

            updatePaymentStatus(
                'alert-info',
                'bi bi-info-circle-fill',
                'Payment exactly matches the grand total.'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | INPUT EVENTS
    |--------------------------------------------------------------------------
    */

    discountInput.addEventListener(
        'input',
        calculatePayment
    );


    taxInput.addEventListener(
        'input',
        calculatePayment
    );


    payInput.addEventListener(
        'input',
        calculatePayment
    );


    customerInput.addEventListener(
        'change',
        calculatePayment
    );


    /*
    |--------------------------------------------------------------------------
    | PREVENT NEGATIVE INPUTS
    |--------------------------------------------------------------------------
    */

    [
        discountInput,
        taxInput,
        payInput
    ].forEach(function (input) {

        input.addEventListener(
            'input',
            function () {

                if (
                    this.value !== '' &&
                    parseFloat(this.value) < 0
                ) {

                    this.value = 0;

                }

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | INITIAL CALCULATION
    |--------------------------------------------------------------------------
    */

    calculatePayment();


    /*
    |--------------------------------------------------------------------------
    | RESET PAYMENT BUTTON WHEN MODAL OPENS
    |--------------------------------------------------------------------------
    */

    $('#checkoutModal').on(
        'shown.bs.modal',
        function () {

            calculatePayment();

            setTimeout(function () {

                if (payInput) {
                    payInput.focus();
                }

            }, 300);

        }
    );


    /*
    |--------------------------------------------------------------------------
    | PREVENT DOUBLE SUBMISSION
    |--------------------------------------------------------------------------
    */

    checkoutForm.addEventListener(
        'submit',
        function (event) {

            /*
            |--------------------------------------------------------------------------
            | Recalculate before submission
            |--------------------------------------------------------------------------
            */

            calculatePayment();


            /*
            |--------------------------------------------------------------------------
            | Do not submit if customer is missing for due
            |--------------------------------------------------------------------------
            */

            const due =
                positiveNumber(dueInput.value);

            const customerSelected =
                customerInput.value !== '';


            if (due > 0 && !customerSelected) {

                event.preventDefault();

                warning.classList.remove(
                    'd-none'
                );

                customerInput.focus();

                return false;

            }


            /*
            |--------------------------------------------------------------------------
            | Prevent duplicate click
            |--------------------------------------------------------------------------
            */

            if (submitButton.disabled) {

                event.preventDefault();

                return false;

            }


            submitButton.disabled = true;

            submitButton.innerHTML =
                '<span class="spinner-border spinner-border-sm mr-1"></span>' +
                ' Processing...';

        }
    );


    /*
    |--------------------------------------------------------------------------
    | OPEN CHECKOUT MODAL AFTER VALIDATION ERROR
    |--------------------------------------------------------------------------
    */

    @if($errors->any())

        $('#checkoutModal').modal('show');

    @endif

});

</script>

@endsection
