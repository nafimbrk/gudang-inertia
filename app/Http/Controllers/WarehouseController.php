<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $warehouses = Warehouse::where('name', 'like', "%$search%")
            ->orWhere('location', 'like', "%$search%")
            ->paginate(3)
            ->withQueryString();

        return inertia('Warehouse/Index', [
            'warehouses' => $warehouses,
            'filters' => [
                'search' => $search
            ]
        ]);
    }

    public function create()
    {
        return inertia('Warehouse/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong',
            'location.required' => 'lokasi tidak boleh kosong'
        ]);

        Warehouse::create($request->all());

        return redirect()->route('warehouse.index')->with('success', 'data telah ditambahkan');
    }

    public function edit($id)
    {
        $warehouse = Warehouse::find($id);

        return inertia('Warehouse/Edit', [
            'warehouse' => $warehouse
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong',
            'location.required' => 'lokasi tidak boleh kosong'
        ]);

        $warehouse = Warehouse::find($id);

        $warehouse->update($request->all());

        return redirect()->route('warehouse.index')->with('success', 'data telah diubah');
    }

    public function destroy($id)
    {
        $warehouse = Warehouse::find($id);

        $warehouse->delete();

        return redirect()->route('warehouse.index')->with('success', 'data telah dihapus');
    }
}
