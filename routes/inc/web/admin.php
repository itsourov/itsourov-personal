<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DownloadItemController;





Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::get('/{post}', [PostController::class, 'edit'])->name('edit');
    });

    Route::prefix('products')->name('products.')->group(function () {

        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::get('/{product:slug}', [ProductController::class, 'edit'])->name('edit');
        Route::get('/downloadable/{product:slug}/manage', [DownloadItemController::class, 'index'])->name('manage-downloadables');
        Route::post('/downloadable/{product:slug}/store', [DownloadItemController::class, 'store'])->name('store-downloadables');
        Route::delete('/downloadable/{downloadable}/delete', [DownloadItemController::class, 'destroy'])->name('delete-downloadables');
    });

    Route::prefix('categories')->name('categories.')->group(function () {

        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::put('/{order}', [OrderController::class, 'update'])->name('update');
    });

});