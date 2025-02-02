<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContactController;


use App\Models\User;
use App\Models\Employee;
use App\Models\Food;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;

Route::get('/', function () {
    return view('users.landing');
})->name('landing'); 

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/landing', function () {
        return view('users.landing');
    })->name('users.landing');
});

// For About Us page
Route::get('/about', function () {
    return view('users.about-us.about'); // This will load the about.blade.php view
})->name('ausers.about-us.about');

// For Contact Us page
Route::get('/contact', function () {
    return view('users.contact-us.contact'); // This will load the contact.blade.php view
})->name('users.contact-us.contact');

// Route for handling the contact form submission (POST request)
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


// Foods Routes
Route::get('/foods', [FoodController::class, 'index'])->name('users.foods.index'); 
Route::post('/foods', [FoodController::class, 'store'])->name('foods.store');
Route::get('/foods/{id}', [FoodController::class, 'show'])->where('id', '[0-9]+')->name('users.foods.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('users.cart.index');
Route::post('/cart/add/{food}', [CartController::class, 'add'])->name('users.cart.add');
Route::patch('/cart-items/{cartItem}', [CartController::class, 'update'])->name('users.cart.update');
Route::post('/cart/order', [CartController::class, 'placeOrder'])->name('users.cart.order');
Route::get('/checkout', [CartController::class, 'checkout'])->name('users.cart.checkout');
Route::post('/checkout/confirm', [CartController::class, 'confirmOrder'])->name('users.cart.confirmOrder');

// Show Orders
Route::get('/showorders', [CartController::class, 'showorders'])->name('users.cart.showorders');

// Delete Items from Cart
Route::delete('/cart-items/{id}', [CartController::class, 'destroy'])->name('users.cart.destroy');
Route::delete('/cart-items', [CartController::class, 'clear'])->name('users.cart.clear');

 // contact

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
