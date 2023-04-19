<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;




Route::prefix('pages')->middleware([])->group(function () {
    Route::get('faq', [PageController::class, 'faq'])->name('pages.faq');
    Route::get('about', [PageController::class, 'about'])->name('pages.about');
    Route::get('contact', [PageController::class, 'contact'])->name('pages.contact');
    Route::get('privacy-policy', [PageController::class, 'privacyPolicy'])->name('pages.privacy-policy');
    Route::get('terms-and-conditions', [PageController::class, 'termsAndConditions'])->name('pages.terms-and-conditions');
});