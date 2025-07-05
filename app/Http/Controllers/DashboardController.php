<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCategory = Category::all()->count();
        $totalSupplier = Supplier::all()->count();
        return inertia('Home', [
            'totalCategory' => $totalCategory,
            'totalSupplier' => $totalSupplier,
        ]);
    }
}
