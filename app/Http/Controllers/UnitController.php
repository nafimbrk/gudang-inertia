<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $units = Unit::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%");
            })
            ->paginate(3)
            ->withQueryString();

        return inertia('Unit/Index', [
            'units' => $units,
            'filters' => [
                'search' => $search
            ]
        ]);
    }

    public function create()
    {
        return inertia('Unit/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong'
        ]);

        Unit::create($request->only('name'));

        return redirect()->route('unit.index')->with('success', 'data telah ditambahkan');
    }

    public function edit($id)
    {
        $unit = Unit::find($id);

        return inertia('Unit/Edit', [
            'unit' => $unit
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong'
        ]);

        $unit = Unit::find($id);

        $unit->update($request->all());

        return redirect()->route('unit.index')->with('success', 'data telah diubah');
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);

        $unit->delete();

        return redirect()->route('unit.index')->with('success', 'data telah dihapus');
    }
}
