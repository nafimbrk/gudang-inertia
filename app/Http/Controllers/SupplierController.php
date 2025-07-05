<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $suppliers = Supplier::where('name', 'like', "%$search%")
            ->orWhere('contact_info', 'like', "%$search%")
            ->paginate(3)
            ->withQueryString();

        return inertia('Supplier/Index', [
            'suppliers' => $suppliers,
            'filters' => [
                'search' => $search
            ]
        ]);
    }

    public function create()
    {
        return inertia('Supplier/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong'
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')->with('success', 'data telah ditambahkan');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);

        return inertia('Supplier/Edit', [
            'supplier' => $supplier
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong'
        ]);

        $supplier = Supplier::find($id);

        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'data telah diubah');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'data telah dihapus');
    }
}
