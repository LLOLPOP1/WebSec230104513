<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use DB;

class PurchasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        // Allow users to see their own purchases
        $purchases = auth()->user()->purchases()->with('product')->latest()->get();
        return view('purchases.index', compact('purchases'));
    }

    public function store(Request $request)
    {
        // Only customers can purchase products
        if (!auth()->user()->hasRole('Customer')) {
            abort(403, 'Only customers can purchase products');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        $user = auth()->user();

        try {
            DB::beginTransaction();

            // Check stock
            if ($product->stock < 1) {
                throw new \Exception("Product is out of stock.");
            }

            // Check credit
            if ($user->credit < $product->price) {
                return redirect()->route('insufficient_credit');
            }

            // Create purchase record
            Purchase::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);

            // Update stock and credit
            $product->decrement('stock');
            $user->decrement('credit', $product->price);

            DB::commit();

            return redirect()->route('purchases.index')
                ->with('success', "Purchased 1 x {$product->name} for $".number_format($product->price, 2));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}