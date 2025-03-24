<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_employees' => User::where('role', 'employee')->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_products' => Product::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
} 