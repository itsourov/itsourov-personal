<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BkashController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/icons', function () {
    return view('icons');
})->name('icons');


Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('show');
});


Route::prefix('shop')->name('shop.')->middleware([])->group(function () {
    Route::middleware([])->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    });
    Route::prefix('cart')->middleware(['auth'])->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('create/{product:slug}', [CartController::class, 'create'])->name('cart.create');
        Route::delete('create/{product:slug}', [CartController::class, 'destroy'])->name('cart.destroy');
    });
    Route::get('checkout', [CheckoutController::class, 'checkout'])->middleware('auth')->name('checkout');

    Route::prefix('order')->middleware(['auth'])->group(function () {
        Route::get('order/{order}', [OrderController::class, 'show'])->name('order.show');
        Route::post('order/create/cart', [OrderController::class, 'createFromCart'])->name('order.create.cart');
        Route::post('order/create/{product:slug}', [OrderController::class, 'createFromProduct'])->name('order.create.product');
    });
});

Route::prefix('my-account')->name('my-account.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/orders', [DashboardController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [DashboardController::class, 'showOrder'])->name('orders.show');
    Route::get('/downloads', [DashboardController::class, 'downloads'])->name('downloads');
    Route::get('/downloads/{download_item}', [DashboardController::class, 'showDownload'])->name('downloads.show');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

});

Route::prefix('bkash')->middleware(['auth'])->group(function () {
    Route::post('token', [BkashController::class, 'token'])->name('bkash.token');
    Route::post('token/refresh', [BkashController::class, 'refresh_token'])->name('bkash.token.refresh');

    Route::get('payment/create/order/{order}/{price}', [BkashController::class, 'order_create_payment'])->name('bkash.payment.create.order');
    Route::get('payment/execute/order', [BkashController::class, 'execute_order_payment'])->name('bkash.payment.execute.order');


});


require __DIR__ . '/inc/web/auth.php';
require __DIR__ . '/inc/web/admin.php';
require __DIR__ . '/inc/web/page.php';