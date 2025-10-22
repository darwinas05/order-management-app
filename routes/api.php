<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/test', function () {
    return response()->json(['message' =>  ' API funcionando 200 OK ']);
});
Route::apiResource('orders', OrderController::class);
Route::apiResource('products', ProductController::class);