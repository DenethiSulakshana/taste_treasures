<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;

// Public Routes (No Authentication Required)
Route::post('login', [AuthController::class, 'login'])->name('api.login');
Route::post('register', [AuthController::class, 'register'])->name('api.register');

// Authenticated Routes (Require Sanctum Token)
Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('foods', FoodController::class);
    Route::apiResource('orders', OrderController::class);

    // Custom Routes for Cart (Instead of apiResource)
    Route::get('cart', [CartController::class, 'index'])->name('api.cart.index');
    Route::post('cart/add/{food}', [CartController::class, 'add'])->name('api.cart.add');
    Route::patch('cart/update/{cartItem}', [CartController::class, 'update'])->name('api.cart.update');
    Route::delete('cart/remove/{id}', [CartController::class, 'destroy'])->name('api.cart.destroy');
});
