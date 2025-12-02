<?php

use App\Http\Controllers\HoldController;
use App\Jobs\ExpireHoldsJob;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

Route::get('/', function()
{
    return 'Flash sale checkout';
});

Route::get('/api/products/{product}', [ProductController::class, 'show']);



Route::get('api/holds', [HoldController::class, 'index']);
Route::post('api/holds', [HoldController::class, 'store']);


Route::get('/api/orders', [OrderController::class, 'index']);
Route::post('/api/orders', [OrderController::class, 'store']);



