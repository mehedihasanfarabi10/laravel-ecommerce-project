<?php

// use App\Http\Controllers\Admin\CartController;
// use App\Http\Controllers\Home\PageController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\Admin\OrderController;
// use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\StripeController;

Route::controller(StripeController::class)->group(function(){

    Route::get('stripe/{totalValue}', 'stripe');

    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


Route::get('/',[HomeController::class,'home']);

// Cke Editor
// Route::post('/upload-image-ck',[HomeController::class,'ckeditorupload'])->name('ckeditor.upload');

// Product Size and Color 







Route::get('/dashboard',[HomeController::class,'login_home'])->middleware(['auth', 'verified'])->name('dashboard');


//This route is not working for showing data in home page so above used this route differently
// Route::get('/dashboard', function () {
//     return view('home.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('view_size', [SizeController::class, 'view_size'])->middleware(['auth', 'admin'])->name('view_size');

Route::post('add_size', [SizeController::class, 'add_size'])->middleware(['auth', 'admin'])->name('add_size');
Route::get('size_update/{id}', [SizeController::class, 'size_update'])->middleware(['auth', 'admin']);
Route::post('edit_size/{id}', [SizeController::class, 'edit_size'])->middleware(['auth', 'admin']);
Route::get('delete_size/{id}', [SizeController::class, 'delete_size'])->middleware(['auth', 'admin']);



Route::post('add_color', [ColorController::class, 'add_color'])->middleware(['auth', 'admin']);
Route::get('view_color', [ColorController::class, 'view_color'])->middleware(['auth', 'admin'])->name('view_color');

Route::get('color_update/{id}', [ColorController::class, 'color_update'])->middleware(['auth', 'admin']);

Route::post('edit_color/{id}', [ColorController::class, 'edit_color'])->middleware(['auth', 'admin']);

Route::get('delete_color/{id}', [ColorController::class, 'delete_color'])->middleware(['auth', 'admin']);




Route::get('/become-a-seller', [SellerController::class, 'showLogin'])->name('seller.login');
Route::post('/seller/login', [SellerController::class, 'login'])->name('seller.login.submit');
Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->middleware('auth:seller')->name('seller.dashboard');

Route::get('/seller/register', [SellerController::class, 'showRegisterForm'])->name('seller.register');
Route::post('/seller/register', [SellerController::class, 'register'])->name('seller.register.submit');


Route::get('/admin/seller_details', [AdminController::class, 'seller_details'])->middleware(['auth', 'admin'])->name('seller.details');
Route::get('/admin/seller/{id}/edit', [AdminController::class, 'edit_seller'])->name('admin.seller.edit');
Route::delete('/admin/seller/{id}/delete', [AdminController::class, 'delete_seller'])->name('admin.seller.delete');
Route::patch('/admin/seller/{id}/activate', [AdminController::class, 'activate_seller'])->name('admin.seller.activate');
Route::put('/admin/seller/toggle/{id}', [AdminController::class, 'toggleSellerStatus'])->name('admin.sellers.toggle');



Route::get('/admin/user_details', [AdminController::class, 'user_details'])->middleware(['auth', 'admin'])->name('users.details');
Route::delete('/admin/user/{id}/delete', [AdminController::class, 'delete_user'])->name('admin.user.delete');
