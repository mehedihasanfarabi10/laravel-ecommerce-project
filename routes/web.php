<?php

// use App\Http\Controllers\Admin\CartController;
// use App\Http\Controllers\Home\PageController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SizeController;
// use App\Http\Controllers\Admin\OrderController;
// use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\StripeController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\WishlistController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;

use App\Http\Controllers\AdminChatController;


Route::controller(StripeController::class)->group(function(){

    Route::get('stripe/{totalValue}', 'stripe');

    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


Route::get('/',[HomeController::class,'home']);

// user update

Route::post('/user/update/',[HomeController::class,'updates'])->name('user.update');


// Wishlist

Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/view/wishlist/', [WishlistController::class, 'index'])->name('wishlist.view');
Route::delete('/wishlist/delete/{id}', [WishlistController::class, 'destroy'])->name('wishlist.delete');



// Cke Editor
// Route::post('/upload-image-ck',[HomeController::class,'ckeditorupload'])->name('ckeditor.upload');

// Product Size and Color 

// Contact

Route::post('contactform/submit/',[ContactController::class,'store'])->name('contactform.submit');

Route::get('contactform/admin/response/',[ContactController::class,'index'])->middleware(['auth', 'admin'])->name('customer.contact');
Route::get('contactform/admin/edit/{id}',[ContactController::class,'edit'])->middleware(['auth', 'admin'])->name('customer.contact.edit');
Route::post('contactform/admin/update/{id}',[ContactController::class,'update'])->middleware(['auth', 'admin'])->name('customer.contact.update');
Route::get('contactform/admin/delete/{id}',[ContactController::class,'destroy'])->middleware(['auth', 'admin'])->name('customer.contact.delete');



// Notification

Route::get('/admin/notifications', [NotificationController::class, 'getNotifications']);
Route::get('/admin/notifications/clear/', [NotificationController::class, 'clearNotifications'])->name('notification.clear');


//User Chat

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/chat/messages/{adminId}', [ChatController::class, 'fetchMessages']);
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

// Admin Chat


Route::get('admin/chat', [AdminChatController::class, 'index'])->name('dd.chat.ddd');

    Route::get('admin/chat/{userId}', [AdminChatController::class, 'showUserMessages'])->name('admin.chat.user');
    Route::post('admin/chat/reply', [AdminChatController::class, 'sendReply'])->name('admin.chat.reply');







Route::get('/dashboard',[HomeController::class,'login_home'])->middleware(['auth', 'verified'])->name('dashboard');


//This route is not working for showing data in home page so above used this route differently
// Route::get('/dashboard', function () {
//     return view('home.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Shipping Address

// Route::get('/customer/shippingaddress/edit/{id}',[AddressController::class,'edit'])->middleware('auth')->name('customer.address.edit');
Route::post('/customer/shippingaddress/update/{id}',[AddressController::class,'update'])->middleware('auth')->name('customer.address.update');
Route::post('/customer/shippingaddress/store',[AddressController::class,'store'])->middleware('auth')->name('customer.shippingaddress.store');

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


// Route::get('/admin/seller_details', [AdminController::class, 'seller_details'])->middleware(['auth', 'admin'])->name('seller.details');
Route::get('/admin/seller/{id}/edit', [AdminController::class, 'edit_seller'])->name('admin.seller.edit');
Route::delete('/admin/seller/{id}/delete', [AdminController::class, 'delete_seller'])->name('admin.seller.delete');
Route::patch('/admin/seller/{id}/activate', [AdminController::class, 'activate_seller'])->name('admin.seller.activate');
Route::put('/admin/seller/toggle/{id}', [AdminController::class, 'toggleSellerStatus'])->name('admin.sellers.toggle');

Route::get('/users/details', [AdminController::class, 'detailss'])->name('users.details');
Route::get('/seller/details', [AdminController::class, 'details'])->name('seller.details');

// Route::get('/admin/user_details', [AdminController::class, 'user_details'])->middleware(['auth', 'admin'])->name('users.details');
Route::delete('/admin/user/{id}/delete', [AdminController::class, 'delete_user'])->name('admin.user.delete');

// Category

Route::get('view_category',[CategoryController::class,'view_category'])->middleware(['auth','admin']);
Route::post('add_category',[CategoryController::class,'add_category'])->middleware(['auth','admin']);
Route::get('delete_category/{id}',[CategoryController::class,'delete_category'])->middleware(['auth','admin']);
Route::get('/edit_category/{id}', [CategoryController::class, 'edit'])->name('edit_category')->middleware(['auth','admin']);

Route::post('update_category/{id}',[CategoryController::class,'update_category'])->middleware(['auth','admin']);


// Brand


Route::get('brand-show',[BrandController::class,'index'])->middleware(['auth','admin'])->name('brand.index');
Route::post('store_brand',[BrandController::class,'brandstore'])->middleware(['auth','admin'])->name('brand.store');
Route::get('brand_delete/{id}',[BrandController::class,'delete'])->middleware(['auth','admin'])->name('brand.delete');
Route::get('brand_edit/{id}', [BrandController::class, 'edit'])->middleware(['auth','admin'])->name('brand.edit');

Route::post('brand_update/{id}',[BrandController::class,'update'])->middleware(['auth','admin'])->name('brand.update');


