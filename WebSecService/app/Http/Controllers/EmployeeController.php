<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'low_stock_products' => Product::where('stock', '<', 10)->count(),
            'total_customers' => User::where('role', 'customer')->count(),
        ];

        return view('employee.dashboard', compact('stats'));
    }
} 