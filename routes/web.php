<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Buyer\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\EmailVerificationController;

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

// Route bảo vệ, yêu cầu người dùng phải xác thực email
Route::middleware('verified')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Middleware xác thực email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


// Sản Phẩm
use App\Http\Controllers\Buyer\SanPhamController;
Route::get('/san-pham/{id}', [SanPhamController::class, 'show'])->name('buyer.sanpham.detail');


use App\Http\Controllers\Buyer\OrderController;

Route::get('/order/create/{sanPhamId}', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');


use App\Http\Controllers\Buyer\ProfileController;

    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::get('/password', [ProfileController::class, 'showChangePasswordForm'])->name('password.form');
    Route::post('/password', [ProfileController::class, 'changePassword'])->name('password.change');

    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/view', [ProfileController::class, 'viewOrders'])->name('orders');
    Route::get('/orders/{maDonHang}', [ProfileController::class, 'viewOrderDetail'])->name('order.detail');
    
    Route::put('/order/confirmAll/{order}', [OrderController::class, 'confirmAll'])->name('order.confirmAll');

use App\Http\Controllers\Auth\SupplierController;

Route::get('/register-supplier', [SupplierController::class, 'showForm'])->name('supplier.form');
Route::post('/register-supplier', [SupplierController::class, 'register'])->name('supplier.register');
