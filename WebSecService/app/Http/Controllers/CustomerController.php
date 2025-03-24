<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'available_credit' => auth()->user()->credit,
            'total_purchases' => auth()->user()->purchases()->count(),
            'total_spent' => auth()->user()->purchases()->sum('price'),
        ];

        return view('customer.dashboard', compact('stats'));
    }
} 