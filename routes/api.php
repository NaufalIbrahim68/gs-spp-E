<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('editCategory', [CategoryController::class, 'getCategory']);
Route::get('showProduct', [ProductController::class, 'show']);
Route::get('getProduct', [FrontController::class, 'getProduct']);
Route::get('city', [TransactionController::class, 'getCity']);
Route::get('district', [TransactionController::class, 'getDistrict']);
