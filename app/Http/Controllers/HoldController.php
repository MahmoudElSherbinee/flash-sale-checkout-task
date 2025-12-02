<?php

namespace App\Http\Controllers;

use App\Models\Hold;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HoldController extends Controller
{
    public function index()
    {
        return view('hold');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        $product = Product::where('id', $validatedData['product_id'])
                            ->lockForUpdate()
                            ->first();

        $available = $product->stock - $product->reserved_count;
        if($available < $validatedData['quantity'])
        {
            return response()->json(['error' => 'Not enough Stock'], 400);
        }

        $hold = Hold::create([
            'product_id' => $product->id,
            'quantity' => $validatedData['quantity'],
            'status' => 'active',
            'expires_at' => now()->addMinutes(2)
        ]);

        $product->reserved_count += $validatedData['quantity'];
        $product->save();

        $cacheKey = "products:{$product->id}:available";
        Cache::forget($cacheKey);
        Cache::put($cacheKey, $product->stock - $product->reserved_count, 10);

        return response()->json([
            'hold_id' => $hold->id,
            'expires_at' => $hold->expires_at,
        ]);
    }
}
