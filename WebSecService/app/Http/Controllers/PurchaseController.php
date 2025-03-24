<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function purchase(Request $request, Product $product)
    {
        if ($product->stock <= 0) {
            return back()->with('error', 'Product out of stock.');
        }

        if ($request->user()->credit < $product->price) {
            return back()->with('error', 'Insufficient credit.');
        }

        try {
            DB::transaction(function () use ($request, $product) {
                // Reduce stock
                $product->decrement('stock');
                
                // Deduct credit
                $request->user()->decrement('credit', $product->price);
                
                // Create purchase record
                $request->user()->purchases()->create([
                    'product_id' => $product->id,
                    'price' => $product->price
                ]);
            });

            return back()->with('success', 'Purchase successful!');
        } catch (\Exception $e) {
            return back()->with('error', 'Purchase failed. Please try again.');
        }
    }
} 