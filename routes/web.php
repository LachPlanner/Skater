<?php

use App\Http\Controllers\AdminAuth\AdminLoginController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Models;
use App\Models\Variant;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Home');
});

//user login
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');

//user register
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

//admin login
Route::get('/admin/login', [AdminLoginController::class, 'create']);
Route::post('/admin/login', [AdminLoginController::class, 'store']);

//Reset password
Route::get('/forgot-password', function () {
    return Inertia::render('Auth/ForgotPassword');
})->name('password.request');

Route::post('/generate-token', [PasswordResetController::class, 'generateResetToken']);

Route::get('/reset-password', function () {
    return Inertia::render('Auth/ResetPassword');
})->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);

Route::get('/show-token', function (Request $request) {
    return Inertia::render('Auth/TokenGenerated', [
        'token' => $request->token,
        'email' => $request->email,
    ]);
})->name('show-token');

Route::middleware('admin')->group(function() {
    Route::get('/admin/dashboard', function() {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');
    
    //Orders
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders');
    
    //Products
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    
    //Logout
    Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->middleware('auth:admin');
});

//showrooms
Route::get('/board', function() {
    $model = Models::with('variants')->findOrFail(2);
    return Inertia::render('Showroom/Board', [
        'model' => $model,
    ]);
});

Route::get('/trucks', function() {
    $model = Models::with('variants')->findOrFail(4);
    return Inertia::render('Showroom/Trucks', [
        'model' => $model,
    ]);
});

Route::get('/wheels', function() {
    $model = Models::with('variants')->findOrFail(6);
    return Inertia::render('Showroom/Wheels', [
        'model' => $model,
    ]);
});

Route::get('/buildboard', function() {
    $models = Models::with('variants')->whereIn('id', [1, 3, 5])->get();
    return Inertia::render('Showroom/BuildBoard', [
        'models' => $models,
    ]);
});

//Product list
Route::get('/shop', function() {
    $variants = Variant::with('product')
        ->whereIn('model_id', [1, 3, 5])
        ->get();

    return Inertia::render('Products/ProductList', [
        'variants' => $variants,
    ]);
});

Route::middleware('auth')->group(function() {
    //Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    //Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    //Profile
    Route::get('/profile', [UserController::class, 'show']);
});