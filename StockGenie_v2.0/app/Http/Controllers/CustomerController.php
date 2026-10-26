<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display customer list.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        $customers = $query
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('customers.index', compact('customers'));
    }


    /**
     * Show create customer form.
     */
    public function create()
    {
        return view('customers.create');
    }


    /**
     * Store new customer.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
                'unique:customers,phone',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:customers,email',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ], [

            'name.required' => 'Customer name is required.',

            'phone.required' => 'Customer phone number is required.',

            'phone.unique' => 'This phone number is already registered.',

            'email.email' => 'Please enter a valid email address.',

            'email.unique' => 'This email address is already registered.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Create customer
        |--------------------------------------------------------------------------
        */

        Customer::create($validated);


        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Customer created successfully.'
            );
    }


    /**
     * Show customer details.
     */
    public function show(Customer $customer)
    {
        return view(
            'customers.show',
            compact('customer')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(Customer $customer)
    {
        return view(
            'customers.edit',
            compact('customer')
        );
    }


    /**
     * Update customer.
     */
    public function update(
        Request $request,
        Customer $customer
    ) {

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
                Rule::unique('customers', 'phone')
                    ->ignore($customer->id),
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('customers', 'email')
                    ->ignore($customer->id),
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ], [

            'name.required' => 'Customer name is required.',

            'phone.required' => 'Customer phone number is required.',

            'phone.unique' => 'This phone number is already registered.',

            'email.email' => 'Please enter a valid email address.',

            'email.unique' => 'This email address is already registered.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $customer->update($validated);


        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Customer updated successfully.'
            );
    }


    /**
     * Delete customer.
     */
    public function destroy(Customer $customer)
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent deleting customer with related sales
        |--------------------------------------------------------------------------
        |
        | If your sales table uses customer_id, this prevents accidentally
        | deleting a customer who has transaction history.
        |
        */

        if (
            method_exists($customer, 'sales') &&
            $customer->sales()->exists()
        ) {

            return redirect()
                ->route('customers.index')
                ->with(
                    'error',
                    'This customer cannot be deleted because they have sales history.'
                );
        }


        $customer->delete();


        return redirect()
            ->route('customers.index')
            ->with(
                'success',
                'Customer deleted successfully.'
            );
    }
}
