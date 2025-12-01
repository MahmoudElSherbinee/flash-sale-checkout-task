<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $available = $product->stock - $product->reserved_count;

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'reserved_count' => $product->reserved_count,
        ]);
    }
}
