<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

Route::get('/', [ProductController::class, 'index'])
    ->name('home');

Route::get('/produk', [ProductController::class, 'index'])
    ->name('products.index');

// Pengelolaan produk khusus admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    Route::get('/produk/tambah', [ProductController::class, 'create']);
    Route::post('/produk', [ProductController::class, 'store']);
    Route::get('/produk/{product}/edit', [ProductController::class, 'edit']);
    Route::put('/produk/{product}', [ProductController::class, 'update']);
    Route::delete('/produk/{product}', [ProductController::class, 'destroy']);
    Route::get('/pesanan', [OrderController::class, 'index']);
    Route::put('/pesanan/{order}/status', [OrderController::class, 'updateStatus']);
    Route::get('/kategori', [CategoryController::class, 'index']);
    Route::post('/kategori', [CategoryController::class, 'store']);
    Route::get('/kategori/{category}/edit', [CategoryController::class, 'edit']);
    Route::put('/kategori/{category}', [CategoryController::class, 'update']);
    Route::delete('/kategori/{category}', [CategoryController::class, 'destroy']);
});


Route::get('/produk', [ProductController::class, 'index']);
Route::get('/produk/{product}', [ProductController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/keranjang', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/keranjang/tambah/{product}', [CartController::class, 'add']);
    Route::delete('/keranjang/hapus/{product}', [CartController::class, 'remove']);
    Route::put('/keranjang/update/{product}', [CartController::class, 'update']);
    Route::get('/checkout', [CartController::class, 'checkout']);
    Route::post('/checkout', [CartController::class, 'processCheckout']);
    
    Route::get('/invoice', [CartController::class, 'invoice'])
        ->name('invoice');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);




