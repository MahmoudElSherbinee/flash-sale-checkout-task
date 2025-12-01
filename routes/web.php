<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function()
{
    return 'Flash sale checkout';
});

Route::get('/api/products/{product}', [ProductController::class, 'show']);
