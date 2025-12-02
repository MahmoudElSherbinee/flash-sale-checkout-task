<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Hold;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('order');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'hold_id' => 'required|exists:holds,id'
        ]);

        $hold = Hold::where('id', $validatedData['hold_id'])
                        ->where('status', 'active')
                        ->where('expires_at', '>', now())
                        ->first();
        if(!$hold)
        {
            return response()->json(['error' => 'Hold not vaild'], 400);
        }

        $order = Order::create([
            'hold_id' => $hold->id,
            'status' => 'pending',
            'total' => $hold->quantity * $hold->product->price,
        ]);
        $hold->status = 'used';
        $hold->save();

        $product = $hold->product;
        $cacheKey = "products:{$product->id}:available";
        Cache::forget($cacheKey);
        Cache::put($cacheKey, $product->stock - $product->reserved_count, 10);


        return response()->json([
            'hold_id' => $hold->id,
            'status'   => $order->status,
            'total'   => $order->total,
        ]);
    }
}
