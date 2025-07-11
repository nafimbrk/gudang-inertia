<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $transactions = Transaction::with('item', 'supplier', 'warehouse')
            ->whereHas('item', function (Builder $query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orWhere('quantity', 'like', "%$search%")
            ->orWhere('note', 'like', "%$search%")
            ->paginate(3)
            ->withQueryString();

        return inertia('Transaction/Index', [
            'transactions' => $transactions,
            'filters' => [
                'search' => $search
            ]
        ]);
    }

    public function create()
    {
        return inertia('Transaction/Create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required'
    //     ], [
    //         'name.required' => 'nama tidak boleh kosong'
    //     ]);

    //     Category::create($request->only('name'));

    //     return redirect()->route('category.index')->with('success', 'data telah ditambahkan');
    // }
}
