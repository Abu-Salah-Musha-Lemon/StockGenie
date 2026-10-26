@extends('layouts.layout')

@section('main')

<div class="container py-4">

    <div class="card shadow-sm border-0 invoice-card">

        <div class="card-body">

            <div class="text-center mb-4">

                <h2 class="font-weight-bold">
                    INVOICE
                </h2>

                <p class="mb-1">
                    Invoice:
                    <strong>
                        {{ $sale->invoice_no }}
                    </strong>
                </p>

                <p class="mb-1">
                    Warehouse:
                    <strong>
                        {{ optional(
                            DB::table('warehouses')
                                ->where('id', $sale->warehouse_id)
                                ->first()
                        )->name ?? '-' }}
                    </strong>
                </p>

                <p class="mb-1">
                    Customer:
                    <strong>
                        {{ optional(
                            DB::table('customers')
                                ->where('id', $sale->customer_id)
                                ->first()
                        )->name ?? 'Walk-in Customer' }}
                    </strong>
                </p>

                <p class="text-muted mb-0">

                    {{ \Carbon\Carbon::parse(
                        $sale->sale_date
                    )->format('d M Y, h:i A') }}

                </p>

            </div>


            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="thead-light">

                        <tr>

                            <th>
                                Product
                            </th>

                            <th class="text-center">
                                Qty
                            </th>

                            <th class="text-right">
                                Price
                            </th>

                            <th class="text-right">
                                Total
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @foreach($saleItems as $item)

                        <tr>

                            <td>

                                {{ $item->name }}

                                @if($item->sku)

                                    <br>

                                    <small class="text-muted">
                                        SKU: {{ $item->sku }}
                                    </small>

                                @endif

                            </td>


                            <td class="text-center">
                                {{ $item->qty }}
                            </td>


                            <td class="text-right">

                                {{ number_format(
                                    (float) $item->sale_price,
                                    2
                                ) }}
                                ৳

                            </td>


                            <td class="text-right">

                                {{ number_format(
                                    (float) $item->total,
                                    2
                                ) }}
                                ৳

                            </td>

                        </tr>

                    @endforeach

                    </tbody>


                    <tfoot>

                        <tr>

                            <th
                                colspan="3"
                                class="text-right"
                            >
                                Subtotal
                            </th>

                            <th class="text-right">

                                {{ number_format(
                                    (float) $sale->subtotal,
                                    2
                                ) }}
                                ৳

                            </th>

                        </tr>


                        <tr>

                            <th
                                colspan="3"
                                class="text-right"
                            >
                                Discount
                            </th>

                            <th class="text-right">

                                {{ number_format(
                                    (float) $sale->discount,
                                    2
                                ) }}
                                ৳

                            </th>

                        </tr>


                        <tr>

                            <th
                                colspan="3"
                                class="text-right"
                            >
                                Tax
                            </th>

                            <th class="text-right">

                                {{ number_format(
                                    (float) $sale->tax,
                                    2
                                ) }}
                                ৳

                            </th>

                        </tr>


                        <tr class="bg-success text-white">

                            <th
                                colspan="3"
                                class="text-right"
                            >
                                Grand Total
                            </th>

                            <th class="text-right">

                                {{ number_format(
                                    (float) $sale->grand_total,
                                    2
                                ) }}
                                ৳

                            </th>

                        </tr>


                        <tr>

                            <th
                                colspan="3"
                                class="text-right"
                            >
                                Paid
                            </th>

                            <th class="text-right">

                                {{ number_format(
                                    (float) $sale->pay,
                                    2
                                ) }}
                                ৳

                            </th>

                        </tr>


                        <tr>

                            <th
                                colspan="3"
                                class="text-right"
                            >
                                Due
                            </th>

                            <th class="text-right text-danger">

                                {{ number_format(
                                    (float) $sale->due,
                                    2
                                ) }}
                                ৳

                            </th>

                        </tr>


                        @if($change > 0)

                            <tr>

                                <th
                                    colspan="3"
                                    class="text-right"
                                >
                                    Change
                                </th>

                                <th class="text-right text-success">

                                    {{ number_format(
                                        (float) $change,
                                        2
                                    ) }}
                                    ৳

                                </th>

                            </tr>

                        @endif

                    </tfoot>

                </table>

            </div>


            <div class="text-center mt-4 no-print">

                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="window.print()"
                >

                    <i class="bi bi-printer"></i>

                    Print Invoice

                </button>


                <a
                    href="{{ route('pos.index') }}"
                    class="btn btn-secondary"
                >

                    New Sale

                </a>

            </div>

        </div>

    </div>

</div>


<style>

@media print {

    body * {
        visibility: hidden;
    }

    .invoice-card,
    .invoice-card * {
        visibility: visible;
    }

    .invoice-card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        border: none !important;
        box-shadow: none !important;
    }

    .no-print {
        display: none !important;
    }

}

</style>

@endsection
