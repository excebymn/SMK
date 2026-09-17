<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk{id}', [ProdukController::class, 'show']);
Route::post('/produk', [ProdukController::class, 'storee']);
Route::put('/produk{id}', [ProdukController::class, 'update']);
Route::delete('/produk{id}', [ProdukController::class, 'destroy']);