<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Credit;
use DB;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function addCredit(Request $request, User $user)
    {
        // Only employees can add credit
        if (!auth()->user()->hasRole('Employee')) {
            abort(403, 'Only employees can add credit to customer accounts');
        }

        // Validate the request
        try {
            $validated = $request->validate([
                'amount' => 'required|numeric|min:0.01',
            ], [
                'amount.required' => 'Credit amount is required',
                'amount.numeric' => 'Credit amount must be a number',
                'amount.min' => 'Credit amount must be positive (greater than 0)',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }

        try {
            DB::beginTransaction();
            
            // Create credit record
            $credit = new Credit();
            $credit->user_id = $user->id;
            $credit->amount = $validated['amount'];
            $credit->save();

            // Update user's credit balance
            $user->increment('credit', $validated['amount']);
            
            DB::commit();

            return redirect()->back()->with('success', "Successfully added $".number_format($validated['amount'], 2)." credit to {$user->name}'s account.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to add credit: ' . $e->getMessage())->withInput();
        }
    }

    public function listCustomers()
    {
        // Only employees can view customer list
        if (!auth()->user()->hasRole('Employee')) {
            abort(403, 'Only employees can view customer list');
        }

        $customers = User::role('Customer')->get();

        return view('employees.customers', compact('customers'));
    }
} 