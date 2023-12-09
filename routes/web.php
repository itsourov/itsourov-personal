<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BkashController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiskUrlController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Bkash\PaymentController;
use App\Http\Controllers\BkashTokenizedController;
use App\Http\Controllers\Admin\ShortLinkController;
use App\Http\Controllers\Bkash\AgreementController;


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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');


Route::get('/', [ProductController::class, 'getCanva'])->name('home');
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
        Route::post('create/{product:slug}/instant', [CartController::class, 'createAndRedirect'])->name('cart.create.instant');
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


Route::prefix('bkash-tokenized')->name('bkash-tokenized.')->middleware(['auth'])->group(function () {

    Route::get('payment/create/order/{order}', [PaymentController::class, 'create_order_payment'])->name('payment.create.order');
    Route::get('payment/execute', [PaymentController::class, 'execute_bkash_payment'])->name('payment.execute');

    Route::get('agreement/create', [AgreementController::class, 'create'])->name('agreement.create');
    Route::get('agreement/callback', [AgreementController::class, 'callback'])->name('agreement.callback');

    Route::delete('agreement/delete', [AgreementController::class, 'delete'])->name('agreement.delete');

    Route::get('agreement/payment/create/order/{order}', [AgreementController::class, 'create_order_payment'])->name('agreement.payment.create.order');
});


Route::get('/sl/{short_link:short_id}', [ShortLinkController::class, 'show'])->name('shortlink.show');


require __DIR__ . '/inc/web/auth.php';
require __DIR__ . '/inc/web/admin.php';
require __DIR__ . '/inc/web/page.php';