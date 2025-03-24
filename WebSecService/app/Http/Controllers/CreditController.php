<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function addCredit(Request $request, User $user)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01'
        ]);

        $user->credit += $request->amount;
        $user->save();

        return back()->with('success', 'Credit added successfully.');
    }
} 