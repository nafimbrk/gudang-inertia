<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = Item::with('category', 'supplier', 'warehouse', 'unit')
            ->where('name', 'like', "%$search%")
            ->orWhereHas('category', function (Builder $query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('supplier', function (Builder $query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('warehouse', function (Builder $query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhere('stock', 'like', "%$search%")
            ->orWhereHas('unit', function (Builder $query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->paginate(3)
            ->withQueryString();

        return inertia('Item/Index', [
            'items' => $items,
            'filters' => [
                'search' => $search
            ]
        ]);
    }

    public function create()
    {
        $category = Category::select('id', 'name')->get();
        $supplier = Supplier::select('id', 'name')->get();
        $warehouse = Warehouse::select('id', 'name')->get();
        $unit = Unit::select('id', 'name')->get();

        return inertia('Item/Create', [
            'category' => $category,
            'supplier' => $supplier,
            'warehouse' => $warehouse,
            'unit' => $unit
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'warehouse_id' => 'required',
            'stock' => 'required',
            'unit_id' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong',
            'category_id.required' => 'kategori tidak boleh kosong',
            'supplier_id.required' => 'supplier tidak boleh kosong',
            'warehouse_id.required' => 'warehouse tidak boleh kosong',
            'stock.required' => 'stok tidak boleh kosong',
            'unit_id.required' => 'unit tidak boleh kosong'
        ]);

        $request['category_id'] = $request['category_id']['id'];
        $request['supplier_id'] = $request['supplier_id']['id'];
        $request['warehouse_id'] = $request['warehouse_id']['id'];
        $request['unit_id'] = $request['unit_id']['id'];

        Item::create($request->all());

        return redirect()->route('item.index')->with('success', 'data telah ditambahkan');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = Category::create([
            'name' => $request->name
        ]);

        // Kirim data kategori yang baru
        return back()->with([
            'success' => 'Kategori berhasil ditambahkan',
            'new_category' => $category // <-- ini masuk ke flash
        ]);
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $supplier = Supplier::create([
            'name' => $request->name

        ]);

        // Kirim data kategori yang baru
        return back()->with([
            'success' => 'Kategori berhasil ditambahkan',
            'new_supplier' => $supplier // <-- ini masuk ke flash
        ]);
    }

    public function storeWarehouse(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $warehouse = Warehouse::create([
            'name' => $request->name
        ]);

        // Kirim data kategori yang baru
        return back()->with([
            'success' => 'Kategori berhasil ditambahkan',
            'new_warehouse' => $warehouse // <-- ini masuk ke flash
        ]);
    }

    public function storeUnit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $unit = Unit::create([
            'name' => $request->name
        ]);

        // Kirim data kategori yang baru
        return back()->with([
            'success' => 'Kategori berhasil ditambahkan',
            'new_unit' => $unit // <-- ini masuk ke flash
        ]);
    }

    public function edit($id)
    {
        $category = Category::select('id', 'name')->get();
        $supplier = Supplier::select('id', 'name')->get();
        $warehouse = Warehouse::select('id', 'name')->get();
        $unit = Unit::select('id', 'name')->get();

        $item = Item::find($id);

        return inertia('Item/Edit', [
            'item' => $item,
            'category' => $category,
            'supplier' => $supplier,
            'warehouse' => $warehouse,
            'unit' => $unit
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'warehouse_id' => 'required',
            'stock' => 'required',
            'unit_id' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong',
            'category_id.required' => 'kategori tidak boleh kosong',
            'supplier_id.required' => 'supplier tidak boleh kosong',
            'warehouse_id.required' => 'warehouse tidak boleh kosong',
            'stock.required' => 'stok tidak boleh kosong',
            'unit_id.required' => 'unit tidak boleh kosong'
        ]);

        $request['category_id'] = $request['category_id']['id'];
        $request['supplier_id'] = $request['supplier_id']['id'];
        $request['warehouse_id'] = $request['warehouse_id']['id'];
        $request['unit_id'] = $request['unit_id']['id'];

        $item = Item::find($id);

        $item->update($request->all());

        return redirect()->route('item.index')->with('success', 'data telah diubah');
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        $item->delete();

        return redirect()->route('item.index')->with('success', 'data telah dihapus');
    }
}
