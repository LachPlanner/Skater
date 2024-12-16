<?php

use App\Http\Controllers\AdminAuth\AdminLoginController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Models;
use App\Models\Variant;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/email/verify', function() {
    return Inertia::render('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request){
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function() {
    request()->user()->SendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1']);

//admin login
Route::get('/admin/login', [AdminLoginController::class, 'create']);
Route::post('/admin/login', [AdminLoginController::class, 'store']);

Route::middleware('admin')->group(function() {
    Route::get('/admin/dashboard', function() {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->middleware('auth:admin');
});

//showrooms
Route::get('/board', function() {
    $model = Models::with('variants')->findOrFail(2); // Hent model med ID 2 og dens varianter
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

Route::get('/build', function() {
    $models = Models::with('variants')->whereIn('id', [1, 3, 5])->get();
    return Inertia::render('Showroom/BuildBoard', [
        'models' => $models,
    ]);
});

//Product list
Route::get('/shop', function() {
    $variants = Variant::with('product') // Hent relaterede produkter
        ->whereIn('model_id', [1, 3, 5])
        ->get();

    return Inertia::render('Products/ProductList', [
        'variants' => $variants,
    ]);
});