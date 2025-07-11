<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategory = Category::all()->count();
        $totalSupplier = Supplier::all()->count();
        $totalWarehouse = Warehouse::all()->count();
        $totalItem = Item::all()->count();
        $totalUnit = Unit::all()->count();

        return inertia('Dashboard', [
            'totalCategory' => $totalCategory,
            'totalSupplier' => $totalSupplier,
            'totalWarehouse' => $totalWarehouse,
            'totalItem' => $totalItem,
            'totalUnit' => $totalUnit
        ]);
    }
}
