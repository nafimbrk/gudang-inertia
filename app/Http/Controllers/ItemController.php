<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = Item::with('category', 'supplier', 'warehouse')
            ->where('name', 'like', "%$search%")
            ->orWhereHas('category', function (Builder $query) use($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('supplier', function (Builder $query) use($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhereHas('warehouse', function (Builder $query) use($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhere('stock', 'like', "%$search%")
            ->orWhere('unit', 'like', "%$search%")
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

        return inertia('Item/Create', [
            'category' => $category,
            'supplier' => $supplier,
            'warehouse' => $warehouse
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'warehouse_id' => 'required',
            'stock' => 'required',
            'unit' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong',
            'category_id.required' => 'kategori tidak boleh kosong',
            'supplier_id.required' => 'supplier tidak boleh kosong',
            'warehouse_id.required' => 'warehouse tidak boleh kosong',
            'stock.required' => 'stok tidak boleh kosong',
            'unit.required' => 'unit tidak boleh kosong'
        ]);

        Item::create($request->all());

        return redirect()->route('item.index')->with('success', 'data telah ditambahkan');
    }
}
