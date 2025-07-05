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
}
