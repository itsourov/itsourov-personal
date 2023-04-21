<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;





Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/{post}', [PostController::class, 'edit'])->name('edit');
    });

});