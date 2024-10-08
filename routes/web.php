<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('order/summary/{order:order_number}', [OrderController::class, 'summary'])->name('order.summary');

    Route::resource('order', OrderController::class)->only(['index', 'store', 'show'])->scoped(['order' => 'order_number']);
    Route::resource('products', ProductController::class)->only(['index', 'show'])->scoped(['product' => 'slug']);
    Route::resource('cart', CartController::class)->only(['index', 'store', 'destroy']);
});

require __DIR__.'/auth.php';
