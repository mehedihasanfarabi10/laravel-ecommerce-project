<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\PageController;

Route::get('shop-list', [PageController::class, 'shop'])->name('shop');
Route::get('why-us', [PageController::class, 'why'])->name('why');
Route::get('client-role', [PageController::class, 'testimonial'])->name('testimonial');
Route::get('contact-us', [PageController::class, 'contact'])->name('contact');
