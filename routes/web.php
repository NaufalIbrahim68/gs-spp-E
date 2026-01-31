<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController as ControllersOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontController::class, 'index'])->name('front.index');

// Generic dashboard route - redirects based on user role
Route::middleware('auth')->get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard.index');
    }
    return redirect()->route('customer.dashboard');
})->name('dashboard');

Route::get('/produk', [FrontController::class, 'product'])->name('front.product');
Route::get('category/{slug}', [FrontController::class, 'categoryProduct']);
Route::get('produk/{slug}', [FrontController::class, 'show']);


Route::middleware(['auth', 'checkRole:customer'])
    ->prefix('cart')
    ->name('front.')
    ->group(function () {
        Route::get('/', [TransactionController::class, 'listCart'])->name('cart_list');
        Route::post('/', [TransactionController::class, 'addToCart'])->name('cart');
        Route::put('/', [TransactionController::class, 'updateCart'])->name('update_cart');
        Route::delete('/{id}', [TransactionController::class, 'deleteCart'])->name('delete_cart');
    });

Route::middleware(['auth', 'checkRole:customer'])
    ->prefix('checkout')
    ->name('front.')
    ->group(function () {
        Route::get('/', [TransactionController::class, 'checkout'])->name('checkout');
        Route::post('/', [TransactionController::class, 'prosesCheckout'])->name('prosesCheckout');
        Route::get('/{invoice}', [TransactionController::class, 'checkoutFinish'])->name('finish_checkout');
    });

Route::middleware(['auth', 'checkRole:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {
        Route::get('/', [ControllersDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [CustomerProfileController::class, 'profile'])->name('profile');
        Route::post('/profile', [CustomerProfileController::class, 'updateProfile'])->name('profile.update');
        Route::get('/settings', [CustomerProfileController::class, 'settings'])->name('settings');
        Route::post('/password', [CustomerProfileController::class, 'updatePassword'])->name('password.update');
        Route::post('/pesanan', [ControllersOrderController::class, 'acceptOrder'])->name('order_accept');
        Route::get('/pesanan/{invoice}', [ControllersOrderController::class, 'detailOrder'])->name('detailOrder');
        Route::get('/payment', [ControllersOrderController::class, 'payment'])->name('payment');
        Route::post('/payment', [ControllersOrderController::class, 'paymentStore'])->name('payment_store');
    });


Route::middleware(['auth', 'checkRole:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('/product', ProductController::class);
        Route::resource('/category', CategoryController::class)->except(['create', 'show', 'edit']);

        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('orders.index');
            Route::post('/', [OrderController::class, 'shippingOrder'])->name('orders.tracking_number');
            Route::get('/{invoice}', [OrderController::class, 'detail'])->name('orders.detail');
            Route::post('/accept_payment/{id}', [OrderController::class, 'acceptPayment'])->name('orders.accept_payment');
            Route::delete('/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
            Route::get('/return/{invoice}', [OrderController::class, 'return'])->name('orders.return');
            Route::get('/print/{invoice}', [OrderController::class, 'print'])->name('orders.print');
            Route::post('/return', [OrderController::class, 'approveReturn'])->name('orders.approve_return');
            Route::post('/shipping-status', [OrderController::class, 'updateShippingStatus'])->name('orders.update_shipping_status');
        });

        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/laporan', [DashboardController::class, 'orderReport'])->name('report.index');
        Route::get('/laporan/pdf/{daterange}', [DashboardController::class, 'orderReportPdf'])->name('report.order_pdf');
        Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
