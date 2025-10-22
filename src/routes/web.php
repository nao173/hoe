<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{productId}/update', [ProductController::class, 'edit'])->name('products.edit');
Route::get('/products/register', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.delete');