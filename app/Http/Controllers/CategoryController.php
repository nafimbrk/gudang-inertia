<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%");
            })
            ->paginate(3)
            ->withQueryString();

        return inertia('Category/Index', [
            'categories' => $categories,
            'filters' => [
                'search' => $search
            ]
        ]);
    }

    public function create(Request $request)
    {
        return inertia('Category/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong'
        ]);

        Category::create($request->only('name'));

        return redirect()->route('category.index')->with('success', 'data telah ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return inertia('Category/Edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'nama tidak boleh kosong'
        ]);

        $category = Category::find($id);

        $category->update($request->all());

        return redirect()->route('category.index')->with('success', 'data telah diubah');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect()->route('category.index')->with('success', 'data telah dihapus');
    }
}
