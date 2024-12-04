<?php

use App\Http\Controllers\AdminAuth\AdminLoginController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Models;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return Inertia::render('Home');
});

//user login
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');

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

//Products
Route::get('/board', function() {
    $model = Models::with('variants')->findOrFail(2); // Hent model med ID 2 og dens varianter
    return Inertia::render('Product/Board', [
        'model' => $model,
    ]);
});

Route::get('/trunks', function() {
    $model = Models::with('variants')->findOrFail(3);
    return Inertia::render('Product/Trunks', [
        'model' => $model,
    ]);
});

Route::get('/wheels', function() {
    $model = Models::with('variants')->findOrFail(4);
    return Inertia::render('Product/Wheels', [
        'model' => $model,
    ]);
});

