<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use function Pest\Laravel\json;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $cacheKey = "products:{$product->id}:available";
        $available = Cache::remember($cacheKey, 60, function () use ($product) {
            return $product->stock - $product->reserved_count . " => From Cahch";
        });

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'reserved_count' => $product->reserved_count,
            'available' => $available
        ]);
    }
}
