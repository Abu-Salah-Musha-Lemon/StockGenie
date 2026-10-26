<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $query = Warehouse::query();

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('status') && $request->status !== '') {

            $query->where(
                'status',
                (int) $request->status
            );
        }

        $warehouses = $query
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        $totalWarehouses = Warehouse::count();

        $activeWarehouses = Warehouse::where(
            'status',
            1
        )->count();

        $inactiveWarehouses = Warehouse::where(
            'status',
            0
        )->count();

        return view('warehouses.index', compact(
            'warehouses',
            'totalWarehouses',
            'activeWarehouses',
            'inactiveWarehouses'
        ));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:warehouses,name',
            ],

            'location' => [
                'nullable',
                'string',
                'max:500',
            ],

            'status' => [
                'required',
                'integer',
                Rule::in([0, 1]),
            ],
        ]);


        Warehouse::create([
            'name' => $validated['name'],
            'location' => $validated['location'] ?? null,
            'status' => (int) $validated['status'],
        ]);


        return redirect()
            ->route('warehouses.index')
            ->with(
                'success',
                'Warehouse added successfully.'
            );
    }


    public function update(
        Request $request,
        Warehouse $warehouse
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',

                Rule::unique(
                    'warehouses',
                    'name'
                )->ignore($warehouse->id),
            ],

            'location' => [
                'nullable',
                'string',
                'max:500',
            ],

            'status' => [
                'required',
                'integer',
                Rule::in([0, 1]),
            ],
        ]);


        $warehouse->update([
            'name' => $validated['name'],
            'location' => $validated['location'] ?? null,
            'status' => (int) $validated['status'],
        ]);


        return redirect()
            ->route('warehouses.index')
            ->with(
                'success',
                'Warehouse updated successfully.'
            );
    }


    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()
            ->route('warehouses.index')
            ->with(
                'success',
                'Warehouse deleted successfully.'
            );
    }
}
