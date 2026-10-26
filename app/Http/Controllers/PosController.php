<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Cart;

class PosController extends Controller
{
    /**
     * POS page
     */
    public function index()
    {
        $products = DB::table('products')
            ->leftJoin(
                'product_stocks',
                'products.id',
                '=',
                'product_stocks.product_id'
            )
            ->select(
                'products.id',
                'products.name',
                'products.sku',
                'products.barcode',
                'products.sale_price',
                'products.cost_price',
                'products.photo',
                'products.status',
                'products.is_deleted',
                DB::raw('COALESCE(product_stocks.qty, 0) as qty'),
                DB::raw('COALESCE(product_stocks.alert_qty, 0) as alert_qty')
            )
            ->where('products.status', 1)
            ->where('products.is_deleted', 0)
            ->orderBy('products.name')
            ->get();

        $customers = DB::table('customers')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        $warehouses = DB::table('warehouses')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view(
            'pos.pos',
            compact(
                'products',
                'customers',
                'warehouses'
            )
        );
    }


    /**
     * Add product to cart
     */
    public function addCart(Request $request)
    {
        $request->validate([
            'id' => [
                'required',
                'integer',
                'exists:products,id',
            ],

            'qty' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $product = DB::table('products')
            ->leftJoin(
                'product_stocks',
                'products.id',
                '=',
                'product_stocks.product_id'
            )
            ->select(
                'products.id',
                'products.name',
                'products.sku',
                'products.sale_price',
                'products.cost_price',
                'products.photo',
                DB::raw('COALESCE(product_stocks.qty, 0) as qty')
            )
            ->where('products.id', $request->id)
            ->where('products.status', 1)
            ->where('products.is_deleted', 0)
            ->first();

        if (!$product) {
            return back()->with(
                'error',
                'Product not found.'
            );
        }

        $stockQty = (int) $product->qty;

        if ($stockQty <= 0) {
            return back()->with(
                'error',
                "{$product->name} is out of stock."
            );
        }

        $existing = Cart::content()->first(
            function ($item) use ($product) {
                return (int) $item->id === (int) $product->id;
            }
        );

        $oldQty = $existing
            ? (int) $existing->qty
            : 0;

        $requestedQty = (int) $request->qty;

        $newQty = $oldQty + $requestedQty;

        if ($newQty > $stockQty) {
            return back()->with(
                'error',
                "Only {$stockQty} unit(s) of {$product->name} are available."
            );
        }

        if ($existing) {
            Cart::update(
                $existing->rowId,
                $newQty
            );
        } else {
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $requestedQty,
                'price' => (float) $product->sale_price,
                'weight' => 0,
                'options' => [
                    'sku' => $product->sku,
                    'cost_price' => (float) $product->cost_price,
                    'photo' => $product->photo,
                ],
            ]);
        }

        return back()->with(
            'success',
            "{$product->name} added to cart."
        );
    }


    /**
     * Update cart quantity
     */
    public function updateCart(Request $request, $rowId)
    {
        $request->validate([
            'qty' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        try {
            $item = Cart::get($rowId);

            if (!$item) {
                return back()->with(
                    'error',
                    'Cart item not found.'
                );
            }

            $stockQty = (int) DB::table('product_stocks')
                ->where('product_id', $item->id)
                ->value('qty');

            $requestedQty = (int) $request->qty;

            if ($requestedQty > $stockQty) {
                return back()->with(
                    'error',
                    "Only {$stockQty} item(s) available."
                );
            }

            Cart::update(
                $rowId,
                $requestedQty
            );

            return back()->with(
                'success',
                'Cart updated successfully.'
            );

        } catch (\Throwable $e) {

            Log::error(
                'POS UPDATE CART ERROR',
                [
                    'message' => $e->getMessage(),
                    'row_id' => $rowId,
                ]
            );

            return back()->with(
                'error',
                'Unable to update cart.'
            );
        }
    }


    /**
     * Delete cart item
     */
    public function deleteCart($rowId)
    {
        try {
            $item = Cart::get($rowId);

            if (!$item) {
                return back()->with(
                    'error',
                    'Cart item not found.'
                );
            }

            Cart::remove($rowId);

            return back()->with(
                'success',
                'Product removed from cart.'
            );

        } catch (\Throwable $e) {

            Log::error(
                'POS DELETE CART ERROR',
                [
                    'message' => $e->getMessage(),
                    'row_id' => $rowId,
                ]
            );

            return back()->with(
                'error',
                'Unable to remove product.'
            );
        }
    }


    /**
     * Clear cart
     */
    public function clearCart()
    {
        Cart::destroy();

        return back()->with(
            'success',
            'Cart cleared successfully.'
        );
    }


    /**
     * Checkout
     */
    public function finalInvoice(Request $request)
    {
        $request->validate([
            'warehouse_id' => [
                'required',
                'integer',
                'exists:warehouses,id',
            ],

            'customer_id' => [
                'nullable',
                'integer',
                'exists:customers,id',
            ],

            'payment_method' => [
                'required',
                'in:Cash,Bank',
            ],

            'pay' => [
                'required',
                'numeric',
                'min:0',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'tax' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        $cartItems = Cart::content();

        if ($cartItems->count() === 0) {
            return redirect()
                ->route('pos.index')
                ->with(
                    'error',
                    'Cart is empty.'
                );
        }

        $warehouseId = (int) $request->warehouse_id;
        $customerId = $request->customer_id
            ? (int) $request->customer_id
            : null;

        $discount = round(
            (float) ($request->discount ?? 0),
            2
        );

        $tax = round(
            (float) ($request->tax ?? 0),
            2
        );

        $pay = round(
            (float) $request->pay,
            2
        );

        /*
        |--------------------------------------------------------------------------
        | Calculate subtotal from database prices
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;

        foreach ($cartItems as $cartItem) {

            $product = DB::table('products')
                ->where('id', $cartItem->id)
                ->where('status', 1)
                ->where('is_deleted', 0)
                ->first();

            if (!$product) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        "Product {$cartItem->name} is no longer available."
                    );
            }

            $subtotal +=
                (float) $product->sale_price *
                (int) $cartItem->qty;
        }

        $subtotal = round($subtotal, 2);

        /*
        |--------------------------------------------------------------------------
        | Validate discount
        |--------------------------------------------------------------------------
        */

        if ($discount > $subtotal) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Discount cannot be greater than subtotal.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Grand total
        |--------------------------------------------------------------------------
        */

        $grandTotal = round(
            $subtotal -
            $discount +
            $tax,
            2
        );

        if ($grandTotal < 0) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Invalid invoice total.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Payment
        |--------------------------------------------------------------------------
        */

        $due = round(
            max(
                0,
                $grandTotal - $pay
            ),
            2
        );

        $change = round(
            max(
                0,
                $pay - $grandTotal
            ),
            2
        );

        /*
        |--------------------------------------------------------------------------
        | Customer / credit validation
        |--------------------------------------------------------------------------
        */

        if ($due > 0 && !$customerId) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Customer is required when there is an outstanding due.'
                );
        }

        if ($customerId) {

            $customer = DB::table('customers')
                ->where('id', $customerId)
                ->where('status', 1)
                ->first();

            if (!$customer) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Selected customer is not available.'
                    );
            }

            if (
                $due > 0 &&
                (float) $customer->credit_limit < $due
            ) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Customer credit limit is not sufficient for this due amount.'
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Payment status
        |--------------------------------------------------------------------------
        */

        $paymentStatus = 'success';

        if ($due > 0) {
            $paymentStatus = 'pending';
        }

        /*
        |--------------------------------------------------------------------------
        | Invoice number
        |--------------------------------------------------------------------------
        */

        $invoiceNo =
            'INV-' .
            now()->format('YmdHis') .
            '-' .
            strtoupper(Str::random(4));

        try {

            $sale = DB::transaction(
                function () use (
                    $request,
                    $cartItems,
                    $invoiceNo,
                    $warehouseId,
                    $customerId,
                    $subtotal,
                    $discount,
                    $tax,
                    $grandTotal,
                    $pay,
                    $due,
                    $paymentStatus
                ) {

                    /*
                    |--------------------------------------------------------------------------
                    | Create sale
                    |--------------------------------------------------------------------------
                    */

                    $saleId = DB::table('sales')
                        ->insertGetId([
                            'invoice_no' => $invoiceNo,

                            'customer_id' => $customerId,

                            'warehouse_id' => $warehouseId,

                            'subtotal' => $subtotal,

                            'discount' => $discount,

                            'tax' => $tax,

                            'grand_total' => $grandTotal,

                            'payment_status' => $paymentStatus,

                            'pay' => $pay,

                            'due' => $due,

                            'sale_date' => now(),

                            'created_by' => Auth::id(),

                            'created_at' => now(),

                            'updated_at' => now(),
                        ]);

                    if (!$saleId) {
                        throw new \Exception(
                            'Sales record could not be created.'
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Products
                    |--------------------------------------------------------------------------
                    */

                    foreach ($cartItems as $cartItem) {

                        /*
                        |--------------------------------------------------------------------------
                        | Lock stock
                        |--------------------------------------------------------------------------
                        */

                        $stock = DB::table('product_stocks')
                            ->where(
                                'product_id',
                                $cartItem->id
                            )
                            ->lockForUpdate()
                            ->first();

                        if (!$stock) {
                            throw new \Exception(
                                "Stock record not found for {$cartItem->name}."
                            );
                        }

                        $availableQty =
                            (int) $stock->qty;

                        $saleQty =
                            (int) $cartItem->qty;

                        if ($saleQty <= 0) {
                            throw new \Exception(
                                "Invalid quantity for {$cartItem->name}."
                            );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Stock validation
                        |--------------------------------------------------------------------------
                        */

                        if ($saleQty > $availableQty) {
                            throw new \Exception(
                                "Insufficient stock for {$cartItem->name}. " .
                                "Available: {$availableQty}, " .
                                "Requested: {$saleQty}."
                            );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Get current product price
                        |--------------------------------------------------------------------------
                        */

                        $product = DB::table('products')
                            ->where('id', $cartItem->id)
                            ->where('status', 1)
                            ->where('is_deleted', 0)
                            ->first();

                        if (!$product) {
                            throw new \Exception(
                                "Product not found: {$cartItem->name}."
                            );
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | Price
                        |--------------------------------------------------------------------------
                        */

                        $salePrice = round(
                            (float) $product->sale_price,
                            2
                        );

                        $costPrice = round(
                            (float) $product->cost_price,
                            2
                        );

                        $total = round(
                            $salePrice * $saleQty,
                            2
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | Insert sales item
                        |--------------------------------------------------------------------------
                        */

                        DB::table('sales_items')
                            ->insert([
                                'sale_id' => $saleId,

                                'product_id' => $product->id,

                                'qty' => $saleQty,

                                'sale_price' => $salePrice,

                                'cost_price' => $costPrice,

                                'total' => $total,

                                'discount' => 0,

                                'tax_amount' => 0,

                                'final_price' => $total,

                                'serial_number' => null,

                                'batch_number' => null,

                                'expiry_date' => null,

                                'warehouse_id' => $warehouseId,

                                'location_id' => null,

                                'created_by' => Auth::id(),

                                'updated_by' => Auth::id(),

                                'status' => 'active',

                                'remarks' => null,

                                'created_at' => now(),

                                'updated_at' => now(),
                            ]);

                        /*
                        |--------------------------------------------------------------------------
                        | Update current stock
                        |--------------------------------------------------------------------------
                        */

                        DB::table('product_stocks')
                            ->where(
                                'product_id',
                                $product->id
                            )
                            ->update([
                                'qty' =>
                                    $availableQty - $saleQty,

                                'updated_at' =>
                                    now(),
                            ]);

                        /*
                        |--------------------------------------------------------------------------
                        | Stock ledger
                        |--------------------------------------------------------------------------
                        */

                        DB::table('stock_ledgers')
                            ->insert([
                                'product_id' => $product->id,

                                'warehouse_id' => $warehouseId,

                                'type' => 'OUT',

                                'qty' => $saleQty,

                                'reference_type' => 'sale',

                                'reference_id' => $saleId,

                                'remarks' => 'POS Sale - ' . $invoiceNo,

                                'created_by' => Auth::id(),

                                'created_at' => now(),

                                'updated_at' => now(),
                            ]);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Payment
                    |--------------------------------------------------------------------------
                    */

                    if ($pay > 0) {

                        DB::table('payments')
                            ->insert([
                                'reference_type' => 'sale',

                                'reference_id' => $saleId,

                                'amount' => $pay > $grandTotal
                                    ? $grandTotal
                                    : $pay,

                                'method' => $request->payment_method,

                                'paid_at' => now(),

                                'received_by' => Auth::id(),

                                'created_at' => now(),

                                'updated_at' => now(),
                            ]);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Return sale
                    |--------------------------------------------------------------------------
                    */

                    return DB::table('sales')
                        ->where('id', $saleId)
                        ->first();
                }
            );

            /*
            |--------------------------------------------------------------------------
            | Clear cart
            |--------------------------------------------------------------------------
            */

            Cart::destroy();

            /*
            |--------------------------------------------------------------------------
            | Invoice items
            |--------------------------------------------------------------------------
            */

            $saleItems = DB::table('sales_items')
                ->join(
                    'products',
                    'sales_items.product_id',
                    '=',
                    'products.id'
                )
                ->select(
                    'products.name',
                    'products.sku',
                    'sales_items.*'
                )
                ->where(
                    'sales_items.sale_id',
                    $sale->id
                )
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Invoice
            |--------------------------------------------------------------------------
            */

            return view(
                'pos.invoice',
                compact(
                    'sale',
                    'saleItems',
                    'change'
                )
            );

        } catch (\Throwable $e) {

            Log::error(
                'POS CHECKOUT ERROR',
                [
                    'message' => $e->getMessage(),

                    'file' => $e->getFile(),

                    'line' => $e->getLine(),

                    'user_id' => Auth::id(),

                    'warehouse_id' => $warehouseId,

                    'customer_id' => $customerId,

                    'request' => $request->except([
                        '_token',
                    ]),

                    'cart' => $cartItems->toArray(),

                    'trace' => $e->getTraceAsString(),
                ]
            );

            return back()
                ->withInput()
                ->with(
                    'error',
                    'SALE FAILED: ' . $e->getMessage()
                );
        }
    }


    /**
     * Pending orders
     */
    public function pendingOrder()
    {
        $pending = DB::table('sales')
            ->leftJoin(
                'customers',
                'sales.customer_id',
                '=',
                'customers.id'
            )
            ->leftJoin(
                'warehouses',
                'sales.warehouse_id',
                '=',
                'warehouses.id'
            )
            ->select(
                'sales.*',
                'customers.name as customer_name',
                'warehouses.name as warehouse_name'
            )
            ->where(
                'sales.payment_status',
                'pending'
            )
            ->orderByDesc('sales.id')
            ->get();

        return view(
            'pos.all_pending_order',
            compact('pending')
        );
    }


    /**
     * View pending order
     */
    public function viewOrder($id)
    {
        $sale = DB::table('sales')
            ->leftJoin(
                'customers',
                'sales.customer_id',
                '=',
                'customers.id'
            )
            ->leftJoin(
                'warehouses',
                'sales.warehouse_id',
                '=',
                'warehouses.id'
            )
            ->select(
                'sales.*',
                'customers.name as customer_name',
                'warehouses.name as warehouse_name'
            )
            ->where(
                'sales.id',
                $id
            )
            ->first();

        if (!$sale) {
            return redirect()
                ->route('pos.orders.pending')
                ->with(
                    'error',
                    'Order not found.'
                );
        }

        $saleItems = DB::table('sales_items')
            ->join(
                'products',
                'sales_items.product_id',
                '=',
                'products.id'
            )
            ->select(
                'products.name',
                'products.sku',
                'sales_items.*'
            )
            ->where(
                'sales_items.sale_id',
                $id
            )
            ->get();

        return view(
            'pos.view_pending_order',
            compact(
                'sale',
                'saleItems'
            )
        );
    }


    /**
     * Mark pending order as paid
     */
    public function paidOrder(Request $request, $id)
    {
        $request->validate([
            'payment_method' => [
                'required',
                'in:Cash,Bank',
            ],
        ]);

        try {

            DB::transaction(function () use (
                $id,
                $request
            ) {

                $sale = DB::table('sales')
                    ->where('id', $id)
                    ->lockForUpdate()
                    ->first();

                if (!$sale) {
                    throw new \Exception(
                        'Order not found.'
                    );
                }

                if ($sale->payment_status === 'success') {
                    throw new \Exception(
                        'This order is already paid.'
                    );
                }

                $due = (float) $sale->due;

                /*
                |--------------------------------------------------------------------------
                | Payment
                |--------------------------------------------------------------------------
                */

                DB::table('payments')
                    ->insert([
                        'reference_type' => 'sale',

                        'reference_id' => $sale->id,

                        'amount' => $due,

                        'method' => $request->payment_method,

                        'paid_at' => now(),

                        'received_by' => Auth::id(),

                        'created_at' => now(),

                        'updated_at' => now(),
                    ]);

                /*
                |--------------------------------------------------------------------------
                | Update sale
                |--------------------------------------------------------------------------
                */

                DB::table('sales')
                    ->where('id', $sale->id)
                    ->update([
                        'payment_status' => 'success',

                        'pay' =>
                            (float) $sale->pay +
                            $due,

                        'due' => 0,

                        'updated_at' => now(),
                    ]);
            });

            return redirect()
                ->route('pos.orders.paid.index')
                ->with(
                    'success',
                    'Payment completed successfully.'
                );

        } catch (\Throwable $e) {

            Log::error(
                'POS PAY PENDING ERROR',
                [
                    'message' => $e->getMessage(),
                    'sale_id' => $id,
                    'user_id' => Auth::id(),
                ]
            );

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }


    /**
     * Paid orders
     */
    public function paidAllOrder()
    {
        $success = DB::table('sales')
            ->leftJoin(
                'customers',
                'sales.customer_id',
                '=',
                'customers.id'
            )
            ->leftJoin(
                'warehouses',
                'sales.warehouse_id',
                '=',
                'warehouses.id'
            )
            ->select(
                'sales.*',
                'customers.name as customer_name',
                'warehouses.name as warehouse_name'
            )
            ->where(
                'sales.payment_status',
                'success'
            )
            ->orderByDesc('sales.id')
            ->get();

        return view(
            'pos.all_paid_order',
            compact('success')
        );
    }
}
